import Posts from './posts/posts';

$(document).ready(() => {
  const posts = new Posts();
  posts.init();
});
