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

mix.styles([
    'resources/assets/bootstrap/css/bootstrap.min.css',
    'resources/assets/font-awesome/4.5.0/css/font-awesome.min.css',
    'resources/assets/ionicons/2.0.1/css/ionicons.min.css',
    'resources/assets/plugins/iCheck/all.css',
    'resources/assets/plugins/iCheck/minimal/_all.css',
    'resources/assets/plugins/datepicker/datepicker3.css',
    'resources/assets/plugins/select2/select2.min.css',
    'resources/assets/plugins/datatables/dataTables.bootstrap.css',
    'resources/assets/dist/css/AdminLTE.min.css',
    'resources/assets/dist/css/skins/_all-skins.min.css',
],'public/css/admin.css');
mix.scripts([
    'resources/assets/plugins/jQuery/jquery-2.2.3.min.js',
    'resources/assets/bootstrap/js/bootstrap.min.js',
    'resources/assets/plugins/select2/select2.full.min.js',
    'resources/assets/plugins/datepicker/bootstrap-datepicker.js',
    'resources/assets/plugins/datatables/jquery.dataTables.min.js',
    'resources/assets/plugins/datatables/dataTables.bootstrap.min.js',
    'resources/assets/plugins/slimScroll/jquery.slimscroll.min.js',
    'resources/assets/plugins/fastclick/fastclick.js',
    'resources/assets/plugins/iCheck/icheck.min.js',
    'resources/assets/dist/js/app.min.js',
    'resources/assets/dist/js/demo.js',

    'resources/assets/dist/js/scripts.js',
],'public/js/admin.js');
mix.copy([
    'resources/assets/bootstrap/fonts',
    'resources/assets/dist/fonts',
],'public/fonts');
mix.copy([
    'resources/assets/dist/img',
],'public/img');
mix.copy([
    'resources/assets/plugins/iCheck/minimal/blue.png',
],'public/css');
mix.styles([
    'resources/assets/front/css/bootstrap.min.css',
    'resources/assets/front/css/font-awesome.min.css',
    'resources/assets/front/css/animate.min.css',
    'resources/assets/front/css/owl.carousel.css',
    'resources/assets/front/css/owl.theme.css',
    'resources/assets/front/css/owl.transitions.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/responsive.css',
],'public/css/front.css');
mix.scripts([
    'resources/assets/front/js/jquery-1.11.3.min.js',
    'resources/assets/front/js/bootstrap.min.js',
    'resources/assets/front/js/owl.carousel.min.js',
    'resources/assets/front/js/jquery.stickit.min.js',
    'resources/assets/front/js/menu.js',
    'resources/assets/front/js/scripts.js',
],'public/js/front.js');
mix.copy([
    'resources/assets/front/fonts',
],'public/fonts');
mix.copy([
    'resources/assets/front/images',
],'public/img');
