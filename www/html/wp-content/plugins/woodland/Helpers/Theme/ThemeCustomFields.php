<?php namespace Woodland\Helpers\Theme;

/**
 * The Theme_Custome_Fields class.
 */
class ThemeCustomFields {

  /**
   * The ThemeCustomFields class constructor.
   */
  public function __construct() {
    $this->themeSettingsPage();
  }

  /**
   * Add a theme settings page.
   */
  public function themeSettingsPage() {
    if (function_exists('acf_add_options_page')) {
      acf_add_options_page([
        'page_title' => __('Theme Settings', 'wlwp'),
        'menu_title' => __('Theme Settings', 'wlwp'),
        'menu_slug'  => 'theme-settings',
        'capability' => 'manage_options',
        'redirect'   => false,
      ]);
    }
  }
}
