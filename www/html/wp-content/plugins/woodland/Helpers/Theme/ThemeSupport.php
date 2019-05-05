<?php namespace Woodland\Helpers\Theme;

/**
 * The ThemeSupport class.
 */
class ThemeSupport {

  /**
   * The ThemeSupport class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('after_setup_theme', [$this, 'add']);
  }

  /**
   * Add theme support.
   */
  public function add() {

    // https://github.com/roots/soil
    add_theme_support('soil-clean-up');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-js-to-footer');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    // https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
    add_theme_support('title-tag');

    // https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
    add_theme_support('post-thumbnails');

    // https://developer.wordpress.org/reference/functions/add_theme_support/#html5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
  }
}
