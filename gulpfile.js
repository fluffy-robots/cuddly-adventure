const elixir = require('laravel-elixir');

require('laravel-elixir-vue');
require('es6-promise').polyfill();
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
    mix.sass('app.scss')
       .webpack('app.js');
       // .scripts(
		// 	[
		// 		'public/js/app.js',
		// 		'resources/assets/js/vendor/insp/inspinia.js',
		// 		'resources/assets/js/vendor/metisMenu/jquery.metisMenu.js',
		// 		'resources/assets/js/vendor/pace/pace.min.js',
		// 		'resources/assets/js/vendor/slimscroll/jquery.slimscroll.min.js'
		// 	],
		// 	'public/js/all.js',
		// 	'./'
		// )
       // .browserSync({
	   	// 	proxy: 'adminpanel.dev',
	   	// 	open: 'external'
		// });
});
