<?php
$client = new SoapClient(dirname(__FILE__)."/round2_groupB.wsdl",array("trace"=>1,"exceptions"=>0));
$client->echoStructAsSimpleTypes((object)array('varString'=>"arg",'varInt'=>34,'varFloat'=>34.345));
echo $client->__getlastrequest();
$HTTP_RAW_POST_DATA = $client->__getlastrequest();
include("round2_groupB.inc");
echo "ok\n";
?>