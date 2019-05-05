<?php namespace Woodland\Helpers\Admin;

/**
 * The TinyMCE class.
 */
class TinyMCE {

  /**
   * The array of options to add to the "Formats" dropdown.
   *
   * @var array
   */
  private $tinymce_options = [];

  /**
   * The TinyMCE class constructor.
   */
  public function __construct() {
    $this->init();
  }

  /**
   * Initialize the TinyMCE "Formats" dropdown.
   */
  private function init() {

    // Add options to dropdown
    $this->addButtons();

    // Hook into actions and filters.
    add_action('tiny_mce_before_init', [$this, 'createOptions']);
    add_action('mce_buttons_2', [$this, 'createDropdown']);
  }

  /**
   * Add a "Buttons" section to the dropdown.
   */
  private function addButtons() {
    $buttons = [
      'title' => __('Buttons', 'wlwp'),
      'items' => [
        [
          'title' => __('Button', 'wlwp'),
          'selector' => 'a',
          'classes' => 'btn'
        ]
      ]
    ];
    $this->addOption($buttons);
  }

  /**
   * Add an option to the $tinymce_options array.
   *
   * @param array $option_array The option you want to add.
   */
  private function addOption($option_array) {
    array_push($this->tinymce_options, $option_array);
  }

  /**
   * Create the options for the "Formats" dropdown in the TinyMCE editor.
   *
   * https://developer.wordpress.org/reference/hooks/tiny_mce_before_init/
   *
   * @param array $mceInit TinyMCE config passed by WordPress.
   */
  public function createOptions($mceInit) {
    $output = array_merge($this->tinymce_options);
    $mceInit['style_formats'] = json_encode($output);
    return $mceInit;
  }

  /**
   * Create the "Formats" dropdown menu in the TinyMCE editor.
   *
   * https://developer.wordpress.org/reference/hooks/mce_buttons_2/
   *
   * @param array $buttons Button IDs passed by WordPress.
   */
  public function createDropdown($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }
}
