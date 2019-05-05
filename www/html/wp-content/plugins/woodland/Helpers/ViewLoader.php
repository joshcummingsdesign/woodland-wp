<?php namespace Woodland\Helpers;

/**
 * The ViewLoader class.
 */
class ViewLoader {

  /**
   * The base directory where the views live.
   *
   * @var string
   */
  private $base;

  /**
   * The ViewLoader class constructor.
   *
   * @param string $base The name of the base directory where the views live.
   */
  public function __construct($base) {
    $this->base = WLWP_THEME_DIR . '/' . $base;
    $this->init();
  }

  /**
   * Hook into actions and filters.
   */
  private function init() {
    add_action('plugins_loaded', [$this, 'initTimber'], 0);
  }

  /**
   * Initialize Timber.
   */
  public function initTimber() {
    $this->timber = new \Timber\Timber();
    $this->initTwigFiles();
  }

  /**
   * Get the paths where the twig files live.
   *
   * @param string [$directory] The directory name override.
   * @return array An array of location directory paths.
   */
  public function getLocationPaths($directory = null) {

    // Get the base directory
    if ($directory) {
      $base_dir = $directory;
    } else {
      $base_dir = $this->base;
    }

    $locations = [];

    // Check the directories
    $dirs = array_filter(glob($base_dir . '/*'), 'is_dir');

    foreach ($dirs as $dir) {

      // If there is a twig file, add it
      if (count(glob($dir . '/*.twig')) > 0) {
        array_push($locations, $dir);
      }

      // Check the subdirectories
      $subDirs = array_filter(glob($dir . '/*'), 'is_dir');

      foreach ($subDirs as $subDir) {

        // If there is a twig file, add it
        if (count(glob($subDir . '/*.twig')) > 0) {
          array_push($locations, $subDir);
        }
      }
    }

    return $locations;
  }

  /**
   * Let Timber know where the twig files are.
   */
  private function initTwigFiles() {
    \Timber::$locations = $this->getLocationPaths();
  }
}
