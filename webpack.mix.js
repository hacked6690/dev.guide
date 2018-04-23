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

// mix.setPublicPath(path.normalize('../assets/admin'))

// mix.js('resources/assets/js/app.js', 'js')
// 	.sass('resources/assets/sass/app.scss', 'css').version();

mix.js('resources/assets/js/custom.js', 'assets/admin/js')
   	// .sass('resources/assets/sass/helpers.scss', 'assets/admin/css')
   	.version();