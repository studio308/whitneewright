var gulp = require('gulp');
var sass = require('gulp-sass');
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

gulp.task('default', function(){
    gulp.src('resources/assets/components/categories.js')
        .pipe(gulp.dest('public/assets/js'))

    gulp.src('resources/assets/components/works/create/works.js')
        .pipe(gulp.dest('public/assets/js'))

    gulp.src('resources/assets/components/events/addevent.js')
        .pipe(gulp.dest('public/assets/js'))

    gulp.src('resources/assets/components/works/workspage.js')
        .pipe(gulp.dest('public/assets/js'))

    gulp.src('resources/assets/components/events/eventspage.js')
        .pipe(gulp.dest('public/assets/js'))
});
