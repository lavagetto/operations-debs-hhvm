<?php
$HTTP_RAW_POST_DATA = <<<EOF
<?xml version='1.0' ?>
<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope"> 
  <env:Header>
    <test:Unknown xmlns:test="http://example.org/ts-tests"
          env:mustUnderstand="false" 
          env:role="http://example.org/ts-tests/C">foo</test:Unknown>
    <test:echoOk xmlns:test="http://example.org/ts-tests"
          env:mustUnderstand="0" 
          env:role="http://example.org/ts-tests/C">foo</test:echoOk>
  </env:Header>
  <env:Body>
  </env:Body>
</env:Envelope>
EOF;
include "soap12-test.inc";
?>