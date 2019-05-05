<?php namespace Woodland;

use Woodland\Controllers\Builder\AccordionController as AccordionController;
use Woodland\Models\Builder\AccordionModel as AccordionModel;

/**
 * Test the AccordionController class.
 */
final class TestAccordionController extends \WP_UnitTestCase {

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
    $settings = gzBuilderSettings('AccordionDefinition');
    $this->controller = new AccordionController($settings);
  }

  /** @test */
  public function can_instantiate_a_model() {
    $this->assertInstanceOf(AccordionModel::class, $this->controller->model);
  }

  /** @test */
  public function can_render_a_view() {
    $this->controller->renderView();
    $data = $this->controller->data;
    $this->assertArrayHasKey('organisms', $data);
    $organisms = $data['organisms'];
    $name = 'accordion';
    $this->assertObjectHasAttribute($name, $organisms);
    $this->assertObjectHasAttribute('spacing', $organisms->$name);
    $this->assertObjectHasAttribute('heading', $organisms->$name);
    $this->assertObjectHasAttribute('items', $organisms->$name);
  }
}
