<?php namespace Woodland\Helpers\Theme;

use Woodland\Helpers\AssetPath as AssetPath;

/**
 * The ThemeAssets class.
 */
class ThemeAssets {

  /**
   * The ThemeAssets class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('wp_enqueue_scripts', [$this, 'enqueue'], 100);
  }

  /**
   * Enqueue assets for the theme.
   */
  public function enqueue() {

    // Enqueue jQuery from Google CDN
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', [], null);

    // main.css
    wp_enqueue_style(
      'grizzly/css',
      AssetPath::get('styles/main.css'),
      [],
      null
    );

    // vendor.js
    wp_enqueue_script(
      'grizzly/vendor-js',
      AssetPath::get('scripts/vendor.js'),
      ['jquery'],
      null,
      true
    );

    // app.js
    wp_enqueue_script(
      'grizzly/js',
      AssetPath::get('scripts/app.js'),
      ['jquery', 'grizzly/vendor-js'],
      null,
      true
    );
  }
}
