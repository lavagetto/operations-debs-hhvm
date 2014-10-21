/*
   +----------------------------------------------------------------------+
   | HipHop for PHP                                                       |
   +----------------------------------------------------------------------+
   | Copyright (c) 2010-2014 Facebook, Inc. (http://www.facebook.com)     |
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

#ifndef incl_HPHP_PROGRAM_FUNCTIONS_H_
#define incl_HPHP_PROGRAM_FUNCTIONS_H_

#include "hphp/runtime/base/types.h"

// Needed for compatibility with oniguruma-5.9.4+
#define ONIG_ESCAPE_UCHAR_COLLISION

namespace HPHP {
///////////////////////////////////////////////////////////////////////////////

/**
 * Main entry point of the entire program.
 */
int execute_program(int argc, char **argv);
void execute_command_line_begin(int argc, char **argv, int xhprof,
                                const std::vector<std::string>& config);
void execute_command_line_end(int xhprof, bool coverage, const char *program);

/**
 * Setting up environment variables.
 */
void process_env_variables(Array& variables);

/**
 * Read and process all the ini settings from the ini configuration file
 */
void process_ini_file(const std::string& filename);

/**
 * Process one or more ini settings in the form of key=value
 * Provide an optional filename from where the settings were retrieved.
 * Function normally called directly when -d is used and called from
 * process_ini_file() when the settings were from a file.
 */
void process_ini_settings(const std::string& name,
                          const std::string& filename = "");

/**
 * Inserting a variable into specified symbol table.
 *
 * "overwrite" parameter is only for cookies:
 * According to rfc2965, more specific paths are listed above the less
 * specific ones. If we encounter a duplicate cookie name, we should
 * skip it, since it is not possible to have the same (plain text)
 * cookie name for the same path and we should not overwrite more
 * specific cookies with the less specific ones.
 */
void register_variable(Array& variables,
                       char* name,
                       const Variant& value,
                       bool overwrite = true);

String canonicalize_path(const String& path, const char* root, int rootLen);

/**
 * Translate hex encode stack into both C++ and PHP frames.
 */
std::string translate_stack(const char *hexencoded,
                            bool with_frame_numbers = true);

time_t start_time();

///////////////////////////////////////////////////////////////////////////////

class ExecutionContext;

void pcre_init();
void pcre_reinit();
void pcre_session_exit();
void hphp_process_init();
void hphp_session_init();

ExecutionContext* hphp_context_init();
bool hphp_invoke_simple(const std::string& filename, bool warmupOnly);
bool hphp_invoke(ExecutionContext *context,
                 const std::string &cmd,
                 bool func,
                 const Array& funcParams,
                 VRefParam funcRet,
                 const std::string &reqInitFunc,
                 const std::string &reqInitDoc,
                 bool &error,
                 std::string &errorMsg,
                 bool once,
                 bool warmupOnly,
                 bool richErrorMsg);
void hphp_context_shutdown();
void hphp_context_exit(bool shutdown = true);

void hphp_thread_exit();
void hphp_session_exit();
void hphp_process_exit();
std::string get_systemlib(std::string* hhas = nullptr,
                          const std::string &section = "systemlib",
                          const std::string &filename = "");

// Generated by hphp/util/generate-buildinfo.sh.
extern const char* const kCompilerId;

// Helper function for stats tracking with exceptions.
void bump_counter_and_rethrow(bool isPsp);

///////////////////////////////////////////////////////////////////////////////
}

#endif // incl_HPHP_PROGRAM_FUNCTIONS_H_
