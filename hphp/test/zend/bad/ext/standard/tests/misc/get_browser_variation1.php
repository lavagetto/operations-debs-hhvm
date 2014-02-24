<?php
ini_set('browscap', {PWD}/browscap.ini);

/* Prototype  : mixed get_browser([string browser_name [, bool return_array]])
 * Description: Get information about the capabilities of a browser. 
 * If browser_name is omitted or null, HTTP_USER_AGENT is used. 
 * Returns an object by default; if return_array is true, returns an array. 
 *
 * Source code: ext/standard/browscap.c
 * Alias to functions: 
 */

$browsers = include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'browsernames.inc';

echo "*** Testing get_browser() : variation functionality: extra browser names ***\n";

$count = count( $browsers );
for( $x = 20; $x < $count; $x++) {
	var_dump( get_browser( $browsers[$x], true ) );
}

?>
===DONE===