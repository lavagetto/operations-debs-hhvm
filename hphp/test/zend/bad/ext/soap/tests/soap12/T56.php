<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope"
              xmlns:xsd="http://www.w3.org/2001/XMLSchema"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xmlns:enc="http://www.w3.org/2003/05/soap-encoding">
  <env:Header>
    <test:DataHolder xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
      <test:Data enc:id="data-1" xsi:type="xsd:string">
        hello world
      </test:Data>
    </test:DataHolder>
  </env:Header>
  <env:Body>
    <test:echoString xmlns:test="http://example.org/ts-tests"
          env:encodingStyle="http://www.w3.org/2003/05/soap-encoding">
      <inputString enc:ref="#data-2" xsi:type="xsd:string" />
    </test:echoString>
  </env:Body>
</env:Envelope>
EOF;
include "soap12-test.inc";
?>