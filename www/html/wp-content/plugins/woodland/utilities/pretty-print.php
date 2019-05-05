<?php

/**
 * Pretty prints objects, arrays, or variables.
 *
 * @param mixed $var  The item you want to print
 * @param array $args Tag options
 */
function gzPrettyPrint($var, $args = []) {

  $defaults = [
    'strip_tags' => false,
    'allow_tags' => null,
  ];

  $options = array_merge($defaults, $args);

  if ($options['strip_tags']) {
    $var = strip_tags($var, $options['allow_tags']);
  }

  echo '<pre>';
  print_r($var);
  echo '</pre>';
}

/**
 * Pretty print and die.
 *
 * @param mixed $var  The item you want to print
 * @param array $args Tag options
 */
function gzppd($var, $args = []) {
  gzPrettyPrint($var, $args);
  die();
}
