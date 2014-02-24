<?php
function inc( &$x ) { $x++; }

class Proxy {
        function __call( $name, $args ) {
		echo "$name called!\n";
                call_user_func_array( 'inc', $args );
        }
}

$arg = 1;
$args = array( &$arg );
$proxy = new Proxy;
call_user_func_array( array( $proxy, 'bar' ), $args );
call_user_func_array( array( $proxy, 'bar' ), array(&$arg) );
var_dump($arg);