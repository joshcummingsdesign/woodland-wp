<?php

/**
 * Run all builder normalization functions.
 *
 * @param object $settings The builder settings object
 * @return object The noramlized builder settings object
 */
function gzNormalize(&$settings) {
  gzNormalizeDefaults($settings);
  gzNormalizeRename($settings);
  gzNormalizeSpacing($settings);
  gzNormalizeItems($settings);
  gzNormalizeImages($settings);
  gzNormalizeVideos($settings);
  gzNormalizeLinks($settings);
}

/**
 * Removes all builder settings keys except those with "gz" prefix.
 *
 * Optionally pass an array of items you want to keep.
 *
 * @param object $settings The builder settings object
 * @param array  $filters  Items you want to keep in the object
 */
function gzNormalizeDefaults(&$settings, $filters = []) {

  foreach ($settings as $setting => $value) {

    $isFilteredItem = in_array($setting, $filters);
    $isGzItem = preg_match('/^gz.+$/', $setting);

    if (!$isFilteredItem && !$isGzItem) {
      unset($settings->$setting);
    }
  }
}

/**
 * Remove "gz" prefix from builder settings keys.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeRename(&$settings) {

  foreach ($settings as $setting => $value) {

    $isGzItem = preg_match('/^gz.+$/', $setting);

    if ($isGzItem) {
      $key = lcfirst(str_replace('gz', '', $setting));
      $settings->$key = $value;
      unset($settings->$setting);
    }
  }
}

/**
 * Normalizes the spacing options for the builder.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeSpacing(&$settings) {

  $paddingSizes = [
    'pt',
    'pb',
    'ptsm',
    'pbsm',
    'ptmd',
    'pbmd',
    'ptlg',
    'pblg'
  ];

  $padding = '';

  foreach ($paddingSizes as $size) {

    if (empty($settings->$size) || $settings->$size === 'none' || gettype($settings->$size) !== 'string') {
      unset($settings->$size);
      continue;
    }

    $padding .= ' ' . $settings->$size;
    unset($settings->$size);
  }

  $settings->spacing = $padding;
}

/**
 * Removes extraneous properties from builder items.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeItems(&$settings) {

  if (empty($settings->items)) {
    return;
  }

  if (is_array($settings->items) || is_object($settings->items)) {

    foreach ($settings->items as $item) {
      unset($item->{0});
    }
  }
}

/**
 * Normalize image by ID.
 *
 * @param int $id The image ID
 */
function gzNormalizeImageById($id) {

  // Get alt text
  $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

  // Create image object
  $image = (object)[
    'alt' => $alt
  ];

  // Get image sizes
  global $_wp_additional_image_sizes;
  $sizes = $_wp_additional_image_sizes;
  $sizes['full'] = [];

  // Add image sizes to image object
  foreach ($sizes as $size => $value) {
    $url = wp_get_attachment_image_src($id, $size)[0];
    $image->$size = $url;
  }

  return $image;
}

/**
 * Normalize builder images.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeImages(&$settings) {

  if (empty($settings->image)) {
    return;
  }

  // Create image object
  $image = gzNormalizeImageById($settings->image);

  // Override default properties
  $settings->image = $image;
  unset($settings->image_src);
}

/**
 * Normalize builder videos.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeVideos(&$settings) {

  foreach (['video', 'video1', 'video2'] as $key) {
    if (empty($settings->$key)) {
      continue;
    }

    $settings->$key = wp_get_attachment_url($settings->$key);
  }
}

/**
 * Normalize builder links.
 *
 * @param object $settings The builder settings object
 */
function gzNormalizeLinks(&$settings) {

  if (isset($settings->linkText) && isset($settings->linkUrl)) {
    $link = (object)[
      'text' => $settings->linkText,
      'url' => $settings->linkUrl
    ];
    $settings->link = $link;
    unset($settings->linkText);
    unset($settings->linkUrl);
  }
}

/**
 * Normalize menus.
 *
 * @param object $menuData An object of Timber menu objects to normalize
 * @return object The normalized menus object
 */
function gzNormalizeMenus($menuData) {

  $menus = (object)[];

  foreach ($menuData as $menuSlug => $menuTitle) {

    $menus->$menuSlug = (object)[
      'items' => []
    ];

    if ($menuTitle->items) {

      foreach ($menuTitle->items as $item) {

        $menuItem = (object)[
          'name' => $item->name,
          'url' => $item->url,
          'children' => []
        ];

        if ($item->children) {

          foreach ($item->children as $child) {

            $childItem = (object)[
              'name' => $child->name,
              'url' => $child->url,
              'children' => []
            ];

            if ($child->children) {

              foreach ($child->children as $grandchild) {

                $grandchildItem = (object)[
                  'name' => $child->name,
                  'url' => $child->url
                ];

                  array_push($childItem->children, $grandchildItem);
              }
            }

            array_push($menuItem->children, $childItem);
          }
        }

        array_push($menus->$menuSlug->items, $menuItem);
      }
    }
  }

  return $menus;
}

/**
 * Adds paragraph tags to text.
 *
 * @param string $text The text to which tags will be added
 * @param string $class A class to add to the paragraph tags
 * @return void
 */
function gzAddParagraphTags($text, $class = '') {
  $class = !empty($class) ? ' class="' . $class . '"': '';
  $content = implode('</p><p' . $class . '>', array_filter(explode("\n", $text)));
  return '<p' . $class . '>' . $content . '</p>';
}
