<?hh

function main() {
  $a = msarray();
  $a['foo'] = 1;
  $a['bar'] = 2;

  $res = array_map($x ==> $x + 100, $a);
  var_dump($res);
}

main();
