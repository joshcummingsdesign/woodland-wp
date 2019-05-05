// Node modules
const argv         = require('minimist')(process.argv.slice(2));
const browserSync  = require('browser-sync').create();
const del          = require('del');
const exec         = require('child_process').exec;
const fs           = require('fs');
const gulp         = require('gulp');
const lazypipe     = require('lazypipe');
const replace      = require('replace');
// const runSequence  = require('run-sequence');

// Autoload gulp plugins from npm
const plugins = require('gulp-load-plugins')({
  overridePattern: false,
  camelize: true,
  pattern: ['webpack*', 'gulp-*', 'gulp.*']
});

// Configuration
const config       = require('./gulp/config');
const isProduction = argv.production;

// Gulp utilities
const webpackTasks = require('./gulp/utilities/webpack-tasks');
const plRev = require('./gulp/utilities/patternlab-rev');

// Gulp tasks
require('./gulp/tasks/reload')(gulp, browserSync);
require('./gulp/tasks/clean')(gulp, config, del);
require('./gulp/tasks/scripts')(gulp, config, browserSync, isProduction, plugins, webpackTasks, lazypipe);
require('./gulp/tasks/styles')(gulp, config, browserSync, isProduction, plugins);
require('./gulp/tasks/fonts')(gulp, config, plugins);
require('./gulp/tasks/images')(gulp, config, plugins);
require('./gulp/tasks/patternlab')(gulp, config, exec, del, plRev, isProduction, plugins, fs, replace);

// Serve the app and start watching
gulp.task('watch', () => {
  browserSync.init({
    proxy: config.server.proxy,
    snippetOptions: {
      whitelist: config.server.whitelist,
      blacklist: config.server.blacklist
    },
    open: false
  });
  gulp.watch(`${config.content.path}/**/*.php`, gulp.parallel('reload'));
  gulp.watch(config.scripts.adminWatch, gulp.parallel('admin-scripts-watch'));
  gulp.watch(config.scripts.watch, gulp.parallel('scripts-watch'));
  gulp.watch(config.styles.src, gulp.parallel('styles'));
  gulp.watch(config.fonts.src, gulp.parallel('fonts-watch'));
  gulp.watch(config.images.src, gulp.parallel('images-watch'));
  gulp.watch(config.patternlab.src, gulp.parallel('pl-watch'));
});

// The default gulp task which compiles everything
gulp.task('default', gulp.series('clean', 'styles', gulp.parallel('scripts', 'fonts', 'images'), 'pl-full-build'));
