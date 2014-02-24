<?php
function my_error_handler($errno, $errmsg, $filename, $linenum, $vars)
{
	echo "$errno: $errmsg\n";
}
set_error_handler('my_error_handler');

function do_single_test($header)
{
	global $mode;

	$result = iconv_mime_decode($header, $mode, "UTF-8");
	printf("(%d) \"%s\"\n", iconv_strlen($result, "UTF-8"), $result);
}

function do_regression_test()
{
	do_single_test(<<< HERE
Subject: =?ISO-8859-1?Q?Pr=FCfung?=
	=?ISO-8859-1*de_DE?Q?Pr=FCfung?=\t
 	 =?ISO-8859-2?Q?k=F9=D4=F1=D3let?=
HERE
);
	do_single_test(<<< HERE
Subject: =?ISO-8859-1?Q?Pr=FCfung?= =?ISO-8859-1*de_DE?Q?=20Pr=FCfung?= \t  =?ISO-8859-2?Q?k=F9=D4=F1=D3let?=
HERE
);
	do_single_test(<<< HERE
Subject: =?ISO-8859-1?Q?Pr=FCfung?==?ISO-8859-1*de_DE?Q?Pr=FCfung?==?ISO-8859-2?Q?k=F9=D4=F1=D3let?=
HERE
);
	do_single_test(<<< HERE
Subject: =?ISO-8859-1?Q?Pr=FCfung?= =?ISO-8859-1*de_DE?Q?Pr=FCfung??   =?ISO-8859-2?X?k=F9=D4=F1=D3let?=
HERE
);
	do_single_test(<<< HERE
From: =?ISO-2022-JP?B?GyRCJTUbKEI=?=
 =?ISO-2022-JP?B?GyRCJXMlVxsoQg==?=
 =?ISO-2022-JP?B?GyRCJWtKOBsoQg==?=
 =?ISO-2022-JP?B?GyRCO3pOcxsoQg==?=
 =?ISO-2022-JP?B?GyRCJTUlcxsoQg==?=
 =?ISO-2022-JP?B?GyRCJVclaxsoQg==?=
 =?ISO-2022-JP?B?GyRCSjg7ehsoQg==?=
 =?ISO-2022-JP?B?GyRCTnNGfBsoQg==?=
 =?ISO-2022-JP?B?GyRCS1w4bBsoQg==?=
 =?ISO-2022-JP?B?GyRCJUYlLRsoQg==?=
 =?ISO-2022-JP?B?GyRCJTklSBsoQg==?=
HERE
);
}

$mode = 0;
do_regression_test();
$mode = ICONV_MIME_DECODE_STRICT;
do_regression_test();
$mode = ICONV_MIME_DECODE_CONTINUE_ON_ERROR;
do_regression_test();
$mode = ICONV_MIME_DECODE_STRICT | ICONV_MIME_DECODE_CONTINUE_ON_ERROR;
do_regression_test();