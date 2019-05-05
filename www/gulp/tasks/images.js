module.exports = (gulp, config, plugins) => {

  gulp.task('images', (done) => gulp.src(config.images.src + config.images.pattern)
    .pipe(plugins.newer(config.images.dest))
    // .pipe(plugins.imagemin())
    .pipe(gulp.dest(config.images.dest))
    .on('finish', () => done()));

  gulp.task('images-watch', gulp.series('images', 'reload'));
};
