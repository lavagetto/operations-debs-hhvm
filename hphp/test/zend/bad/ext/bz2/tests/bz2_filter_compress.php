<?php /* $Id$ */
$text = 'I am the very model of a modern major general, I\'ve information vegetable, animal, and mineral.';

$fp = fopen('php://stdout', 'w');
stream_filter_append($fp, 'bzip2.compress', STREAM_FILTER_WRITE);
stream_filter_append($fp, 'convert.base64-encode', STREAM_FILTER_WRITE);
fwrite($fp, $text);
fclose($fp);

?> 