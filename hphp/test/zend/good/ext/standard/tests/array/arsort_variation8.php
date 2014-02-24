<?php
/* Prototype  : bool arsort ( array &$array [, int $sort_flags] )
 * Description: Sort an array and maintain index association. 
                Elements will be arranged from highest to lowest when this function has completed.
 * Source code: ext/standard/array.c
*/

/*
 * testing arsort() by providing arrays contains sub arrays for $array argument with flowing flag values
 * flag value as default
 * SORT_REGULAR - compare items normally
 * Note: arrays are sorted based on total count of elements inside it, when all the elements are arrays
*/

echo "*** Testing arsort() : usage variations ***\n";

// array of arrays
$various_arrays = array (
  // null array
  "array[0]" => array(),

  // array contains null sub array
  "array[1]" => array( "sub_array[1][0]" => array() ),

  // array of arrays along with some values
  "array[2]" => array("data[2,0]" => 44, "data[2,1]" => 11, "sub_array[2][0] " => array(64,61) ),

  // array contains sub arrays
  "array[3]" => array ( "sub_array[3][0]" => array(33,-5,6), "sub_array[3][1]" => array(11), 
                        "sub_array[3][2]" => array(22,-55), "sub_array[3][3]" => array() )
);


$count = 1;
echo "\n-- Testing arsort() by supplying various arrays containing sub arrays --\n";

// loop through to test arsort() with different arrays
foreach ($various_arrays as $array) {
 
  echo "\n-- Iteration $count --\n"; 
  // testing arsort() function by supplying different arrays, flag value is default
  echo "- With default sort_flag -\n";
  $temp_array = $array;
  var_dump(arsort($temp_array) );
  var_dump($temp_array);

  // testing arsort() function by supplying different arrays, flag value = SORT_REGULAR
  echo "- Sort_flag = SORT_REGULAR -\n";
  $temp_array = $array;
  var_dump(arsort($temp_array, SORT_REGULAR) );
  var_dump($temp_array);
  $count++;
}

echo "Done\n";
?>