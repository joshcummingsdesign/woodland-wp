<?php

/**
 * Check for staging environment.
 *
 * @return bool
 */
function wlIsStaging() {
  return defined('WP_ENV') && WP_ENV === 'staging';
}

/**
 * Check for production environment.
 *
 * @return bool
 */
function wlIsProd() {
  return defined('WP_ENV') && WP_ENV === 'prod';
}
