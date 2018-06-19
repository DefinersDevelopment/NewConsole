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
let jsArray = [
				'resources/assets/js/ajax.js', 
	 	 		'resources/assets/js/user-interface.js'
	 	 	];

mix.babel(jsArray, 'public/js/app.js');

mix.sass('resources/assets/sass/app.scss', 'public/css');


