<?php
/* Prototype: bool is_writable ( string $filename );
   Description: Tells whether the filename is writable.

   is_writeable() is an alias of is_writable()
*/

/* test is_writable() & is_writeable() with invalid arguments */

echo "*** Testing is_writable(): usage variations ***\n";

echo "\n*** Testing is_writable() with invalid filenames ***\n";
$misc_files = array(
  0,
  1234,
  -2.34555,
  TRUE,
  FALSE,
  NULL,
  " ",
  @array(),
  @$file_handle
);
/* loop through to test each element in the above array 
   is a writable file */
foreach( $misc_files as $misc_file ) {
  var_dump( is_writable($misc_file) );
  var_dump( is_writeable($misc_file) );
  clearstatcache();
}

echo "Done\n";
?>