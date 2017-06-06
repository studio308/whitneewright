var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

// elixir.config.production = true;,
elixir.config.assetsPath = 'resources/assets/';
elixir.config.appPath = '';
elixir.config.publicPath = 'public/assets/';
elixir.config.js.folder = elixir.config.css.folder = elixir.config.css.sass.folder = '/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy(elixir.config.assetsPath + 'vendor/aws/aws-sdk-2.32.0.min.js',
        elixir.config.publicPath + 'js/aws-sdk-2.32.0.min.js');
    mix.sass('app.scss');



    //Admin components
    mix.browserify('components/categories/categories.js');
    mix.browserify('components/works/create/works.js');
    mix.browserify('components/events/addevent.js');
});
