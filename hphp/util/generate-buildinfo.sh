#!/bin/bash
#
# Generates compiler id and repo schema symbols in a .cpp file and
# header.  The compiler id cpp files goes on every link line (see
# .fbconfig), but that no build rules have a dependency on it (we're
# ok not relinking it in some cases).
#
# The repo schema goes in a header that is only touched if its
# contents would've changed.
#

# OSS version depends on this fallback since it's
# obviously not using fbmake
if [ x"$FBMAKE_PRE_COMMAND_OUTDIR" = x"" ]; then
  FBMAKE_PRE_COMMAND_OUTDIR="$HPHP_HOME/hphp/"
fi

BUILDINFO_FILE="$FBMAKE_PRE_COMMAND_OUTDIR/hphp-build-info.cpp"
REPO_SCHEMA_H="$FBMAKE_PRE_COMMAND_OUTDIR/hphp-repo-schema.h"

GIT_TLD=$(git rev-parse --show-toplevel)
GIT="yes"
if [ x"$GIT_TLD" = x"" ]; then
  GIT_TLD=$HPHP_HOME
  GIT="no"
fi
cd $GIT_TLD

######################################################################

if [ x"$COMPILER_ID" = x"" ]; then
  if [ "$GIT" = "yes" ]; then
    COMPILER_ID=$(git describe --all --long --abbrev=40 --always)
  else
    # Building outside of a git repo, use system time instead.
    # This will make the sha appear to change constantly,
    # but without any insight into file state, it's the safest fallback
    COMPILER_ID=$(date +%s_%N)
  fi
fi

# Compute a hash that can be used as a unique repo schema identifier.  The
# identifier incorporates the current git revision and local modifications to
# managed files, but it intentionally ignores unmanaged files (even though they
# could conceivably contain source code that meaningfully changes the repo
# schema), because for some work flows the added instability of schema IDs is a
# cure worse than the disease.
if [ x"$HHVM_REPO_SCHEMA" = x"" ] ; then
  if [ "$GIT" = "yes" ]; then
    repo_mods=$(git diff --name-only HEAD)
    # find the sha1 of the tree-object corresponding to the HEAD commit
    repo_tree=$(git log -n1 --pretty=format:%T HEAD)

    # there were modified tracked files. add them to a temporary index
    # and find the sha1 of the tree-object.
    if [ x"$repo_mods" != x"" ] ; then
        repo_tree=$( \
            export GIT_INDEX_FILE=.git-index-$$; \
            git read-tree $repo_tree; \
            git update-index --add --remove $repo_mods; \
            git write-tree; \
            rm -f $GIT_INDEX_FILE \
        )
    fi

    # use ls-tree to incorporate the sha1's of the various sub-tree's
    # we care about into a unique sha1 representing the current state
    # of the code-base (this avoids, eg updating the schema because a
    # test was modified).
    HHVM_REPO_SCHEMA=$(git ls-tree --full-tree $repo_tree hphp/ | \
        grep -v hphp/test | \
        git hash-object --stdin)
  else
    # As with COMPILER_ID above, we're not in git so we have to
    # use a fallback state where we assume to repo is constantly
    # changing by using the system time
    HHVM_REPO_SCHEMA=$(date +%N_%s)
  fi
fi

######################################################################

# Generate header files that contains the repo schema, but only write
# to them if the values have changed. This way, source files can
# depend on the headers and get rebuilt as necessary.
function make_define_header() {
  local t
  t=`mktemp -t hhvm_mk.hXXXXXX || exit 1`
  echo "#define $2 \"$3\"" > $t
  mkdir -p $(dirname $1)
  if test -f "$1" ; then
    diff $t $1 >/dev/null 2>&1 || cp $t $1
  else
    cp $t $1
  fi
  rm -f $t
}

######################################################################

make_define_header $REPO_SCHEMA_H REPO_SCHEMA $HHVM_REPO_SCHEMA

cat > $BUILDINFO_FILE <<EOF
// Generated by fbmake_pre_command for hphp.
namespace HPHP {
extern const char* const kCompilerId = "$COMPILER_ID";
}
EOF
