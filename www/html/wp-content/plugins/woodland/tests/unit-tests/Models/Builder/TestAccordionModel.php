<?php namespace Woodland;

use Woodland\Models\Builder\AccordionModel as AccordionModel;

/**
 * Test the AccordionModel class.
 */
final class TestAccordionModel extends \WP_UnitTestCase {

  /**
   * The model class instance.
   *
   * @var object
   */
  public $model;

  /**
   * The PHPUnit setUp method.
   */
  public function setUp() {
    parent::setUp();
    $items = gzBuilderItems('gzItemsAccordion');
    $settings = gzBuilderSettings('AccordionDefinition', $items);
    $this->model = new AccordionModel($settings);
  }

  /** @test */
  public function can_get_items() {
    $items = $this->model->getItems();
    foreach ($items as $item) {
      $this->assertObjectHasAttribute('heading', $item);
      $this->assertObjectHasAttribute('text', $item);
    }
  }
}
