
if (LIBPNG_LIBRARIES AND LIBPNG_INCLUDE_DIRS)
  set (LibPng_FIND_QUIETLY TRUE)
endif (LIBPNG_LIBRARIES AND LIBPNG_INCLUDE_DIRS)

find_path(LIBPNG_INCLUDE_DIRS NAMES png.h)
find_library(LIBPNG_LIBRARIES NAMES png)

include (FindPackageHandleStandardArgs)
FIND_PACKAGE_HANDLE_STANDARD_ARGS(LibPng DEFAULT_MSG
    LIBPNG_LIBRARIES
    LIBPNG_INCLUDE_DIRS)

mark_as_advanced(LIBPNG_INCLUDE_DIRS LIBPNG_LIBRARIES)
