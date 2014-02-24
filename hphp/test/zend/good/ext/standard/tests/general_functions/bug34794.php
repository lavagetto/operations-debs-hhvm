<?php
echo "Opening process 1\n";
$process1 = proc_open('/bin/cat', array(0 => array('pipe', 'r'), 1 =>array('pipe', 'r')), $pipes1);

echo "Opening process 2\n";
$process2 = proc_open('/bin/cat', array(0 => array('pipe', 'r'), 1 =>array('pipe', 'r')), $pipes2);


echo "Closing process 1\n";
fclose($pipes1[0]);
fclose($pipes1[1]);
proc_close($process1);

echo "Closing process 2\n";
fclose($pipes2[0]);
fclose($pipes2[1]);
proc_close($process2);

echo "Done\n";

?>