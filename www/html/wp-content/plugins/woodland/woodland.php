<?php namespace Woodland;

/**
 * Plugin Name:       Woodland
 * Description:       The Woodland Plugin
 * Version:           1.0.0
 * Author:
 * Author URI:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wlwp
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

if (!class_exists(__NAMESPACE__ . '\Woodland')) {

  /**
   * The main Woodland class (Singleton).
   */
  final class Woodland {

    /**
     * The minimum PHP version needed to run woodland.
     */
    const PHP_MIN_VERISON = '7.0';

    /**
     * The base directory where the views live.
     */
    const VIEWS_BASE_DIR = 'views';

    /**
     * The asset destination directory for the theme.
     */
    const THEME_ASSET_DIR = 'dist';

    /**
     * The name of the rev manifest file.
     */
    const THEME_ASSET_REV = 'rev-manifest.json';

    /**
     * The BuilderModules class instance.
     *
     * @var object
     */
    private $builderModules;

    /**
     * The CoreAddons class instance.
     *
     * @var object
     */
    private $coreAddons;

    /**
     * The PluginAddons class instance.
     *
     * @var object
     */
    private $pluginAddons;

    /**
     * The ThemeSupport class instance.
     *
     * @var object
     */
    private $themeSupport;

    /**
     * The ImageSizes class instance.
     *
     * @var object
     */
    private $imageSizes;

    /**
     * The ThemeAssets class instance.
     *
     * @var object
     */
    private $themeAssets;

    /**
     * The ThemeMenus class instance.
     *
     * @var object
     */
    private $themeMenus;

    /**
     * The ThemeCustomFields class instance.
     *
     * @var object
     */
    private $themeFields;

    /**
     * The TinyMCE class instance.
     *
     * @var object
     */
    private $tinymce;

    /**
     * The AdminAssets class instance.
     *
     * @var object
     */
    private $adminAssets;

    /**
     * The ViewLoader class instance.
     *
     * @var object
     */
    private $viewLoader;

    /**
     * The Woodland class instance.
     *
     * @var object
     */
    private static $instance;

    /**
     * Returns the main Woodland class instance.
     *
     * @return object Woodland
     */
    public static function getInstance() {
      if (is_null(self::$instance)) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * The Woodland class constructor.
     */
    public function __construct() {

      // Bail if minimum PHP version requirement is not met.
      if (version_compare(self::PHP_MIN_VERISON, phpversion(), '>')) {
        add_action('admin_notices', [$this, 'phpUpdateNotice']);
        return;
      }

      $this->constants();
      $this->includes();
      $this->initBuilder();
      $this->initCore();
      $this->initTheme();
      $this->initAdmin();
      $this->initHelpers();
    }

    /**
     * Builder initialization.
     */
    public function initBuilder() {
      // $this->builderModules = new Definitions\Builder\BuilderModules();
    }

    /**
     * woodland core initialization.
     */
    public function initCore() {
      $this->coreAddons   = new Helpers\Core\CoreAddons();
      $this->pluginAddons = new Helpers\Core\PluginAddons();
    }

    /**
     * woodland theme initialization.
     */
    public function initTheme() {
      $this->themeSupport = new Helpers\Theme\ThemeSupport();
      $this->imageSizes   = new Helpers\Theme\ImageSizes();
      $this->themeAssets  = new Helpers\Theme\ThemeAssets();
      $this->themeMenus   = new Helpers\Theme\ThemeMenus();
      $this->themeFields  = new Helpers\Theme\ThemeCustomFields();
    }

    /**
     * woodland admin initialization.
     */
    public function initAdmin() {
      $this->adminAssets = new Helpers\Admin\AdminAssets();
      $this->tinymce     = new Helpers\Admin\TinyMCE();
    }

    /**
     * Helper initialization.
     */
    public function initHelpers() {
      $this->viewLoader = new Helpers\ViewLoader(self::VIEWS_BASE_DIR);
    }

    /**
     * Define plugin constants.
     */
    private function constants() {
      define('WLWP_PLUGIN_DIR', plugin_dir_path(__FILE__));
      define('WLWP_PLUGIN_URI', plugins_url('/', __FILE__));
      define('WLWP_THEME_DIR', get_theme_file_path());
      define('WLWP_THEME_URI', get_theme_file_uri());
      define('WLWP_THEME_ASSET_DIR', WLWP_THEME_DIR . '/' . self::THEME_ASSET_DIR);
      define('WLWP_THEME_ASSET_URI', WLWP_THEME_URI . '/' . self::THEME_ASSET_DIR);
      define('WLWP_THEME_ASSET_REV', self::THEME_ASSET_REV);
    }

    /**
     * Include required files.
     */
    private function includes() {
      require_once WLWP_PLUGIN_DIR . 'vendor/autoload.php';
      require_once WLWP_PLUGIN_DIR . 'utilities/environment.php';
      require_once WLWP_PLUGIN_DIR . 'utilities/pretty-print.php';
      require_once WLWP_PLUGIN_DIR . 'utilities/normalize-data.php';
    }


    /**
     * Cloning is forbidden.
     */
    public function __clone() {
      _doing_it_wrong(__FUNCTION__, __('Woodland cannot be cloned.', 'wlwp'), '1.0.0');
    }

    /**
     * Unserializing is forbidden.
     */
    public function __wakeup() {
      _doing_it_wrong(__FUNCTION__, __('Woodland cannot be unserialized.', 'wlwp'), '1.0.0');
    }

    /**
     * Show PHP update notice.
     */
    public function phpUpdateNotice() {
      if (!is_admin()) {
        return;
      }
      $notice_heading = __('PHP Update Required', 'wlwp');
      $notice_body = sprintf(__('woodland requires PHP version %s or later.', 'wlwp'), self::PHP_MIN_VERISON);
      $notice_markup .= '<p><strong>' . $notice_heading . '</strong></p>';
      $notice_markup .= '<p>' . $notice_body . '</p>';
      $notice = sprintf('<div class="notice notice-error">%1$s</div>', $notice_markup);
      echo $notice;
    }
  }
}

/**
 * Start woodland
 * The main function responsible for returning
 * the one true Woodland instance.
 *
 * @return object Woodland
 */
function Woodland() {
  return Woodland::getInstance();
}
Woodland();
