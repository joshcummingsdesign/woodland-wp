import CategoryCheckboxes from './controls/category-checkboxes';

/**
 * The Posts class.
 */
class Posts {

  /**
   * The Posts class constructor.
   */
  constructor() {
    this.categoryCheckboxes = new CategoryCheckboxes();
  }

  /**
   * Initialize everything needed for posts in the admin.
   */
  init() {
    this.categoryCheckboxes.init();
  }
}

export default Posts;
