<?php
class pubf {
	public function f() {}
	static public function s() {}	
}
class subpubf extends pubf {
}

class protf {
	protected function f() {}
	static protected function s() {}	
}
class subprotf extends protf {
}

class privf {
	private function f() {}
	static private function s() {}
}
class subprivf extends privf  {
}

$classes = array("pubf", "subpubf", "protf", "subprotf", 
				 "privf", "subprivf");
foreach($classes as $class) {
	echo "Reflecting on class $class: \n";
	$rc = new ReflectionClass($class);
	echo "  --> Check for f(): ";
	var_dump($rc->getMethod("f"));
	echo "  --> Check for s(): ";
	var_dump($rc->getMethod("s"));	
	echo "  --> Check for F(): ";
	var_dump($rc->getMethod("F"));	
	echo "  --> Check for doesntExist(): ";
	try {
		var_dump($rc->getMethod("doesntExist"));
	} catch (Exception $e) {
		echo $e->getMessage() . "\n"; 
	}
}
?>
