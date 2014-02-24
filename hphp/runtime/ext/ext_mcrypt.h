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

#ifndef incl_HPHP_EXT_MCRYPT_H_
#define incl_HPHP_EXT_MCRYPT_H_

// >>>>>> Generated by idl.php. Do NOT modify. <<<<<<

#include "hphp/runtime/base/base-includes.h"

namespace HPHP {
///////////////////////////////////////////////////////////////////////////////

Variant f_mcrypt_module_open(const String& algorithm, const String& algorithm_directory, const String& mode, const String& mode_directory);
bool f_mcrypt_module_close(CResRef td);
Array f_mcrypt_list_algorithms(const String& lib_dir = null_string);
Array f_mcrypt_list_modes(const String& lib_dir = null_string);
int64_t f_mcrypt_module_get_algo_block_size(const String& algorithm, const String& lib_dir = null_string);
int64_t f_mcrypt_module_get_algo_key_size(const String& algorithm, const String& lib_dir = null_string);
Array f_mcrypt_module_get_supported_key_sizes(const String& algorithm, const String& lib_dir = null_string);
bool f_mcrypt_module_is_block_algorithm_mode(const String& mode, const String& lib_dir = null_string);
bool f_mcrypt_module_is_block_algorithm(const String& algorithm, const String& lib_dir = null_string);
bool f_mcrypt_module_is_block_mode(const String& mode, const String& lib_dir = null_string);
bool f_mcrypt_module_self_test(const String& algorithm, const String& lib_dir = null_string);
Variant f_mcrypt_create_iv(int size, int source = 0);
Variant f_mcrypt_encrypt(const String& cipher, const String& key, const String& data, const String& mode, const String& iv = null_string);
Variant f_mcrypt_decrypt(const String& cipher, const String& key, const String& data, const String& mode, const String& iv = null_string);
Variant f_mcrypt_cbc(const String& cipher, const String& key, const String& data, int mode, const String& iv = null_string);
Variant f_mcrypt_cfb(const String& cipher, const String& key, const String& data, int mode, const String& iv = null_string);
Variant f_mcrypt_ecb(const String& cipher, const String& key, const String& data, int mode, const String& iv = null_string);
Variant f_mcrypt_ofb(const String& cipher, const String& key, const String& data, int mode, const String& iv = null_string);
Variant f_mcrypt_get_block_size(const String& cipher, const String& module = null_string);
Variant f_mcrypt_get_cipher_name(const String& cipher);
Variant f_mcrypt_get_iv_size(const String& cipher, const String& mode);
int64_t f_mcrypt_get_key_size(const String& cipher, const String& module);
String f_mcrypt_enc_get_algorithms_name(CResRef td);
int64_t f_mcrypt_enc_get_block_size(CResRef td);
int64_t f_mcrypt_enc_get_iv_size(CResRef td);
int64_t f_mcrypt_enc_get_key_size(CResRef td);
String f_mcrypt_enc_get_modes_name(CResRef td);
Array f_mcrypt_enc_get_supported_key_sizes(CResRef td);
bool f_mcrypt_enc_is_block_algorithm_mode(CResRef td);
bool f_mcrypt_enc_is_block_algorithm(CResRef td);
bool f_mcrypt_enc_is_block_mode(CResRef td);
int64_t f_mcrypt_enc_self_test(CResRef td);
Variant f_mcrypt_generic(CResRef td, const String& data);
int64_t f_mcrypt_generic_init(CResRef td, const String& key, const String& iv);
Variant f_mdecrypt_generic(CResRef td, const String& data);
bool f_mcrypt_generic_deinit(CResRef td);
bool f_mcrypt_generic_end(CResRef td);

///////////////////////////////////////////////////////////////////////////////
}

#endif // incl_HPHP_EXT_MCRYPT_H_
