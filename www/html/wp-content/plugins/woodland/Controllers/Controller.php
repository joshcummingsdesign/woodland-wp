<?php namespace Woodland\Controllers;

use Woodland\Models\BaseModel as BaseModel;

/**
 * The Controller class.
 */
class Controller {

  /**
   * The baseModel class instance.
   *
   * @var object
   */
  public $baseModel;

  /**
   * The data to pass to the view.
   *
   * @var array
   */
  public $data = [];

  /**
   * The Controller class constructor.
   */
  public function __construct() {
    $this->baseModel = new BaseModel();
    $this->data['body_class'] = $this->baseModel->getBodyClass();
    $this->data['site'] = $this->baseModel->getSite();
    $this->data['menus'] = $this->baseModel->getMenus();
    $this->data['footer'] = $this->baseModel->getFooter();
    $this->data['images'] = $this->baseModel->getImages();
    $this->data['is_mobile'] = $this->baseModel->getIsMobile();
  }

  /**
   * Render the view.
   */
  public function renderView() {
    \Timber::render('page.twig', $this->data);
  }
}
