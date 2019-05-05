<?php

/**
 * PHPUnit bootstrap file
 */
$_tests_dir = getenv('WP_TESTS_DIR');
if (!$_tests_dir) {
  $_tests_dir = '/tmp/wordpress-tests-lib';
}

// Require core testing functions.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load plugins needed for testing.
 */
function _manually_load_plugins() {
  require dirname(dirname(__FILE__)) . '/../advanced-custom-fields-pro/acf.php';
  require dirname(dirname(__FILE__)) . '/woodland.php';
}
tests_add_filter('muplugins_loaded', '_manually_load_plugins');

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
