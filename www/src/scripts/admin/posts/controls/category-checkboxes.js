/**
 * The CategoryCheckboxes class.
 */
class CategoryCheckboxes {

  /**
   * The CategoryCheckboxes class constructor.
   */
  constructor() {
    this.checklistSelector = '[id$="-all"] > ul.categorychecklist';
  }

  /**
   * Initialize the category checkboxes.
   */
  init() {
    this
      ._cacheDomElements()
      .then(() => this._scrollToCheckedItems());
  }

  /**
   * Cache DOM elements.
   *
   * @returns {Promise} - resolve
   */
  _cacheDomElements() {
    const p = new Promise((resolve) => {
      this.$checklist = $(this.checklistSelector);
      resolve();
    });
    return p;
  }

  /**
   * Scroll the taxonomy checklist to a checked item.
   */
  _scrollToCheckedItems() {

    this.$checklist.each((i, checklist) => {

      const $list = $(checklist);

      const $firstChecked = $list.find(':checkbox:checked').first();

      if (!$firstChecked.length) {
        return;
      }

      const posFirst = $list.find(':checkbox').position().top;
      const posChecked = $firstChecked.position().top;

      $list.closest('.tabs-panel').scrollTop(posChecked - posFirst + 5);
    });
  }
}

export default CategoryCheckboxes;
