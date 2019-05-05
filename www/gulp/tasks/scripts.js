module.exports = (gulp, config, browserSync, isProduction, plugins, webpackTasks, lazypipe) => {

  gulp.task('scripts-lint', (done) => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(plugins.eslint())
    .pipe(plugins.eslint.format())
    .pipe(plugins.eslint.failAfterError())
    .on('finish', () => done()));

  gulp.task('admin-scripts', (done) => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.admin,
      config.scripts.presets,
      isProduction,
      isProduction, plugins, lazypipe
    ))
    .pipe(gulp.dest(config.scripts.dest))
    .on('finish', () => done()));

  gulp.task('vendor-scripts', (done) => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.vendor,
      config.scripts.presets,
      false,
      isProduction, plugins, lazypipe
    ))
    .pipe(plugins.if(isProduction, plugins.rev()))
    .pipe(gulp.dest(config.scripts.dest))
    .pipe(plugins.rev.manifest(config.rev.manifest, {
      base: config.project.dest,
      merge: true
    }))
    .pipe(gulp.dest(config.project.dest))
    .on('finish', () => done()));

  gulp.task('main-scripts', (done) => gulp.src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.entries,
      config.scripts.presets,
      isProduction,
      isProduction, plugins, lazypipe
    ))
    .pipe(plugins.if(isProduction, plugins.rev()))
    .pipe(gulp.dest(config.scripts.dest))
    .pipe(browserSync.stream())
    .pipe(plugins.rev.manifest(config.rev.manifest, {
      base: config.project.dest,
      merge: true
    }))
    .pipe(gulp.dest(config.project.dest))
    .on('finish', () => done()));

  gulp.task('scripts', gulp.series('scripts-lint', 'admin-scripts', 'vendor-scripts', 'main-scripts'));

  gulp.task('admin-scripts-watch', gulp.series('scripts-lint', 'admin-scripts'));

  gulp.task('scripts-watch', gulp.series('scripts-lint', 'main-scripts'));
};
