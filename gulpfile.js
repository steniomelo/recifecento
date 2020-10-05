// Include gulp
var gulp = require('gulp');
// Define base folders
var src = './assets/src/';
var dest = './assets/build/';
// Include plugins
var concat = require('gulp-concat');
//var uglify = require('gulp-uglify');
var uglify = require('gulp-uglify-es').default;
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var concatCss = require('gulp-concat-css');
var cleanCSS = require('gulp-clean-css');
var stripCssComments = require('gulp-strip-css-comments');
var browserSync = require('browser-sync').create();

// Concatenate & Minify JS
gulp.task('scripts', function () {
    return gulp.src(src + 'js/**/*.js')
        //.pipe(concat('main.js'))
        //.pipe(rename({suffix: '.min'}))
        .pipe(uglify({
            compress: { drop_debugger: false }
        }))
        .pipe(gulp.dest(dest + 'js'))
        .pipe(browserSync.stream());
});

// Concatenate & Minify Node Modules Components
gulp.task('vendors', function () {
    return gulp.src([
        './node_modules/jquery/jquery.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        './node_modules/slick-carousel/slick/slick.min.js',
        './node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
        //'./node_modules/jquery-hammerjs/jquery.hammer.js',
        './node_modules/hammerjs/hammer.min.js',
        // './node_modules/jquery-range/jquery.range-min.js',
    ])
        .pipe(concat('vendors.js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify({
            compress: { drop_debugger: false }
        }))
        .pipe(gulp.dest(dest + 'js'))
        .pipe(browserSync.stream());
});

// Compile CSS from Sass files
gulp.task('sass', function () {
    return gulp.src('./assets/src/scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(concatCss("style.min.css"))
        .pipe(stripCssComments({ preserve: false }))
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(gulp.dest(dest + 'css'))
        .pipe(browserSync.stream());
});

gulp.task('images', function () {
    return gulp.src(src + 'img/**/*')
        //.pipe(cache(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true })))
        .pipe(gulp.dest(dest + 'img'));
});

// Watch for changes in files
gulp.task('watch', function () {

    var files = [
        '**/*.php',
        '**/*.{png,jpg,gif}'
    ];

    browserSync.init(files, {
        proxy: 'localhost/recifecentro/',
        injectChanges: true,
        port: 4000,
        notify: true,
        ui: {
            port: 4001
        }
    });
    // Watch .js files
    gulp.watch(src + 'js/**/*.js', ['scripts']);
    // Watch .scss files
    gulp.watch(src + 'scss/**/*.scss', ['sass']);
    // Watch image files
    gulp.watch(src + 'img/**/*', ['images']);

    //gulp.watch("*.html").on('change', browserSync.reload);

});

// Move Fontawesome webfonts to build folder
gulp.task('icons', function () {
    return gulp.src('./node_modules/@fortawesome/fontawesome-free/webfonts/**.*')
        .pipe(gulp.dest('./assets/build/fonts'));
});

// Default Task
gulp.task('default', ['scripts', 'vendors', 'sass', 'watch']);