<?php namespace Woodland;

/**
 * Test builder normalize functions.
 */
final class TestNormalizeData extends \WP_UnitTestCase {

  /** @test */
  public function can_normalize_defaults() {
    $settings = (object)[
      'gzFoo' => '',
      'bar' => '',
      '123gz' => ''
    ];
    $expected = (object)[
      'gzFoo' => '',
    ];
    gzNormalizeDefaults($settings);
    $this->assertEquals($settings, $expected);
  }

  /** @test */
  public function can_rename_defaults() {
    $settings = (object)[
      'gzFoo' => '',
      'gzBar' => '',
      'gzJones' => '',
      '123gzJones' => '',
      'FoogzJones123gz' => '',
    ];
    $expected = (object)[
      'foo' => '',
      'bar' => '',
      'jones' => '',
      '123gzJones' => '',
      'FoogzJones123gz' => '',
    ];
    gzNormalizeRename($settings);
    $this->assertEquals($settings, $expected);
  }

  /** @test */
  public function can_normalize_spacing() {
    $settings = (object)[
      'pt' => '',
      'pb' => '',
      'ptsm' => '',
      'pbsm' => '',
      'ptmd' => '',
      'pbmd' => '',
      'ptlg' => '',
      'pblg' => ''
    ];
    $expected = (object)[
      'spacing' => ''
    ];
    gzNormalizeSpacing($settings);
    $this->assertEquals($settings, $expected);
  }

  /** @test */
  public function can_normalize_images() {

    $image = gzNormalizeImageById(1);

    $this->assertObjectHasAttribute('alt', $image);

    $this->assertObjectHasAttribute('medium', $image);

    $this->assertObjectHasAttribute('full', $image);
  }

  /** @test */
  public function can_normalize_videos() {
    $settings = (object)[
      'video' => 1
    ];
    gzNormalizeVideos($settings);
    $this->assertEquals($settings->video, false);
  }

  /** @test */
  public function can_normalize_links() {
    $settings = (object)[
      'linkText' => 'link text',
      'linkUrl' => '/example-link'
    ];
    $expected = (object)[
      'text' => 'link text',
      'url' => '/example-link'
    ];
    gzNormalizeLinks($settings);
    $this->assertEquals($settings->link, $expected);
  }

  /** @test */
  public function can_normalize_menus() {

    $menuData = (object)[
      'header' => (object)[
        'MenuItemClass' => (object)[],
        'PostClass' => (object)[],
        'items' => [
          (object)[
            'name' => '',
            'url' => '',
            'has_child_class' => 1,
            'classes' => [],
            'class' => '',
            'level' => 1,
            'post_name' => '',
            'PostClass' => (object)[],
            '_menu_item_object_id:protected' => 41,
            'menu_object:protected' => (object)[],
            'post_author' => '',
            'children' => [
              (object)[
                'name' => '',
                'url' => '',
                'children' => [
                  (object)[
                    'name' => '',
                    'url' => ''
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ];

    $expected = (object)[
      'header' => (object)[
        'items' => [
          (object)[
            'name' => '',
            'url' => '',
            'children' => [
              (object)[
                'name' => '',
                'url' => '',
                'children' => [
                  (object)[
                    'name' => '',
                    'url' => ''
                  ]
                ]
              ]
            ]
          ]
        ]
      ]
    ];
    $actual = gzNormalizeMenus($menuData);
    $this->assertEquals($expected, $actual);
  }

  /** @test */
  public function can_add_paragraph_tags() {

    $actual = gzAddParagraphTags("I\nLove\nLamp");
    $expected = '<p>I</p><p>Love</p><p>Lamp</p>';
    $this->assertEquals($expected, $actual);

    $actual = gzAddParagraphTags("Foo\nBar\n");
    $expected = '<p>Foo</p><p>Bar</p>';
    $this->assertEquals($expected, $actual);

    $actual = gzAddParagraphTags("Hello\nWorld", $class = 'foo');
    $expected = '<p class="foo">Hello</p><p class="foo">World</p>';
    $this->assertEquals($expected, $actual);
  }
}
