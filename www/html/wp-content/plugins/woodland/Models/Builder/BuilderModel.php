<?php namespace Woodland\Models\Builder;

/**
 * The BuilderModel class.
 */
class BuilderModel {

  /**
   * The builder settings array.
   *
   * @var array
   */
  public $settings;

  /**
   * The BuilderModel class constructor.
   */
  public function __construct($settings) {
    $this->settings = $settings;
    $this->normalize();
  }

  /**
   * Normalize the builder settings array.
   */
  public function normalize() {
    gzNormalize($this->settings);
  }
}
