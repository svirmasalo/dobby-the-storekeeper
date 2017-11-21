/*****************/
/** Reuirements **/
/*****************/

const gulp          = require('gulp');
const browserSync   = require('browser-sync').create();
const sourcemaps    = require('gulp-sourcemaps');
const concat        = require('gulp-concat');
const rename        = require('gulp-rename');
const uglify        = require('gulp-uglify');

const sass          = require('gulp-sass');
const autoprefixer  = require('gulp-autoprefixer');
const minifycss     = require('gulp-clean-css');

/********************/
/** Path variables **/
/********************/

const scss_src      = './scss/**/*.{scss,sass}';
const scss_global   = './scss/global.scss';
const css_dist      = './css/';

const js_src        = './js/dev/*.js';
const js_dist       = './js';

const php_low       = './*.php';
const php_top       = './template-parts/*.php';
const wc_over       = './woocommerce/**/*.php';

/**********************/
/** Style processing **/
/**********************/

gulp.task('styles-main', () =>
    gulp.src(scss_global)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error',sass.logError))
        .pipe(autoprefixer({
            browsers:['last 2 versions'],
            cascade:false,
        }))
        .pipe(minifycss({compatibility: 'ie8'},{debug:true}, function(details) {
        	console.log(details.name + ': ' + details.stats.originalSize);
        	console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(rename({ extname: '.min.css' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(css_dist))
        .pipe(browserSync.reload({stream:true}))
);

/**********************/
/** Script processing**/
/**********************/

gulp.task('scripts-main',function(){
    return gulp.src([js_src])
        .pipe(sourcemaps.init())
        .pipe(concat('all.min.js'))
        .pipe(uglify({preserveComments: false, compress: true, mangle: true}).on('error',function(e){console.log('\x07',e.message);return this.end();}))
        //.pipe(rename({ extname: '.min.js' }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(js_dist))
    .pipe(browserSync.reload({stream:true}))
});


/******************/
/** Browser sync **/
/******************/

gulp.task('browser-sync',function(){
    browserSync.init({
        open:'external',
        host:'svirmasalo.dev',
        proxy:{
            target: "svirmasalo.dev/dts-dev" //Your server here!!
        },
        port:8080
    })
});

/***********/
/** Watch **/
/***********/

gulp.task('js-watch', ['scripts-main']);

gulp.task('watch', ['browser-sync'], function() {

	// Watch PHP-files
    gulp.watch([php_low,php_top,wc_over]).on('change',browserSync.reload);

    // Watch styles
    gulp.watch(scss_src, ['styles-main']).on('change',browserSync.reload);

    // Watch scripts
    gulp.watch(js_src, ['js-watch']).on('change',browserSync.reload);
});