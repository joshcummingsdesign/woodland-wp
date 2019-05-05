<?php namespace Woodland;

use Woodland\Models\BaseModel as BaseModel;

/**
 * Test the BaseModel class.
 */
final class TestBaseModel extends \WP_UnitTestCase {

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
    $this->model = new BaseModel();
  }

  /** @test */
  public function can_get_body_class() {
    $data = $this->model->getBodyClass();
    $this->assertInternalType('string', $data);
  }

  /** @test */
  public function can_get_site_data() {
    $data = $this->model->getSite();
    $this->assertObjectHasAttribute('url', $data);
    $this->assertObjectHasAttribute('language', $data);
    $this->assertObjectHasAttribute('title', $data);
  }

  /** @test */
  public function can_get_menu_data() {
    $data = $this->model->getMenus();
    $this->assertObjectHasAttribute('header', $data);
  }

  /** @test */
  public function can_get_footer_data() {
    $data = $this->model->getFooter();
    $this->assertEquals($data, (object)[]);
  }

  /** @test */
  public function can_get_image_path() {
    $data = $this->model->getImages();
    $this->assertInternalType('string', $data);
  }

  /** @test */
  public function can_get_is_mobile() {
    $data = $this->model->getIsMobile();
    $this->assertInternalType('int', $data);
  }

  /** @test */
  public function can_get_post_data() {
    $data = $this->model->getPost();
    $this->assertObjectHasAttribute('ID', $data);
  }

  /** @test */
  public function can_get_posts() {
    $data = $this->model->getPosts();
    $this->assertObjectHasAttribute('posts', $data);
    $this->assertObjectHasAttribute('pagination', $data);
  }
}
