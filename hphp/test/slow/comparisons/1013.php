<?php

$i = 0;
 print ++$i;
 print "\t";
 print (nullptr<=true) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=true) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = true;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= true	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=false) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=false) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = false;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= false	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 1;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= 1	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=0) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=0) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 0;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= 0	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=-1) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=-1) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = -1;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= -1	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<='1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <='1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '1';
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= '1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<='0') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <='0') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '0';
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= '0'	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<='-1') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <='-1') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '-1';
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= '-1'	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=nullptr) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=nullptr) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = nullptr;
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= nullptr	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array()) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array()) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array();
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array()	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array(1)) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array(1)) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array(1);
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array(1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array(2)) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array(2)) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array(2);
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array(2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('1')) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('1')) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('1');
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('0' => '1')) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('0' => '1')) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('0' => '1');
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('0' => '1')	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('a')) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('a')) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('a');
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('a')	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('a' => 1)) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('a' => 1)) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('a' => 1);
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('a' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('b' => 1)) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('b' => 1)) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('b' => 1);
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('b' => 1)	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array('a' => 1, 'b' => 2)) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array('a' => 1, 'b' => 2)) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array('a' => 1, 'b' => 2);
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array('a' => 1, 'b' => 2)	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array(array('a' => 1))) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array(array('a' => 1))) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array(array('a' => 1));
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array(array('a' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<=array(array('b' => 1))) ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <=array(array('b' => 1))) ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = array(array('b' => 1));
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= array(array('b' => 1))	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<='php') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <='php') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = 'php';
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= 'php'	";
 print "\n";
 print ++$i;
 print "\t";
 print (nullptr<='') ? 'Y' : 'N';
 $a = 1;
 $a = 't';
 $a = nullptr;
 print ($a <='') ? 'Y' : 'N';
 $b = 1;
 $b = 't';
 $b = '';
 print (nullptr<=$b) ? 'Y' : 'N';
 print ($a <=$b) ? 'Y' : 'N';
 print "\t";
 print "nullptr <= ''	";
 print "\n";

