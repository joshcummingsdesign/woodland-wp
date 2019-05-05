<?php

/**
 * Get the settings from a builder module.
 *
 * @param string $name The builder module definition name
 * @param mixed $value A value to pass to each setting
 * @return object The settings object
 */
function gzBuilderSettings($name, $value = '') {

  $tabs = \FLBuilderModel::$modules[$name]->form;
  $fields = \FLBuilderModel::get_settings_form_fields($tabs);
  $settings = (object)[];

  foreach ($fields as $field => $x) {
    $settings->$field = $value;
  }

  return $settings;
}

/**
 * Get the items from a builder settings form.
 *
 * @param string $name The builder form name
 * @param mixed $value A value to pass to each setting
 * @return array The items array
 */
function gzBuilderItems($name, $value = '') {

  $tabs = \FLBuilderModel::$settings_forms[$name]['tabs'];
  $fields = \FLBuilderModel::get_settings_form_fields($tabs);
  $settings = (object)[];

  foreach ($fields as $field => $x) {
    $settings->$field = $value;
  }

  $items = [$settings];

  return $items;
}
