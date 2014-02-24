<?php
include "test_schema.inc";
$schema = <<<EOF
	<complexType name="testType">
		<complexContent>
			<restriction base="enc12:Array" xmlns:enc12="http://www.w3.org/2003/05/soap-encoding">
  	    <attribute ref="enc12:itemType" wsdl:itemType="int"/>
  	    <attribute ref="enc12:arraySize" wsdl:arraySize="* 1"/>
    	</restriction>
    </complexContent>
	</complexType>
EOF;
test_schema($schema,'type="tns:testType"',array(array(123),array(123.5)));
echo "ok";
?>