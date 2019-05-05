<?php


/**
 * Removes extraneous properties from builder items.
 *
 * @param object $settings The builder settings object
 */
function wlNormalizeItems(&$settings) {

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
function wlNormalizeImageById($id) {

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
function wlNormalizeImages(&$settings) {

  if (empty($settings->image)) {
    return;
  }

  // Create image object
  $image = wlNormalizeImageById($settings->image);

  // Override default properties
  $settings->image = $image;
  unset($settings->image_src);
}

/**
 * Normalize builder videos.
 *
 * @param object $settings The builder settings object
 */
function wlNormalizeVideos(&$settings) {

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
function wlNormalizeLinks(&$settings) {

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
function wlNormalizeMenus($menuData) {

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
function wlAddParagraphTags($text, $class = '') {
  $class = !empty($class) ? ' class="' . $class . '"': '';
  $content = implode('</p><p' . $class . '>', array_filter(explode("\n", $text)));
  return '<p' . $class . '>' . $content . '</p>';
}
