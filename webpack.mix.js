let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */



mix.js('resources/assets/js/ajax.js', 'public/js/app.js');
mix.js('resources/assets/js/user-interface.js', 'public/js/app.js');

let jsArray = ['resources/assets/js/ajax.js','resources/assets/js/user-interface.js'];
mix.scripts(jsArray,'public/js/app.js');


mix.sass('resources/assets/sass/app.scss', 'public/css');

