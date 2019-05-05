<?php namespace Woodland\Models\Builder;

/**
 * The AccordionModel class.
 */
class AccordionModel extends BuilderModel {

  /**
   * Get the Accordion items.
   *
   * @return array The Accordion items
   */
  public function getItems() {

    $items = [];

    if (!empty($this->settings->items)) {

      foreach ($this->settings->items as $item) {

        if (!empty($item)) {

          $item = (object)[
            'heading' => $item->heading,
            'text' => gzAddParagraphTags($item->text, 'p')
          ];
          array_push($items, $item);
        }
      }
    }

    return $items;
  }
}
