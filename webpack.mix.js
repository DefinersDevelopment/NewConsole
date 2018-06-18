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

mix.scripts(
		[  // array of all js files that need compiled
			'resources/assets/js/ajax.js', 
	 	 	'resources/assets/js/user-interface.js'
		],
			'public/js/app.js'  // where the js files get compiled to
		)
   	.sass(
   		'resources/assets/sass/app.scss',  // uncompiled scss file
   		'public/css'  // where the scss file gets compiled to
   		);


