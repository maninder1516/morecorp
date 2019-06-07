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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
   'public/css/AdminLTE.min.css',
   'public/css/_all-skins.min.css',
   'public/css/bootstrap.min.css',
   'public/css/dataTables.bootstrap.min.css',
   'public/css/font-awesome.min.css',
   'public/css/main.css',
   'public/css/style.css',
], 'public/css/all.css');

mix.scripts([
   'public/js/jquery-3.3.1.min.js',
   'public/js/jquery-ui.js',
   'public/js/app.js',
   'public/js/adminlte.min.js',
   'public/js/bootstrap.min.js',
   'public/js/dataTables.bootstrap.min.js',
   'public/js/jquery.dataTables.min.js',
], 'public/js/all.js');