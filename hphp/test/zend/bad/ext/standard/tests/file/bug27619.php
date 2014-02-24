<?php
	$fp = tmpfile();
	fwrite($fp, "this is a lowercase string.\n");
	rewind($fp);

	/* Echo out the first four bytes 'this' without applying filter
	   Remainder will get sucked into the read buffer though. */
	echo fread($fp, 4);

	stream_filter_append($fp, "string.toupper");

	fpassthru($fp);
?>