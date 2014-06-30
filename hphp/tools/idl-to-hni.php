<?hh

if (empty($_SERVER['argv'][1])) {
  die("Usage: {$_SERVER['argv'][0]} [file.idl.json] <ext_file.php>\n");
}

if (!($idlFile = @file_get_contents($_SERVER['argv'][1])) ||
    !($idl = @json_decode($idlFile, true))) {
  die("Unable to read {$_SERVER['argv'][1]} as JSON\n");
}

if (empty($_SERVER['argv'][2])) {
  $phpFile = dirname($_SERVER['argv'][1]) . '/' .
             basename($_SERVER['argv'][1], '.idl.json') . '.php';
} else {
  $phpFile = $_SERVER['argv'][2];
}

$php = fopen($phpFile, 'w');
$php || die("Unable to open output file\n");

fwrite($php, "<?hh\n// generated by idl-to-hni.php\n");

foreach ($idl['classes'] as $class) {
  fwrite($php, "\n");
  fwrite($php, formatDocBlock([$class['desc']]));
  fwrite($php, "class {$class['name']} ");
  if (!empty($class['parent'])) {
    fwrite($php, "extends {$class['parent']} ");
  }
  if (!empty($class['interfaces'])) {
    foreach($class['interfaces'] as $iface) {
      fwrite($php, "implements {$iface} ");
    }
  }
  fwrite($php, "{\n");
  foreach($class['funcs'] as $func) {
    output_function($php, $func, '  ');
  }
  fwrite($php, "}\n");
}
foreach ($idl['funcs'] as $func) {
  output_function($php, $func);
}

function formatDocBlock(array $strs, $indent = '') {
  $str = '';
  foreach ($strs as $s) {
    $str .= wordwrap(trim(str_replace(["\n","\r","\t"], ' ', $s)),
                     75, "\n${indent} * ");
    $str .= "\n{$indent} * ";
  }
  $str = substr($str, 0, -3 - strlen($indent));
  return "$indent/* $str$indent */\n";
}

function phpType($type) {
  switch (strtolower($type)) {
    case '': return 'void';
    case 'int32':
    case 'int64': return 'int';
    case 'double': return 'float';
    case 'string': return 'string';
    case 'boolean': return 'bool';
    case 'resource': return 'resource';
    case 'variantmap':
    case 'stringvec':
    case 'stringmap':
    case 'variantvec': return 'array';
    case 'variant': return 'mixed';
    default: return 'object';
  }
}

function defaultValue($val) {
  switch ($val) {
    case 'null_string':   return '""';
    case 'null_array':    return '[]';
    case 'null_object':   return 'null';
    case 'null_resource': return 'null';
  }
  if (substr($val, 0, 2) == 'k_') {
    return substr($val, 2);
  }
  if (substr($val, 0, 2) == 'q_') {
    return implode('::', explode('$$', substr($val, 2)));
  }
  return $val;
}

function output_function($fp, $func, $indent = '') {
  fwrite($fp, "\n");
  $desc = [];
  if (!empty($func['desc'])) {
    $desc[] = trim($func['desc']);
  }
  foreach($func['args'] as $arg) {
    $argdesc = '@param ' . phpType($arg['type']) .
               ' $' . $arg['name'];
    if (!empty($arg['desc'])) {
      $argdesc .= ' - ' . $arg['desc'];
    }
    $desc[] = $argdesc;
  }
  if (phpType($func['return']['type']) != 'void') {
    $retdesc = '@return ' . phpType($func['return']['type']);
    if (!empty($func['return']['desc'])) {
      $retdesc .= ' - ' . $func['return']['desc'];
    }
    $desc[] = $retdesc;
  }
  if ($desc) {
    fwrite($fp, formatDocBlock($desc, $indent));
  }
  $modifiers = [];
  $nativea = (count($func['args']) > 32) ? ['"ActRec"'] : [];
  $ua = [];
  if (isset($func['flags'])) {
    foreach($func['flags'] as $flag) {
      switch (strtolower($flag)) {
        case 'ispublic':       if ($indent) $modifiers[] = 'public'; break;
        case 'isprotected':    if ($indent) $modifiers[] = 'protected'; break;
        case 'isprivate':      if ($indent) $modifiers[] = 'private'; break;
        case 'isstatic':       if ($indent) $modifiers[] = 'static'; break;
        case 'isfoldable':     $ua[] = '__IsFoldable'; break;
        case 'hiphopspecific': $ua[] = '__HipHopSpecific'; break;
        case 'noinjection':    $nativea[] = '"NoInjection"'; break;
        case 'paramcoercemodefalse': $ua[] = '__ParamCoerceModeFalse'; break;
        default: fwrite(STDERR, "Unknown Flag: $flag\n");
      }
    }
  }
  $ua[] = '__Native' . ($nativea ? ('('.implode(', ',$nativea).')') : '');
  if ($modifiers) {
    $modifiers[] = '';
  }

  fwrite($fp, $indent . '<<' . implode(', ', $ua) . ">>\n");
  $funcproto = $indent .
               implode(' ' , $modifiers) . "function {$func['name']}(";
  fwrite($fp, $funcproto);
  foreach ($func['args'] as $idx => $arg) {
    if ($idx) {
      fwrite($fp, ",\n" . str_repeat(' ', strlen($funcproto)));
    }
    fwrite($fp, phpType($arg['type']) .
                (empty($arg['ref']) ? ' $' : ' &$') . $arg['name']);
    if (isset($arg['value'])) {
      fwrite($fp, ' = ' . defaultValue($arg['value']));
    }
  }
  fwrite($fp, "): " . phpType($func['return']['type']) . ";\n");
}
