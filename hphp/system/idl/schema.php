<?php

require_once 'base.php';

$ext = $argv[1];
if (file_exists($ext) || preg_match('/\.idl\.php/', $ext)) {
  require_once $ext;
  $ext = preg_replace('/\.idl\.php/', '', $ext);
} else {
  require_once "$ext.idl.php";
}

$net = isset($argv[2]) ? $argv[2] : -1; // 1: always phpnet; 0; auto; -1; no

///////////////////////////////////////////////////////////////////////////////

$output = <<<CODE
<?php
/**
 * Automatically generated by running "php schema.php $ext".
 *
 * You may modify the file, but re-running schema.php against this file will
 * standardize the format without losing your schema changes. It does lose
 * any changes that are not part of schema. Use "note" field to comment on
 * schema itself, and "note" fields are not used in any code generation but
 * only staying within this file.
 *
 * @nolint
 */
///////////////////////////////////////////////////////////////////////////////
// Preamble: C++ code inserted at beginning of ext_{name}.h

DefinePreamble(<<<CPP
$preamble
CPP
);

///////////////////////////////////////////////////////////////////////////////
// Constants
//
// array (
//   'name' => name of the constant
//   'type' => type of the constant
//   'note' => additional note about this constant's schema
// )


CODE;

define_constants($constants);

$output .= <<<CODE

///////////////////////////////////////////////////////////////////////////////
// Functions
//
// array (
//   'name'   => name of the function
//   'desc'   => description of the function's purpose
//   'flags'  => attributes of the function, see base.php for possible values
//   'opt'    => optimization callback function's name for compiler
//   'note'   => additional note about this function's schema
//   'return' =>
//      array (
//        'type'  => return type, use Reference for ref return
//        'desc'  => description of the return value
//      )
//   'args'   => arguments
//      array (
//        'name'  => name of the argument
//        'type'  => type of the argument, use Reference for output parameter
//        'value' => default value of the argument
//        'desc'  => description of the argument
//      )
// )


CODE;

foreach ($funcs as $func) {
  define_function($func);
}

$output .= <<<CODE

///////////////////////////////////////////////////////////////////////////////
// Classes
//
// BeginClass
// array (
//   'name'   => name of the class
//   'desc'   => description of the class's purpose
//   'flags'  => attributes of the class, see base.php for possible values
//   'note'   => additional note about this class's schema
//   'parent' => parent class name, if any
//   'ifaces' => array of interfaces tihs class implements
//   'bases'  => extra internal and special base classes this class requires
//   'footer' => extra C++ inserted at end of class declaration
// )
//
// DefineConstant(..)
// DefineConstant(..)
// ...
// DefineFunction(..)
// DefineFunction(..)
// ...
// DefineProperty
// DefineProperty
//
// array (
//   'name'  => name of the property
//   'type'  => type of the property
//   'flags' => attributes of the property
//   'desc'  => description of the property
//   'note'  => additional note about this property's schema
// )
//
// EndClass()


CODE;

foreach ($classes as $class) {
  define_class($class);
}

///////////////////////////////////////////////////////////////////////////////

print $output;

///////////////////////////////////////////////////////////////////////////////
// output helpers

function idx_flags($arr, $name, $global_function) {
  return get_flag_names($arr, $name, $global_function);
}

function idx_type($arr, $name) {
  return !empty($arr[$name]) ? get_idl_name($arr[$name]) : '';
}

function idx_string($arr, $name) {
  // not empty() testing to allow a string of '0'
  return array_key_exists($name, $arr) ? $arr[$name] : '';
}

function idx_array($arr, $name) {
  if (!empty($arr[$name])) {
    return "array('" . implode("', '", $arr[$name]) . "')";
  }
  return '';
}

function begin_function($name) {
  global $indent, $output;
  $output .= str_repeat(' ', $indent) . "$name(\n";
  $indent += 2;
}

function end_function() {
  global $indent, $output;
  $indent -= 2;
  $output .= str_repeat(' ', $indent) . ");\n\n";
}

function begin_array($leading = true) {
  global $indent, $output;
  if ($leading) {
    $output .= str_repeat(' ', $indent);
  }
  $output .= "array(\n";
  $indent += 2;
}

function end_array($trailing_comma=true) {
  global $indent, $output;
  $indent -= 2;
  $output .= str_repeat(' ', $indent) . ")";
  if ($trailing_comma) $output .= ",\n";
}

function push_globals($inc=4) {
  global $indent, $output, $saved;
  $saved = $output; $output = '';
  $indent += $inc;
}

function pop_globals($dec=4) {
  global $indent, $output, $saved;
  $ret = $output; $output = $saved;
  $indent -= $dec;
  return $ret;
}

function out_str($name, $var, $required=false, $formatted=false, $doc=false) {
  global $indent, $output;

  if ($required && ($var === null || $var === '')) {
    throw new Exception("missing definition for $name");
  }
  if ($required || !($var === null || $var === '')) {
    $name = str_pad("'$name'", 8);
    if (!$formatted) {
      $var = '"'.escape_php($var).'"';
    }
    $output .= str_repeat(' ', $indent) . "$name => ";
    if ($doc) {
      $output .= "<<<EOT\n$var\nEOT\n,\n";
    } else {
      $output .= "$var,\n";
    }
  }
}

function out_fmt($name, $var, $required=false) {
  return out_str($name, $var, $required, true);
}

function out_doc($name, $var, $required=false) {
  return out_str($name, $var, $required, true, true);
}

function define_class($class) {
  global $output, $net;

  $name = $class['name'];

  $desc = idx_string($class, 'desc');
  if ((empty($desc) || $net == 1) && $net != -1) {
    $desc = phpnet_get_class_desc($name);
  }

  $output .= "////////////////////////////////////////".
    "///////////////////////////////////////\n\n";
  begin_function('BeginClass');
  begin_array();
  out_str('name',   $name, true);
  out_str('parent', $class['parent']);
  out_fmt('ifaces', idx_array ($class, 'ifaces'));
  out_fmt('bases',  idx_array ($class, 'bases'));
  out_str('desc',   $desc);
  out_fmt('flags',  idx_flags ($class, 'flags', false));
  out_str('note',   idx_string($class, 'note'));
  out_doc('footer', idx_string($class, 'footer'));
  end_array(false);
  end_function();

  define_constants($class['consts']);

  foreach ($class['methods'] as $func) {
    define_function($func, $name);
  }

  define_properties($class['properties']);

  begin_function('EndClass');
  end_function();
}

function define_function($func, $clsname = 'function') {
  global $net;

  $phpnet = false;
  $desc = idx_string($func, 'desc');
  if ((empty($desc) || $net == 1) && $net != -1) {
    $phpnet = phpnet_get_function_info($func['name'], $clsname);
    if (!empty($phpnet['desc'])) $desc = ($phpnet['desc']);
  }

  // prepare return type
  $ret_desc = idx_string($func, 'ret_desc');
  if ((empty($ret_desc) || $net == 1) && $net != -1) {
    if (!empty($phpnet['ret'])) $ret_desc = $phpnet['ret'];
  }
  push_globals();
  begin_array(false);
  out_fmt('type', get_idl_name($func['return'], 'null'));
  out_str('desc', $ret_desc);
  end_array(false);
  $return = pop_globals();

  if ($func['args']) {
    push_globals();
    begin_array(false);
    $i = -1;
    foreach ($func['args'] as $arg) {
      $i++;
      $arg_desc = idx_string($arg, 'desc');
      if ((empty($arg_desc) || $net == 1) && $net != -1) {
        if (!empty($phpnet['params'][$i])) {
          $arg_desc = $phpnet['params'][$i];
        }
      }
      begin_array();
      out_str('name',  $arg['name'], true);
      out_fmt('type',  idx_type($arg, 'type'));
      out_str('value', idx_string($arg, 'default'));
      out_str('desc',  $arg_desc);
      end_array();
    }
    end_array(false);
    $args = pop_globals();
  } else {
    $args = '';
  }

  begin_function('DefineFunction');
  begin_array();
  out_str('name',   $func['name'], true);
  out_str('desc',   $desc);
  out_fmt('flags',  idx_flags($func, 'flags', $clsname == 'function'));
  out_str('opt',    idx_string($func, 'opt'));
  out_fmt('return', $return);
  out_fmt('args',   $args);
  out_str('note',   idx_string($func, 'note'));
  end_array(false);
  end_function();
}

function define_constants($consts) {
  foreach ($consts as $constant) {
    begin_function('DefineConstant');
    begin_array();
    out_str('name', $constant['name'], true);
    if (array_key_exists('value', $constant)) {
      out_fmt('value', php_escape_val($constant['value'], true), false);
    } else {
      out_fmt('type', idx_type($constant, 'type'), true);
    }
    out_str('note', idx_string($constant, 'note'));
    end_array(false);
    end_function();
  }
}

function define_properties($properties) {
  foreach ($properties as $property) {
    begin_function('DefineProperty');
    begin_array();
    out_str('name',  $property['name'], true);
    out_fmt('type',  idx_type  ($property, 'type'));
    out_fmt('flags', idx_flags ($property, 'flags', false));
    out_str('desc',  idx_string($property, 'desc'));
    out_str('note',  idx_string($property, 'note'));
    end_array(false);
    end_function();
  }
}
