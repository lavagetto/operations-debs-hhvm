<?hh
// @generated by idl-to-hni.php

/* @param string $str - The 8bit string to convert
 * @return mixed - Returns a quoted-printable string.
 */
<<__Native>>
function imap_8bit(string $str): mixed;

/* Returns all of the IMAP alert messages generated since the last
 * imap_alerts() call, or the beginning of the page.  When imap_alerts() is
 * called, the alert stack is subsequently cleared. The IMAP specification
 * requires that these messages be passed to the user.
 * @return mixed - Returns an array of all of the IMAP alert messages
 * generated or FALSE if no alert messages are available.
 */
<<__Native>>
function imap_alerts(): mixed;

/* Decodes the given BASE-64 encoded text.
 * @param string $text - The encoded text
 * @return mixed - Returns the decoded message as a string.
 */
<<__Native>>
function imap_base64(string $text): mixed;

/* @param string $str - The 8bit string
 * @return mixed - Returns a base64 encoded string.
 */
<<__Native>>
function imap_binary(string $str): mixed;

/* imap_body() returns the body of the message, numbered msg_number in the
 * current mailbox.  imap_body() will only return a verbatim copy of the
 * message body. To extract single parts of a multipart MIME-encoded message
 * you have to use imap_fetchstructure() to analyze its structure and
 * imap_fetchbody() to extract a copy of a single body component.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param int $options - The optional options are a bit mask with one or more
 * of the following: FT_UID - The msg_number is a UID FT_PEEK - Do not set the
 * \Seen flag if not already set FT_INTERNAL - The return string is in
 * internal format, will not canonicalize to CRLF.
 * @return mixed - Returns the body of the specified message, as a string.
 */
<<__Native>>
function imap_body(resource $imap_stream,
                   int $msg_number,
                   int $options = 0): mixed;

/* Read the structure of a specified body section of a specific message.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param string $section - The body section to read
 * @return mixed - Returns the information in an object, for a detailed
 * description of the object structure and properties see
 * imap_fetchstructure().
 */
<<__Native>>
function imap_bodystruct(resource $imap_stream,
                         int $msg_number,
                         string $section): mixed;

/* Checks information about the current mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return mixed
 */
<<__Native>>
function imap_check(resource $imap_stream): mixed;

/* This function causes a store to delete the specified flag to the flags set
 * for the messages in the specified sequence.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $sequence - A sequence of message numbers. You can enumerate
 * desired messages with the X,Y syntax, or retrieve all messages within an
 * interval with the X:Y syntax
 * @param string $flag
 * @param int $options - options are a bit mask and may contain the single
 * option: ST_UID - The sequence argument contains UIDs instead of sequence
 * numbers
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_clearflag_full(resource $imap_stream,
                             string $sequence,
                             string $flag,
                             int $options = 0): bool;

/* Closes the imap stream.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $flag - If set to CL_EXPUNGE, the function will silently expunge
 * the mailbox before closing, removing all messages marked for deletion. You
 * can achieve the same thing by using imap_expunge()
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_close(resource $imap_stream,
                    int $flag = 0): bool;

/* Creates a new mailbox specified by mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information. Names containing international characters should be encoded by
 * imap_utf7_encode()
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_createmailbox(resource $imap_stream,
                            string $mailbox): bool;

/* Marks messages listed in msg_number for deletion. Messages marked for
 * deletion will stay in the mailbox until either imap_expunge() is called or
 * imap_close() is called with the optional parameter CL_EXPUNGE.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $msg_number - The message number
 * @param int $options - You can set the FT_UID which tells the function to
 * treat the msg_number argument as an UID.
 * @return bool - Returns TRUE.
 */
<<__Native>>
function imap_delete(resource $imap_stream,
                     string $msg_number,
                     int $options = 0): bool;

/* Deletes the specified mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_deletemailbox(resource $imap_stream,
                            string $mailbox): bool;

/* Gets all of the IMAP errors (if any) that have occurred during this page
 * request or since the error stack was reset.  When imap_errors() is called,
 * the error stack is subsequently cleared.
 * @return mixed - This function returns an array of all of the IMAP error
 * messages generated since the last imap_errors() call, or the beginning of
 * the page. Returns FALSE if no error messages are available.
 */
<<__Native>>
function imap_errors(): mixed;

/* Deletes all the messages marked for deletion by imap_delete(),
 * imap_mail_move(), or imap_setflag_full().
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return bool - Returns TRUE.
 */
<<__Native>>
function imap_expunge(resource $imap_stream): bool;

/* This function fetches mail headers for the given sequence and returns an
 * overview of their contents.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $sequence - A message sequence description. You can enumerate
 * desired messages with the X,Y syntax, or retrieve all messages within an
 * interval with the X:Y syntax
 * @param int $options - sequence will contain a sequence of message indices
 * or UIDs, if this parameter is set to FT_UID.
 * @return mixed - Returns an array of objects describing one message header
 * each. The object will only define a property if it exists. The possible
 * properties are: subject - the messages subject from - who sent it to -
 * recipient date - when was it sent message_id - Message-ID references - is a
 * reference to this message id in_reply_to - is a reply to this message id
 * size - size in bytes uid - UID the message has in the mailbox msgno -
 * message sequence number in the mailbox recent - this message is flagged as
 * recent flagged - this message is flagged answered - this message is flagged
 * as answered deleted - this message is flagged for deletion seen - this
 * message is flagged as already read draft - this message is flagged as being
 * a draft
 */
<<__Native>>
function imap_fetch_overview(resource $imap_stream,
                             string $sequence,
                             int $options = 0): mixed;

/* Fetch of a particular section of the body of the specified messages. Body
 * parts are not decoded by this function.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param string $section - The part number. It is a string of integers
 * delimited by period which index into a body part list as per the IMAP4
 * specification
 * @param int $options - A bitmask with one or more of the following: FT_UID -
 * The msg_number is a UID FT_PEEK - Do not set the \Seen flag if not already
 * set FT_INTERNAL - The return string is in internal format, will not
 * canonicalize to CRLF.
 * @return mixed - Returns a particular section of the body of the specified
 * messages as a text string.
 */
<<__Native>>
function imap_fetchbody(resource $imap_stream,
                        int $msg_number,
                        string $section,
                        int $options = 0): mixed;

/* @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param int $options - The possible options are: FT_UID - The msgno argument
 * is a UID FT_INTERNAL - The return string is in "internal" format, without
 * any attempt to canonicalize to CRLF newlines FT_PREFETCHTEXT - The
 * RFC822.TEXT should be pre-fetched at the same time. This avoids an extra
 * RTT on an IMAP connection if a full message text is desired (e.g. in a
 * "save to local file" operation)
 * @return mixed - Returns the header of the specified message as a text
 * string.
 */
<<__Native>>
function imap_fetchheader(resource $imap_stream,
                          int $msg_number,
                          int $options = 0): mixed;

/* Fetches all the structured information for a given message.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param int $options - This optional parameter only has a single option,
 * FT_UID, which tells the function to treat the msg_number argument as a UID.
 * @return mixed
 */
<<__Native>>
function imap_fetchstructure(resource $imap_stream,
                             int $msg_number,
                             int $options = 0): mixed;

/* Purges the cache of entries of a specific type.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $caches - Specifies the cache to purge. It may one or a
 * combination of the following constants: IMAP_GC_ELT (message cache
 * elements), IMAP_GC_ENV (enveloppe and bodies), IMAP_GC_TEXTS (texts).
 * @return bool - Returns TRUE.
 */
<<__Native>>
function imap_gc(resource $imap_stream,
                 int $caches): bool;

/* Gets information about the given message number by reading its headers.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param int $fromlength - Number of characters for the fetchfrom property.
 * Must be greater than or equal to zero.
 * @param int $subjectlength - Number of characters for the fetchsubject
 * property Must be greater than or equal to zero.
 * @param string $defaulthost
 * @return mixed
 */
<<__Native>>
function imap_header(resource $imap_stream,
                     int $msg_number,
                     int $fromlength = 0,
                     int $subjectlength = 0,
                     string $defaulthost = ""): mixed;

/* Gets information about the given message number by reading its headers.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number
 * @param int $fromlength - Number of characters for the fetchfrom property.
 * Must be greater than or equal to zero.
 * @param int $subjectlength - Number of characters for the fetchsubject
 * property Must be greater than or equal to zero.
 * @param string $defaulthost
 * @return mixed
 */
<<__Native>>
function imap_headerinfo(resource $imap_stream,
                         int $msg_number,
                         int $fromlength = 0,
                         int $subjectlength = 0,
                         string $defaulthost = ""): mixed;

/* Gets the full text of the last IMAP error message that occurred on the
 * current page. The error stack is untouched; calling imap_last_error()
 * subsequently, with no intervening errors, will return the same error.
 * @return mixed - Returns the full text of the last IMAP error message that
 * occurred on the current page. Returns FALSE if no error messages are
 * available.
 */
<<__Native>>
function imap_last_error(): mixed;

/* Read the list of mailboxes.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $ref - ref should normally be just the server specification
 * as described in imap_open().
 * @param string $pattern - Specifies where in the mailbox hierarchy to start
 * searching.  There are two special characters you can pass as part of the
 * pattern: '*' and '%'. '*' means to return all mailboxes. If you pass
 * pattern as '*', you will get a list of the entire mailbox hierarchy. '%'
 * means to return the current level only. '%' as the pattern parameter will
 * return only the top level mailboxes; '~/mail/%' on UW_IMAPD will return
 * every mailbox in the ~/mail directory, but none in subfolders of that
 * directory.
 * @return mixed - Returns an array containing the names of the mailboxes.
 */
<<__Native>>
function imap_list(resource $imap_stream,
                   string $ref,
                   string $pattern): mixed;

/* Read the list of mailboxes.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $ref - ref should normally be just the server specification
 * as described in imap_open().
 * @param string $pattern - Specifies where in the mailbox hierarchy to start
 * searching.  There are two special characters you can pass as part of the
 * pattern: '*' and '%'. '*' means to return all mailboxes. If you pass
 * pattern as '*', you will get a list of the entire mailbox hierarchy. '%'
 * means to return the current level only. '%' as the pattern parameter will
 * return only the top level mailboxes; '~/mail/%' on UW_IMAPD will return
 * every mailbox in the ~/mail directory, but none in subfolders of that
 * directory.
 * @return mixed - Returns an array containing the names of the mailboxes.
 */
<<__Native>>
function imap_listmailbox(resource $imap_stream,
                          string $ref,
                          string $pattern): mixed;

/* Copies mail messages specified by msglist to specified mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $msglist
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @param int $options - options is a bitmask of one or more of CP_UID - the
 * sequence numbers contain UIDS CP_MOVE - Delete the messages from the
 * current mailbox after copying
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_mail_copy(resource $imap_stream,
                        string $msglist,
                        string $mailbox,
                        int $options = 0): bool;

/* Moves mail messages specified by msglist to the specified mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $msglist
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @param int $options - options is a bitmask and may contain the single
 * option: CP_UID - the sequence numbers contain UIDS
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_mail_move(resource $imap_stream,
                        string $msglist,
                        string $mailbox,
                        int $options = 0): bool;

/* @param string $to - The receiver
 * @param string $subject - The mail subject
 * @param string $message - The mail body
 * @param string $additional_headers - As string with additional headers to be
 * set on the mail
 * @param string $cc
 * @param string $bcc - The receivers specified in bcc will get the mail, but
 * are excluded from the headers.
 * @param string $rpath - Use this parameter to specify return path upon mail
 * delivery failure. This is useful when using PHP as a mail client for
 * multiple users.
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_mail(string $to,
                   string $subject,
                   string $message,
                   string $additional_headers = "",
                   string $cc = "",
                   string $bcc = "",
                   string $rpath = ""): bool;

/* Checks the current mailbox status on the server. It is similar to
 * imap_status(), but will additionally sum up the size of all messages in the
 * mailbox, which will take some additional time to execute.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return mixed - Returns the information in an object with following
 * properties: Mailbox properties Date date of last change (current datetime)
 * Driver driver Mailbox name of the mailbox Nmsgs number of messages Recent
 * number of recent messages Unread number of unread messages Deleted number
 * of deleted messages Size mailbox size  Returns FALSE on failure.
 */
<<__Native>>
function imap_mailboxmsginfo(resource $imap_stream): mixed;

/* Returns the message sequence number for the given uid.  This function is
 * the inverse of imap_uid().
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $uid - The message UID
 * @return mixed - Returns the message sequence number for the given uid.
 */
<<__Native>>
function imap_msgno(resource $imap_stream,
                    int $uid): mixed;

/* Gets the number of messages in the current mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return mixed - Return the number of messages in the current mailbox, as an
 * integer.
 */
<<__Native>>
function imap_num_msg(resource $imap_stream): mixed;

/* Gets the number of recent messages in the current mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return mixed - Returns the number of recent messages in the current
 * mailbox, as an integer.
 */
<<__Native>>
function imap_num_recent(resource $imap_stream): mixed;

/* Opens an IMAP stream to a mailbox.  This function can also be used to open
 * streams to POP3 and NNTP servers, but some functions and features are only
 * available on IMAP servers.
 * @param string $mailbox - A mailbox name consists of a server and a mailbox
 * path on this server. The special name INBOX stands for the current users
 * personal mailbox. Mailbox names that contain international characters
 * besides those in the printable ASCII space have to be encoded width
 * imap_utf7_encode().  The server part, which is enclosed in '{' and '}',
 * consists of the servers name or ip address, an optional port (prefixed by
 * ':'), and an optional protocol specification (prefixed by '/').  The server
 * part is mandatory in all mailbox parameters.  All names which start with {
 * are remote names, and are in the form "{" remote_system_name [":" port]
 * [flags] "}" [mailbox_name] where: remote_system_name - Internet domain name
 * or bracketed IP address of server. port - optional TCP port number, default
 * is the default port for that service flags - optional flags, see following
 * table. mailbox_name - remote mailbox name, default is INBOX  Optional flags
 * for names Flag Description /service=service mailbox access service, default
 * is "imap" /user=user remote user name for login on the server
 * /authuser=user remote authentication user; if specified this is the user
 * name whose password is used (e.g. administrator) /anonymous remote access
 * as anonymous user /debug record protocol telemetry in application's debug
 * log /secure do not transmit a plaintext password over the network /imap,
 * /imap2, /imap2bis, /imap4, /imap4rev1 equivalent to /service=imap /pop3
 * equivalent to /service=pop3 /nntp equivalent to /service=nntp /norsh do not
 * use rsh or ssh to establish a preauthenticated IMAP session /ssl use the
 * Secure Socket Layer to encrypt the session /validate-cert validate
 * certificates from TLS/SSL server (this is the default behavior)
 * /novalidate-cert do not validate certificates from TLS/SSL server, needed
 * if server uses self-signed certificates /tls force use of start-TLS to
 * encrypt the session, and reject connection to servers that do not support
 * it /notls do not do start-TLS to encrypt the session, even with servers
 * that support it /readonly request read-only mailbox open (IMAP only;
 * ignored on NNTP, and an error with SMTP and POP3)
 * @param string $username - The user name
 * @param string $password - The password associated with the username
 * @param int $options - The options are a bit mask with one or more of the
 * following: OP_READONLY - Open mailbox read-only OP_ANONYMOUS - Don't use or
 * update a .newsrc for news (NNTP only) OP_HALFOPEN - For IMAP and NNTP
 * names, open a connection but don't open a mailbox. CL_EXPUNGE - Expunge
 * mailbox automatically upon mailbox close (see also imap_delete() and
 * imap_expunge()) OP_DEBUG - Debug protocol negotiations OP_SHORTCACHE -
 * Short (elt-only) caching OP_SILENT - Don't pass up events (internal use)
 * OP_PROTOTYPE - Return driver prototype OP_SECURE - Don't do non-secure
 * authentication
 * @param int $retries - Number of maximum connect attempts
 * @return mixed - Returns an IMAP stream on success or FALSE on error.
 */
<<__Native>>
function imap_open(string $mailbox,
                   string $username,
                   string $password,
                   int $options = 0,
                   int $retries = 0): mixed;

/* imap_ping() pings the stream to see if it's still active. It may discover
 * new mail; this is the preferred method for a periodic "new mail check" as
 * well as a "keep alive" for servers which have inactivity timeout.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @return bool - Returns TRUE if the stream is still alive, FALSE otherwise.
 */
<<__Native>>
function imap_ping(resource $imap_stream): bool;

/* @param string $str - A quoted-printable string
 * @return mixed - Returns an 8 bits string.
 */
<<__Native>>
function imap_qprint(string $str): mixed;

/* This function renames on old mailbox to new mailbox (see imap_open() for
 * the format of mbox names).
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $old_mbox - The old mailbox name, see imap_open() for more
 * information
 * @param string $new_mbox - The new mailbox name, see imap_open() for more
 * information
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_renamemailbox(resource $imap_stream,
                            string $old_mbox,
                            string $new_mbox): bool;

/* Reopens the specified stream to a new mailbox on an IMAP or NNTP server.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @param int $options - The options are a bit mask with one or more of the
 * following: OP_READONLY - Open mailbox read-only OP_ANONYMOUS - Don't use or
 * update a .newsrc for news (NNTP only) OP_HALFOPEN - For IMAP and NNTP
 * names, open a connection but don't open a mailbox. OP_EXPUNGE - Silently
 * expunge recycle stream CL_EXPUNGE - Expunge mailbox automatically upon
 * mailbox close (see also imap_delete() and imap_expunge())
 * @param int $retries - Number of maximum connect attempts
 * @return bool - Returns TRUE if the stream is reopened, FALSE otherwise.
 */
<<__Native>>
function imap_reopen(resource $imap_stream,
                     string $mailbox,
                     int $options = 0,
                     int $retries = 0): bool;

/* @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $criteria - A string, delimited by spaces, in which the
 * following keywords are allowed. Any multi-word arguments (e.g. FROM "joey
 * smith") must be quoted. ALL - return all messages matching the rest of the
 * criteria ANSWERED - match messages with the \\ANSWERED flag set BCC
 * "string" - match messages with "string" in the Bcc: field BEFORE "date" -
 * match messages with Date: before "date" BODY "string" - match messages with
 * "string" in the body of the message CC "string" - match messages with
 * "string" in the Cc: field DELETED - match deleted messages FLAGGED - match
 * messages with the \\FLAGGED (sometimes referred to as Important or Urgent)
 * flag set FROM "string" - match messages with "string" in the From: field
 * KEYWORD "string" - match messages with "string" as a keyword NEW - match
 * new messages OLD - match old messages ON "date" - match messages with Date:
 * matching "date" RECENT - match messages with the \\RECENT flag set SEEN -
 * match messages that have been read (the \\SEEN flag is set) SINCE "date" -
 * match messages with Date: after "date" SUBJECT "string" - match messages
 * with "string" in the Subject: TEXT "string" - match messages with text
 * "string" TO "string" - match messages with "string" in the To: UNANSWERED -
 * match messages that have not been answered UNDELETED - match messages that
 * are not deleted UNFLAGGED - match messages that are not flagged UNKEYWORD
 * "string" - match messages that do not have the keyword "string" UNSEEN -
 * match messages which have not been read yet
 * @param int $options - Valid values for options are SE_UID, which causes the
 * returned array to contain UIDs instead of messages sequence numbers.
 * @param string $charset
 * @return mixed - Returns an array of message numbers or UIDs.  Return FALSE
 * if it does not understand the search criteria or no messages have been
 * found.
 */
<<__Native>>
function imap_search(resource $imap_stream,
                     string $criteria,
                     int $options = 0,
                     string $charset = ""): mixed;

/* Causes a store to add the specified flag to the flags set for the messages
 * in the specified sequence.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $sequence - A sequence of message numbers. You can enumerate
 * desired messages with the X,Y syntax, or retrieve all messages within an
 * interval with the X:Y syntax
 * @param string $flag
 * @param int $options - A bit mask that may contain the single option: ST_UID
 * - The sequence argument contains UIDs instead of sequence numbers
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_setflag_full(resource $imap_stream,
                           string $sequence,
                           string $flag,
                           int $options = 0): bool;

/* Gets status information about the given mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @param int $options - Valid flags are: SA_MESSAGES - set $status->messages
 * to the number of messages in the mailbox SA_RECENT - set $status->recent to
 * the number of recent messages in the mailbox SA_UNSEEN - set
 * $status->unseen to the number of unseen (new) messages in the mailbox
 * SA_UIDNEXT - set $status->uidnext to the next uid to be used in the mailbox
 * SA_UIDVALIDITY - set $status->uidvalidity to a constant that changes when
 * uids for the mailbox may no longer be valid SA_ALL - set all of the above
 * @return mixed - This function returns an object containing status
 * information. The object has the following properties: messages, recent,
 * unseen, uidnext, and uidvalidity.  flags is also set, which contains a
 * bitmask which can be checked against any of the above constants.
 */
<<__Native>>
function imap_status(resource $imap_stream,
                     string $mailbox,
                     int $options = 0): mixed;

/* Subscribe to a new mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_subscribe(resource $imap_stream,
                        string $mailbox): bool;

/* Sets or fetches the imap timeout.
 * @param int $timeout_type - One of the following: IMAP_OPENTIMEOUT,
 * IMAP_READTIMEOUT, IMAP_WRITETIMEOUT, or IMAP_CLOSETIMEOUT.
 * @param int $timeout - The timeout, in seconds.
 * @return mixed - If the timeout parameter is set, this function returns TRUE
 * on success and FALSE on failure.  If timeout is not provided or evaluates
 * to -1, the current timeout value of timeout_type is returned as an integer.
 */
<<__Native>>
function imap_timeout(int $timeout_type,
                      int $timeout = -1): mixed;

/* This function returns the UID for the given message sequence number. An UID
 * is a unique identifier that will not change over time while a message
 * sequence number may change whenever the content of the mailbox changes. 
 * This function is the inverse of imap_msgno().
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param int $msg_number - The message number.
 * @return mixed - The UID of the given message.
 */
<<__Native>>
function imap_uid(resource $imap_stream,
                  int $msg_number): mixed;

/* Removes the deletion flag for a specified message, which is set by
 * imap_delete() or imap_mail_move().
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $msg_number - The message number
 * @param int $flags
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_undelete(resource $imap_stream,
                       string $msg_number,
                       int $flags = 0): bool;

/* Unsubscribe from the specified mailbox.
 * @param resource $imap_stream - An IMAP stream returned by imap_open().
 * @param string $mailbox - The mailbox name, see imap_open() for more
 * information
 * @return bool - Returns TRUE on success or FALSE on failure.
 */
<<__Native>>
function imap_unsubscribe(resource $imap_stream,
                          string $mailbox): bool;

/* Converts the given mime_encoded_text to UTF-8.
 * @param string $mime_encoded_text
 * @return mixed - Returns an UTF-8 encoded string.
 */
<<__Native>>
function imap_utf8(string $mime_encoded_text): mixed;
