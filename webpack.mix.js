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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// Admin JS
mix.js('resources/assets/js/admin/custom.js', 'public/js/admin/custom.js').version();

// Admin CSS
mix.sass('resources/assets/sass/admin/custom.scss', 'public/css/admin/custom.css').version();