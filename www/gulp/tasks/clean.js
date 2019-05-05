module.exports = (gulp, config, del) => {

  gulp.task('clean-dest', () => del(config.project.dest));

  gulp.task('clean-views', () => del(config.project.views));

  gulp.task('clean', gulp.parallel('clean-dest', 'clean-views'));
};
