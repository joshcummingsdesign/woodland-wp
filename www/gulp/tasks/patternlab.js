module.exports = (gulp, config, exec, del, plRev, isProduction, plugins, fs, replace) => {

  gulp.task('pl-rev', (done) => {
    if (isProduction) {
      fs.readFile(config.rev.manifest, 'utf8', (err, data) => {
        if (err) {
          throw err;
        }
        const manifest = JSON.parse(data);
        plRev(manifest, config.patternlab.head, config.patternlab.foot, replace);
      });
    } else {
      const manifest = false;
      plRev(manifest, config.patternlab.head, config.patternlab.foot, replace);
    }

    done();
  });

  gulp.task('pl-clean', () => del(config.patternlab.dest));

  gulp.task('pl-copy', (done) => gulp.src(config.patternlab.public)
    .pipe(gulp.dest(config.patternlab.dest))
    .on('finish', () => done()));

  gulp.task('pl-gen', (cb) => {
    exec('cd patternlab-core && php core/console --generate', (err, stdout, stderr) => {
      console.log(stdout);
      console.log(stderr);
      cb(err);
    });
  });

  gulp.task('pl-copy-layouts', (done) => gulp.src(config.patternlab.layouts.src)
    .pipe(gulp.dest(config.patternlab.layouts.dest))
    .on('finish', () => done()));

  gulp.task('pl-copy-atoms', (done) => gulp.src(config.patternlab.atoms.src)
    .pipe(gulp.dest(config.patternlab.atoms.dest))
    .on('finish', () => done()));

  gulp.task('pl-copy-molecules', (done) => gulp.src(config.patternlab.molecules.src)
    .pipe(gulp.dest(config.patternlab.molecules.dest))
    .on('finish', () => done()));

  gulp.task('pl-copy-organisms', (done) => gulp.src(config.patternlab.organisms.src)
    .pipe(gulp.dest(config.patternlab.organisms.dest))
    .on('finish', () => done()));

  gulp.task('pl-copy-modules', (done) => gulp.src(config.patternlab.modules.src)
    .pipe(gulp.dest(config.patternlab.modules.dest))
    .on('finish', () => done()));

  gulp.task('pl-copy-templates', (done) => gulp.src(config.patternlab.templates.src)
    .pipe(gulp.dest(config.patternlab.templates.dest))
    .on('finish', () => done()));

  gulp.task('pl-build', gulp.parallel(
    'pl-gen',
    'pl-copy-layouts',
    'pl-copy-atoms',
    'pl-copy-molecules',
    'pl-copy-organisms',
    'pl-copy-modules',
    'pl-copy-templates'
  ));

  gulp.task('pl-full-build', gulp.series(
    'pl-clean',
    'pl-copy',
    'pl-rev',
    'pl-build'
  ));

  gulp.task('pl-watch', gulp.series('pl-build', 'reload'));
};
