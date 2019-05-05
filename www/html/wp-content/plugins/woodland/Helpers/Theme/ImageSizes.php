<?php namespace Woodland\Helpers\Theme;

/**
 * The ImageSizes class.
 */
class ImageSizes {

  /**
   * The ImageSizes class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_filter('intermediate_image_sizes_advanced', [$this, 'remove']);
    add_action('after_setup_theme', [$this, 'add']);
  }

  /**
   * Remove image sizes.
   *
   * @param $sizes The image sizes passed by WordPress
   */
  public function remove($sizes) {

    // The array of sizes to remove
    $toRemove = [
      'thumbnail',
      'medium',
      'medium_large',
      'large'
    ];

    foreach ($toRemove as $size) {
      unset($sizes[$size]);
    }

    return $sizes;
  }

  /**
   * Add image sizes.
   *
   * https://developer.wordpress.org/reference/functions/add_image_size/
   */
  public function add() {
    add_image_size('medium', 760, 9999);
  }
}
