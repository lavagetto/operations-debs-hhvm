<?php
$fp = fopen(dirname(__FILE__).'/iconv_stream_filter.txt', 'rb');
var_dump(bin2hex(fread($fp, 10)));
var_dump(bin2hex(fread($fp, 5)));
var_dump(bin2hex(fread($fp, 1)));
fclose($fp);

$fp = fopen(dirname(__FILE__).'/iconv_stream_filter.txt', 'rb');
stream_filter_append($fp, 'convert.iconv.ISO-2022-JP/EUC-JP');
var_dump(bin2hex(fread($fp, 10)));
var_dump(bin2hex(fread($fp, 5)));
var_dump(bin2hex(fread($fp, 1)));
fclose($fp);

$fp = fopen(dirname(__FILE__).'/iconv_stream_filter.txt', 'rb');
stream_filter_append($fp, 'convert.iconv.ISO-2022-JP.EUC-JP');
var_dump(bin2hex(fread($fp, 10)));
var_dump(bin2hex(fread($fp, 5)));
var_dump(bin2hex(fread($fp, 1)));
fclose($fp);

$fp = fopen(dirname(__FILE__).'/iconv_stream_filter.txt', 'rb');
stream_filter_append($fp, 'convert.iconv.ISO-2022-JP\0EUC-JP');
var_dump(bin2hex(fread($fp, 10)));
var_dump(bin2hex(fread($fp, 5)));
var_dump(bin2hex(fread($fp, 1)));
fclose($fp);
?>