const mix = require('laravel-mix');

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



mix.combine(['node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/sweetalert/dist/sweetalert.min.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/jquery-validation/dist/jquery.validate.js',
    'node_modules/jquery-validation/dist/jquery.validate.min.js',

], 'public/js/app.js');