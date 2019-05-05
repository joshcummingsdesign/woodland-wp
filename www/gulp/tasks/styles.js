module.exports = (gulp, config, browserSync, isProduction, plugins) => {
  gulp.task('styles', (done) => gulp.src(`${config.styles.src}${config.styles.pattern}`)
    .pipe(plugins.plumber())
    .pipe(plugins.if(!isProduction, plugins.sourcemaps.init()))
    .pipe(plugins.sass()).on('error', plugins.sass.logError)
    .pipe(plugins.autoprefixer({grid: true, browsers: ['last 2 versions', 'ie >= 10']}))
    .pipe(plugins.if(isProduction, plugins.cssnano()))
    .pipe(plugins.if(!isProduction, plugins.sourcemaps.write()))
    .pipe(plugins.if(isProduction, plugins.rev()))
    .pipe(gulp.dest(config.styles.dest))
    .pipe(browserSync.stream())
    .pipe(plugins.rev.manifest(config.rev.manifest, {
      base: config.project.dest,
      merge: true
    }))
    .pipe(gulp.dest(config.project.dest))
    .on('finish', () => done()));
};
