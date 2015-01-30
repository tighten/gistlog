'use strict';

/**
 * This lib.
 */

var path = require('path');

module.exports = function(filepath) {
  return path.normalize(filepath)
    .replace(/\\+/g, '/')
    .replace(/\/$/g, '')
    .toLowerCase();
};