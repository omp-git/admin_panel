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

mix
    // jquery-bootstrap.js,..
    .js('resources/js/app.js', 'public/js')
    // bootstrap and custom styles
    .sass('resources/sass/app.scss', 'public/css')
    // bootstrap4rtl and rtl custom styles
    .sass('resources/sass/app-rtl.scss', 'public/css')
    // admin custom styles
    .sass('resources/sass/custom-admin.scss', 'public/css')
    .copy(
        [
            'resources/js/custom-admin.js'
        ],
        'public/js');