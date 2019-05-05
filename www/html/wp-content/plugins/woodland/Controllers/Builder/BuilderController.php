<?php namespace Woodland\Controllers\Builder;

use Woodland\Controllers\Controller as Controller;
use Woodland\Models\Builder\BuilderModel as BuilderModel;

/**
 * The BuilderController class.
 */
class BuilderController extends Controller {

  /**
   * The model class instance.
   *
   * @var object
   */
  public $model;

  /**
   * The BuilderController class constructor.
   */
  public function __construct($settings) {
    $this->model = new BuilderModel($settings);
  }

  /**
   * Render the view.
   */
  public function renderView() {

    $name = 'organism-name';

    $this->data['organisms'] = (object)[
      $name => $this->model->settings
    ];

    \Timber::render($name . '.twig', $this->data);
  }
}
