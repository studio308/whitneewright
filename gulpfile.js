var gulp            = require('gulp');
var babel           = require('gulp-babel');
var browserSync     = require('browser-sync');
var rename          = require('gulp-rename');
var vueComponent    = require('gulp-vue-single-file-component');
//require('laravel-elixir-vueify');

// elixir.config.production = true;,
// elixir.config.assetsPath = 'resources/assets/';
// elixir.config.appPath = '';
// elixir.config.publicPath = 'public/assets/';
// elixir.config.js.folder = elixir.config.css.folder = elixir.config.css.sass.folder = '/';
//
// /*
//  |--------------------------------------------------------------------------
//  | Elixir Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Elixir provides a clean, fluent API for defining some basic Gulp tasks
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for our application, as well as publishing vendor resources.
//  |
//  */
//
// elixir(function(mix) {
//     mix.copy(elixir.config.assetsPath + 'vendor/aws/aws-sdk-2.32.0.min.js',
//         elixir.config.publicPath + 'js/aws-sdk-2.32.0.min.js');
//     mix.sass('sass/app.scss');
//
//     mix.browserify('js/app.js');
//
//     //Admin components
//     mix.browserify('components/categories/categories.js');
//     mix.browserify('components/works/create/works.js');
//     mix.browserify('components/events/addevent.js');
//
//     //page views
//     mix.browserify('components/works/workspage.js');
//     mix.browserify('components/events/eventspage.js');
// });

gulp.task('sass', function(){
    return gulp.src('resources/assets/sass/app.scss')
        .pipe(sass()) // Converts Sass to CSS with gulp-sass
        .pipe(gulp.dest('public/assets/css'))
});

gulp.task('scripts', function() {
    gulp.src('resources/assets/components/works/workspage.js')
        .pipe(babel({plugins: ['@babel/plugin-transform-modules-amd']}))
        .pipe(gulp.dest('public/assets/js'))
        .pipe(browserSync.stream())
});

gulp.task('vue', function() {
    gulp.src('resources/assets/components/works/WorksPage.vue')
        .pipe(vueComponent({debug: true, loadCssMethod: 'loadCss'}))
        .pipe(babel({plugins: ['@babel/plugin-transform-modules-amd']}))
        .pipe(rename({extname: '.js'}))
        .pipe(gulp.dest('public/assets/js'))
        .pipe(browserSync.stream())
});


// gulp.task('default', function(){
//     // gulp.src('resources/assets/components/categories.js')
//     //     .pipe(browserify())
//     //     .pipe(gulp.dest('public/assets/js'))
//     //
//     // gulp.src('resources/assets/components/works/create/works.js')
//     //     .pipe(browserify())
//     //     .pipe(gulp.dest('public/assets/js'))
//     //
//     // gulp.src('resources/assets/components/events/addevent.js')
//     //     .pipe(browserify())
//     //     .pipe(gulp.dest('public/assets/js'))
//
//     gulp.src('resources/assets/components/works/WorksPage.vue')
//         .pipe(vueComponent({ /* options */ }))
//         .pipe(gulp.dest('public/assets/js'))
//
//     // gulp.src('resources/assets/components/events/eventspage.js')
//     //     .pipe(browserify())
//     //     .pipe(gulp.dest('public/assets/js'))
// });
