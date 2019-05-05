<?php namespace Woodland;

use Woodland\Helpers\AssetPath as AssetPath;

/**
 * Test the AssetPath class.
 */
final class TestAssetPath extends \WP_UnitTestCase {

  /** @test */
  public function can_get_asset_paths() {

    // With versioning.
    $manifest_file = dirname(__FILE__) . '/../data/test-manifest.json';
    $ver_asset_path = AssetPath::get('styles/main.css', $manifest_file);
    $ver_path = str_replace(WLWP_THEME_ASSET_URI . '/', '', $ver_asset_path);
    $this->assertSame('styles/main-402baba0b1.css', $ver_path);

    // Without versioning.
    $asset_path = AssetPath::get('styles/main.css');
    $path = str_replace(WLWP_THEME_ASSET_URI . '/', '', $asset_path);
    $this->assertSame('styles/main.css', $path);
  }
}
