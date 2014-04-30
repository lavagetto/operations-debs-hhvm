<?hh // strict
/**
 * Copyright (c) 2014, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the "hack" directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 *
 */

function f(): int {
  switch (1) {
    case 1:
      $x = 1;
      break;
    case 2:
      switch ('x') {
        case 'x':
          $x = 2;
          break;
        default:
          $x = 4;
          break;
      }
      break;
    case 3:
      break;
  }

  return $x;
}
