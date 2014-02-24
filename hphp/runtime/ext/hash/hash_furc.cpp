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

/**
 * FurcHash -- a consistent hash function using a binary decision tree.
 * Based on an algorithm by Mark Rabkin with two changes:
 *    1) Uses MurmurHash64A to hash the original key and to generate
 *       additional bits by recursively rehashing.
 *    2) The original recursive algorithm for the decision tree has been
 *       made iterative.
 *
 * Assumes that |m| is 8 million or less (2^FURC_SHIFT).  Making FURC_SHIFT
 * bigger also makes furc_hash modestly slower.
 *
 * Performance is in the sub-500ns range to over 100,000 shards with 13-byte
 * keys.  This version of furc_hash is fairly insensitive to key length since
 * additional bits are generated by re-hashing the initial MurmurHash64A.
 */

#include <assert.h>
#include <stdint.h>
#include <sys/time.h>
#include <stdio.h>
#include <string.h>
#include <math.h>

#include "hphp/runtime/ext/hash/hash_murmur.h"

namespace HPHP {
///////////////////////////////////////////////////////////////////////////////


/* Maximum number tries for in-range result before just returning 0. */
#define MAX_TRIES 32

/* Gap in bit index per try; limits us to 2^FURC_SHIFT shards.  Making this
 * larger will sacrifice a modest amount of performance.
 */
#define FURC_SHIFT 23

/* Size of cache for hash values; should be > MAXTRIES * (FURCSHIFT + 1) */
#define FURC_CACHE_SIZE 1024


/**
 * furc_get_bit -- the bitstream generator
 *
 * Given a key and an index, provides a pseudorandom bit dependent on both.
 * Caches hash values; a NULL key clears the cache.
 */
static uint32_t furc_get_bit(const char* const key, const size_t len,
                             const uint32_t idx, uint64_t* hash,
                             int32_t* old_ord_p) {
    int32_t ord = (idx >> 6);
    int n;

    if (key == NULL) {
        *old_ord_p = -1;
        return 0;
    }

    if (*old_ord_p < ord) {
        for (n = *old_ord_p + 1; n <= ord; n++) {
            hash[n] = ((n == 0)
                       ? murmur_hash_64A(key, len, SEED)
                       : murmur_rehash_64A(hash[n-1]));
        }
        *old_ord_p = ord;
    }

    return (hash[ord] >> (idx&0x3f)) & 0x1;
}

inline uint32_t furc_maximum_pool_size(void) {
    return (1 << FURC_SHIFT);
}

uint32_t furc_hash_internal(const char* const key, const size_t len, const uint32_t m) {
    uint32_t tries;
    uint32_t d;
    uint32_t num;
    uint32_t i;
    uint32_t a;
    uint64_t hash[FURC_CACHE_SIZE];
    int32_t old_ord;

    assert(m <= furc_maximum_pool_size());

    if (m <= 1) {
        return 0;
    }

    furc_get_bit(NULL, 0, 0, hash, &old_ord);
    for (d = 0; m > (1ul << d); d++)
        ;

    a = d;
    for (tries = 0; tries < MAX_TRIES; tries++) {
        while (!furc_get_bit(key, len, a, hash, &old_ord)) {
            if (--d == 0) {
                return 0;
            }
            a = d;
        }
        a += FURC_SHIFT;
        num = 1;
        for (i = 0; i < d-1; i++) {
            num = (num << 1) | furc_get_bit(key, len, a, hash, &old_ord);
            a += FURC_SHIFT;
        }
        if (num < m) {
            return num;
        }
    }

    // Give up; return 0, which is a legal value in all cases.
    return 0;
}

///////////////////////////////////////////////////////////////////////////////
}
