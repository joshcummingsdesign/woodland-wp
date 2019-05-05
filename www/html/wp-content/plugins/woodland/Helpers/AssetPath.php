<?php namespace Woodland\Helpers;

/**
 * The AssetPath class.
 */
class AssetPath {

  /**
   * Get the path to the dist folder with asset rev.
   *
   * @param string $path Path to file relative to asset directory.
   * @param string [$manifest_file] The manifest file location (defaults to constant).
   * @return string The path to the asset you requested.
   */
  public static function get($path, $manifest_file = null) {
    if (!$manifest_file) {
      $manifest_file = WLWP_THEME_ASSET_DIR . '/' . WLWP_THEME_ASSET_REV;
    }
    if (!file_exists($manifest_file)) {
      return WLWP_THEME_ASSET_URI . '/' . $path;
    } else {
      $manifest_content = file_get_contents($manifest_file);
      $manifest = json_decode($manifest_content, true);
      $path_array = explode('/', $path);
      $filename = array_pop($path_array);
      foreach ($manifest as $key => $val) {
        if ($filename === $key) {
          $file_path = implode('/', $path_array) . '/' . $val;
          return WLWP_THEME_ASSET_URI . '/' . $file_path;
        }
      }
    }
  }
}
