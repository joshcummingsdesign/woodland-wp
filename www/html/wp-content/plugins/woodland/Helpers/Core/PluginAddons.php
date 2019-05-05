<?php namespace Woodland\Helpers\Core;

/**
 * The PluginAddons class.
 */
class PluginAddons {

  /**
   * The PluginAddons class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_filter('wpseo_metabox_prio', [$this, 'yoasttobottom']);
  }

  /**
   * Move the Yoast metabox to the bottom of edit post pages.
   */
  public function yoasttobottom() {
    return 'low';
  }
}
