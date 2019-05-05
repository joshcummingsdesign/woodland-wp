<?php namespace Woodland\Controllers\Builder;

use Woodland\Models\Builder\AccordionModel as AccordionModel;

/**
 * The AccordionController class.
 */
class AccordionController extends BuilderController {

  /**
   * The AccordionController class constructor.
   */
  public function __construct($settings) {
    $this->model = new AccordionModel($settings);
  }

  /**
   * Render the view.
   */
  public function renderView() {

    $name = 'accordion';

    $this->data['organisms'] = (object)[
      $name => (object)[
        'spacing' => $this->model->settings->spacing,
        'heading' => $this->model->settings->heading,
        'items' => $this->model->getItems()
      ]
    ];

    \Timber::render($name . '.twig', $this->data);
  }
}
