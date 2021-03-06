const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory(__dirname + '/node_modules/admin-lte/dist', __dirname + '/Resources/dist/assets/')
    .copyDirectory(__dirname + '/node_modules/admin-lte/plugins', __dirname + '/Resources/dist/plugins/')
    .copyDirectory(__dirname + '/node_modules/@mdi/font/css', __dirname + '/Resources/dist/plugins/mdi/css/')
    .copyDirectory(__dirname + '/node_modules/@mdi/font/fonts', __dirname + '/Resources/dist/plugins/mdi/fonts/')
    .copyDirectory(__dirname + '/node_modules/bootstrap4-toggle', __dirname + '/Resources/dist/plugins/bootstrap4-toggle/')
    .copy(__dirname + '/Resources/src/js/utility.js', __dirname + '/Resources/dist/assets/js/utility.js')
    .copy(__dirname + '/Resources/dist/assets/js/utility.js', __dirname + '/Resources/dist/assets/js/utility.min.js');
