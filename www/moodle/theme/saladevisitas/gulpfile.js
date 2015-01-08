'use strict';

var gulp = require('gulp');
var del = require('del');
var rename = require('gulp-rename');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var less = require('gulp-less');
var runSequence = require('run-sequence');
var path = require('path');
var shell = require('gulp-shell');

// load plugins
var $ = require('gulp-load-plugins')();

//var configfile = path.join( path.dirname(path.dirname(__dirname)), 'config.php');

gulp.task('cmd', shell.task([
  'php -r "define(\'CLI_SCRIPT\', true); require(\'/var/www/moodle/config.php\'); theme_reset_all_caches();"'
]));

gulp.task('less', function() {
	gulp.src('./less/moodle.less')
		.pipe(less({compress: true}))
		.pipe(gulp.dest('./style'))
		.pipe(reload({stream:true}))
});

gulp.task('browser-sync', function() {
	browserSync({
		notify: true,
		port: 3000,
        proxy: "localhost/moodle"
	});
});

//gulp.task('clean', del.bind(null, ['.tmp']));


/********************
*
* Desenvolvimento
*
********************/
gulp.task('watch', function() {
	gulp.watch(['less/**/*.less'], ['cmd','less']);
    gulp.watch(['layout/**/*.html'], ['cmd']);
	gulp.watch(['layout/**/*.php'], ['cmd']);
	gulp.watch(['layout/includes/**/*.php'], reload);
	gulp.watch(['javascript/**/*.js'], ['cmd']);
});


gulp.task('serve', function() {
    //runSequence('clean', ['less', 'browser-sync']);
    runSequence('less', 'browser-sync','cmd','watch');
	//runSequence('copy', 'browser-sync','watch');
	gulp.watch(['less/**/*.less'], reload);
    gulp.watch(['layout/**/*.html'], reload);
	gulp.watch(['layout/**/*.php'], reload);
	gulp.watch(['layout/includes/**/*.php'], reload);
	gulp.watch(['javascript/**/*.js'], reload);
});