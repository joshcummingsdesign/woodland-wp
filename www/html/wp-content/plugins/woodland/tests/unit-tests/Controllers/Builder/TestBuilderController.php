<?php namespace Woodland;

use Woodland\Controllers\Builder\BuilderController as BuilderController;
use Woodland\Models\Builder\BuilderModel as BuilderModel;

/**
 * Test the BuilderController class.
 */
final class TestBuilderController extends \WP_UnitTestCase {

  /**
   * The controller class instance.
   *
   * @var object
   */
  public $controller;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $settings = (object)[];
    $this->controller = new BuilderController($settings);
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(BuilderModel::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $data = $this->controller->data;
    $this->assertArrayHasKey('organisms', $data);
    $this->assertObjectHasAttribute('organism-name', $data['organisms']);
  }
}
