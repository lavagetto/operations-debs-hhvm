<?php
class test {

  private function __clone() {
  }
}

$obj = new test;
$clone = clone $obj;
$obj = NULL;

echo "Done\n";
?>