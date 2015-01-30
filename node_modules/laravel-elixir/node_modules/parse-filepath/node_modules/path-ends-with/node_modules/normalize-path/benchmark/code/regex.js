'use strict';

/**
 * Regex only, without node.js path
 */

module.exports = function(filepath) {
  return filepath
    .replace(/[\\\/]+/g, '/')
    .replace(/^\.[\\\/]/g, '')
    .replace(/\/$/g, '')
    .toLowerCase();
};
