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
mix.disableNotifications();
 mix.js('resources/js/app.js', 'public/js');
 mix.js('resources/js/admin_app.js', 'public/js');
// mix.css('node_modules/gentelella/vendors/animate.css/animate.css', 'public/css')
// 	.css('node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.css', 'public/css')
// 	.css('node_modules/gentelella/vendors/font-awesome/css/font-awesome.css', 'public/css')
// 	.css('node_modules/gentelella/vendors/nprogress/nprogress.css', 'public/css')
//     .css('node_modules/gentelella/vendors/iCheck/skins/flat/green.css', 'public/css')
//     .css('node_modules/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css', 'public/css')
//     .css('node_modules/gentelella/vendors/jqvmap/dist/jqvmap.min.css', 'public/css')>
//     .css('node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css', 'public/css')
//     .css('node_modules/gentelella/build/css/custom.css', 'public/css')
    // .sass('resources/sass/app.scss', 'public/css');
mix.browserSync('localhost:8000');