/*
   +----------------------------------------------------------------------+
   | HipHop for PHP                                                       |
   +----------------------------------------------------------------------+
   | Copyright (c) 2010-2013 Facebook, Inc. (http://www.facebook.com)     |
   | Copyright (c) 1997-2010 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
*/

#ifndef incl_HPHP_EXT_MB_H_
#define incl_HPHP_EXT_MB_H_

// >>>>>> Generated by idl.php. Do NOT modify. <<<<<<

#include "hphp/runtime/base/base-includes.h"

namespace HPHP {
///////////////////////////////////////////////////////////////////////////////

Array f_mb_list_encodings();
Variant f_mb_list_encodings_alias_names(const String& name = null_string);
Variant f_mb_list_mime_names(const String& name = null_string);
bool f_mb_check_encoding(const String& var = null_string, const String& encoding = null_string);
Variant f_mb_convert_case(const String& str, int mode, const String& encoding = null_string);
Variant f_mb_convert_encoding(const String& str, const String& to_encoding, CVarRef from_encoding = null_variant);
Variant f_mb_convert_kana(const String& str, const String& option = null_string, const String& encoding = null_string);
Variant f_mb_convert_variables(int _argc, const String& to_encoding, CVarRef from_encoding, VRefParam vars, CArrRef _argv = null_array);
Variant f_mb_decode_mimeheader(const String& str);
Variant f_mb_decode_numericentity(const String& str, CVarRef convmap, const String& encoding = null_string);
Variant f_mb_detect_encoding(const String& str, CVarRef encoding_list = null_variant, CVarRef strict = null_variant);
Variant f_mb_detect_order(CVarRef encoding_list = null_variant);
Variant f_mb_encode_mimeheader(const String& str, const String& charset = null_string, const String& transfer_encoding = null_string, const String& linefeed = "\r\n", int indent = 0);
Variant f_mb_encode_numericentity(const String& str, CVarRef convmap, const String& encoding = null_string);
bool f_mb_ereg_match(const String& pattern, const String& str, const String& option = null_string);
Variant f_mb_ereg_replace(CVarRef pattern, const String& replacement, const String& str, const String& option = null_string);
int64_t f_mb_ereg_search_getpos();
Variant f_mb_ereg_search_getregs();
bool f_mb_ereg_search_init(const String& str, const String& pattern = null_string, const String& option = null_string);
Variant f_mb_ereg_search_pos(const String& pattern = null_string, const String& option = null_string);
Variant f_mb_ereg_search_regs(const String& pattern = null_string, const String& option = null_string);
bool f_mb_ereg_search_setpos(int position);
Variant f_mb_ereg_search(const String& pattern = null_string, const String& option = null_string);
Variant f_mb_ereg(CVarRef pattern, const String& str, VRefParam regs = uninit_null());
Variant f_mb_eregi_replace(CVarRef pattern, const String& replacement, const String& str, const String& option = null_string);
Variant f_mb_eregi(CVarRef pattern, const String& str, VRefParam regs = uninit_null());
Variant f_mb_get_info(const String& type = null_string);
Variant f_mb_http_input(const String& type = null_string);
Variant f_mb_http_output(const String& encoding = null_string);
Variant f_mb_internal_encoding(const String& encoding = null_string);
Variant f_mb_language(const String& language = null_string);
String f_mb_output_handler(const String& contents, int status);
bool f_mb_parse_str(const String& encoded_string, VRefParam result = uninit_null());
Variant f_mb_preferred_mime_name(const String& encoding);
Variant f_mb_regex_encoding(const String& encoding = null_string);
String f_mb_regex_set_options(const String& options = null_string);
bool f_mb_send_mail(const String& to, const String& subject, const String& message, const String& headers = null_string, const String& extra_cmd = null_string);
Variant f_mb_split(const String& pattern, const String& str, int count = -1);
Variant f_mb_strcut(const String& str, int start, int length = 0x7FFFFFFF, const String& encoding = null_string);
Variant f_mb_strimwidth(const String& str, int start, int width, const String& trimmarker = null_string, const String& encoding = null_string);
Variant f_mb_stripos(const String& haystack, const String& needle, int offset = 0, const String& encoding = null_string);
Variant f_mb_stristr(const String& haystack, const String& needle, bool part = false, const String& encoding = null_string);
Variant f_mb_strlen(const String& str, const String& encoding = null_string);
Variant f_mb_strpos(const String& haystack, const String& needle, int offset = 0, const String& encoding = null_string);
Variant f_mb_strrchr(const String& haystack, const String& needle, bool part = false, const String& encoding = null_string);
Variant f_mb_strrichr(const String& haystack, const String& needle, bool part = false, const String& encoding = null_string);
Variant f_mb_strripos(const String& haystack, const String& needle, int offset = 0, const String& encoding = null_string);
Variant f_mb_strrpos(const String& haystack, const String& needle, CVarRef offset = 0LL, const String& encoding = null_string);
Variant f_mb_strstr(const String& haystack, const String& needle, bool part = false, const String& encoding = null_string);
Variant f_mb_strtolower(const String& str, const String& encoding = null_string);
Variant f_mb_strtoupper(const String& str, const String& encoding = null_string);
Variant f_mb_strwidth(const String& str, const String& encoding = null_string);
Variant f_mb_substitute_character(CVarRef substrchar = null_variant);
Variant f_mb_substr_count(const String& haystack, const String& needle, const String& encoding = null_string);
Variant f_mb_substr(const String& str, int start, int length = 0x7FFFFFFF, const String& encoding = null_string);

///////////////////////////////////////////////////////////////////////////////
}

#endif // incl_HPHP_EXT_MB_H_
