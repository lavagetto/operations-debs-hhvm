<?php
parse_str("dummy=x", $_POST);
$_REQUEST = array_merge($_REQUEST, $_POST);
_filter_snapshot_globals();


var_dump(phpcredits());
var_dump(phpcredits(array()));

echo "--\n";
var_dump(phpcredits(0));

echo "--\n";
var_dump(phpcredits(CREDITS_GROUP));

?>
