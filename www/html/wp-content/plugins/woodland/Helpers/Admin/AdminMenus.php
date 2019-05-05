<?php namespace Chameleon\Helpers\Admin;

/**
 * The Controller class.
 */
class AdminMenus {

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
    add_action('admin_menu', [$this, 'removeMenus']);
  }

  /**
   * Pipe the styles into the admin editor.
   */
  public function removeMenus() {

    // remove_menu_page('index.php');                            //Dashboard
    // remove_menu_page('jetpack');                              //Jetpack*
    // remove_menu_page('upload.php');                           //Media
    // remove_menu_page('edit.php?post_type=page');              //Pages
    // remove_menu_page('plugins.php');                          //Plugins
    // remove_menu_page('users.php');                            //Users
    // remove_menu_page('tools.php');                            //Tools

    // remove_menu_page('edit.php');                             //Posts
    // remove_menu_page('edit-comments.php');                    //Comments
    // remove_menu_page('themes.php');                           //Appearance

    if (wlIsProd() || wlIsStaging()) {
      // remove_menu_page('options-general.php');                //Settings
      // remove_menu_page('edit.php?post_type=acf-field-group'); //ACF
    }
  }
}
