<?php

/**
 * Check for staging environment.
 *
 * @return bool
 */
function gzIsStaging() {
  return defined('WP_ENV') && WP_ENV === 'staging';
}

/**
 * Check for production environment.
 *
 * @return bool
 */
function gzIsProd() {
  return defined('WP_ENV') && WP_ENV === 'prod';
}
