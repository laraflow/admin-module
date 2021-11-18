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

mix.copyDirectory(__dirname + '/node_modules/admin-lte/dist', __dirname + '/Resources/assets/')
    .copyDirectory(__dirname + '/node_modules/admin-lte/plugins', __dirname + '/Resources/plugins/')
    .copyDirectory(__dirname + '/node_modules/@mdi/font/css', __dirname + '/Resources/plugins/mdi/css/')
    .copyDirectory(__dirname + '/node_modules/@mdi/font/fonts', __dirname + '/Resources/plugins/mdi/fonts/')
    .sass(__dirname + '/Resources/sass/custom-switch.scss',     __dirname + '/Resources/assets/css/', {
        sourceMap: true,
        sassOptions: {
            outputStyle: "compressed",
        }
    });
