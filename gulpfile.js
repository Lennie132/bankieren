var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del'),
    sourcemaps = require("gulp-sourcemaps"),
    csso = require("gulp-csso");


/* NAME OF PROJECT HERE */
var destination = "dist";

var path = {
    sasssrc: ["src/styles/**/*.scss"],
    sassdest: destination + "/css",

    scriptsrc: [
        "src/scripts/jquery.js",
        "src/scripts/**/*.js"
    ],
    scriptdest: destination + "/js",

    imgsrc: "src/images/**/*.+(png|jpg|gif|svg)",
    imgdest: destination + "/img"
};

gulp.task("styles", function () {
    return gulp.src(path.sasssrc)
        .pipe(sass().on("error", sass.logError))
        .pipe(concat('style.min.css'))
        .pipe(autoprefixer({
            browsers: ["last 2 versions", "ie >= 9", "and_chr >= 2.3"],
            cascade: false
        }))
        .pipe(csso({
            restructure: true,
            sourceMap: true,
            debug: false
        }))
        .pipe(gulp.dest(path.sassdest))
});

gulp.task("scripts", function () {
    return gulp.src(path.scriptsrc)
        .pipe(sourcemaps.init())
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(path.scriptdest))
});

gulp.task("images", function () {
    return gulp.src(path.imgsrc)
        .pipe(cache(imagemin({
            interlaced: true
        }))
            .pipe(gulp.dest(path.imgdest)))
});


// Clean
gulp.task('clean', function () {
    return del([destination + '/css', destination + '/js', destination + '/img']);
});


// Default task
gulp.task('default', ['clean'], function () {
    gulp.start('styles', 'scripts', 'images');
});

// Watch
gulp.task('watch', function () {
    // Watch .scss files
    gulp.watch('src/styles/**/*.scss', ['styles']);

    // Watch .js files
    gulp.watch('src/scripts/**/*.js', ['scripts']);

    // Watch image files
    gulp.watch('src/images/**/*', ['images']);
});