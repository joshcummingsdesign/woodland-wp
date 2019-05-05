module.exports = (gulp, config, plugins) => {

  gulp.task('fonts', (done) => gulp.src(config.fonts.src + config.fonts.pattern)
    .pipe(plugins.newer(config.fonts.dest))
    .pipe(plugins.flatten())
    .pipe(gulp.dest(config.fonts.dest))
    .on('finish', () => done()));

  gulp.task('fonts-watch', gulp.series('fonts', 'reload'));
};
