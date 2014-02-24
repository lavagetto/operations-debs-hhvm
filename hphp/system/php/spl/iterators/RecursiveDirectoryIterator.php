<?php

// This doc comment block generated by idl/sysdoc.php
/**
 * ( excerpt from
 * http://php.net/manual/en/class.recursivedirectoryiterator.php )
 *
 * The RecursiveDirectoryIterator provides an interface for iterating
 * recursively over filesystem directories.
 *
 */
class RecursiveDirectoryIterator extends FilesystemIterator
  implements RecursiveIterator {

  const FOLLOW_SYMLINKS = 512;

  private $subPath;

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/recursivedirectoryiterator.construct.php )
   *
   * Constructs a RecursiveDirectoryIterator() for the provided path.
   *
   * @path       mixed   The path of the directory to be iterated over.
   * @flags      mixed   Flags may be provided which will affect the behavior
   *                     of some methods. A list of the flags can found under
   *                     FilesystemIterator predefined constants. They can
   *                     also be set later with
   *                     FilesystemIterator::setFlags().
   *
   * @return     mixed   Returns the newly created
   *                     RecursiveDirectoryIterator.
   */
  public function __construct($path, $flags = null) {
    if ($flags === null) {
      $flags = FilesystemIterator::KEY_AS_PATHNAME |
               FilesystemIterator::CURRENT_AS_FILEINFO;
    }
    parent::__construct($path, $flags);
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/recursivedirectoryiterator.haschildren.php )
   *
   *
   * @return     mixed   Returns whether the current entry is a directory,
   *                     but not '.' or '..'
   */
  public function hasChildren() {
    if ($this->isDot()) {
      return false;
    }
    if (is_link($this->getFilename()) &&
        !($this->flags & self::FOLLOW_SYMLINKS)) {
      return false;
    }
    return $this->isDir();
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/recursivedirectoryiterator.getchildren.php )
   *
   *
   * @return     mixed   The filename, file information, or $this depending
   *                     on the set flags. See the FilesystemIterator
   *                     constants.
   */
  public function getChildren() {
    if ($this->getFlags() & FilesystemIterator::CURRENT_AS_PATHNAME) {
      return $this->current();
    }
    $child = new static($this->getPathname(), $this->getFlags());
    $child->subPath = $this->subPath;
    if ($child->subPath) {
      $child->subPath .= DIRECTORY_SEPARATOR;
    }
    $child->subPath .= $this->getBasename();
    return $child;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/recursivedirectoryiterator.getsubpath.php )
   *
   * Gets the sub path. Warning: This function is currently not documented;
   * only its argument list is available.
   *
   * @return     mixed   The sub path (sub directory).
   */
  public function getSubPath() {
    return $this->subPath;
  }

  // This doc comment block generated by idl/sysdoc.php
  /**
   * ( excerpt from
   * http://php.net/manual/en/recursivedirectoryiterator.getsubpathname.php )
   *
   * Gets the sub path and filename. Warning: This function is currently not
   * documented; only its argument list is available.
   *
   * @return     mixed   The sub path (sub directory) and filename.
   */
  public function getSubPathname() {
    return ($this->subPath ? $this->subPath . DIRECTORY_SEPARATOR : '') .
      $this->getFilename();
  }

}
