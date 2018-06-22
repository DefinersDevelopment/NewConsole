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

<<<<<<< HEAD

mix.js('resources/assets/js/ajax.js', 'public/js/app.js');
mix.js('resources/assets/js/user-interface.js', 'public/js/app.js');


mix.sass('resources/assets/sass/app.scss', 'public/css');
=======
mix.js('resources/assets/js/ajax.js', 'public/js/app.js');
mix.js('resources/assets/js/user-interface.js', 'public/js/app.js');
>>>>>>> 4305c7c17dc7c2cc2e83359fae84897686726108


mix.sass('resources/assets/sass/app.scss', 'public/css');

