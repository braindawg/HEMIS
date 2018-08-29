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

mix.styles([
        //GLOBAL MANDATORY STYLES
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/simple-line-icons.min.css',
        'resources/assets/css/bootstrap-rtl.min.css',
        //'resources/assets/css/uniform.default.css',
        // 'resources/assets/css/bootstrap-switch-rtl.min.css',
        'resources/assets/css/select2.min.css',
        'resources/assets/css/select2-bootstrap.min.css',
        //THEME GLOBAL STYLES
        'resources/assets/css/components-rtl.min.css',
        'resources/assets/css/plugins-rtl.min.css',
        
        //THEME LAYOUT STYLES
        'resources/assets/css/layout-rtl.min.css',
        'resources/assets/css/light-rtl.min.css',
        'resources/assets/css/custom-rtl.min.css',
        
    ], 'public/css/all.css')
    .styles([
        
        'resources/assets/css/datatables.min.css',
        'resources/assets/css/datatables.bootstrap-rtl.css',
        
    ], 'public/css/datatables.css')
    .styles([
        
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/simple-line-icons.min.css',
        'resources/assets/css/bootstrap-rtl.min.css',
        'resources/assets/css/uniform.default.css',
        'resources/assets/css/components-rtl.min.css',
        'resources/assets/css/plugins-rtl.min.css',
        'resources/assets/css/login-5-rtl.css',
        
    ], 'public/css/login.css')

    .scripts([
        //CORE PLUGINS
        'resources/assets/js/jquery.min.js',
        //'node_modules/vue/dist/vue.js',
        'resources/assets/js/bootstrap.min.js',
        'resources/assets/js/js.cookie.min.js',
        //'resources/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'resources/assets/js/jquery.slimscroll.min.js',
        'resources/assets/js/jquery.blockui.min.js',
        
        'resources/assets/js/select2.min.js',
        'resources/assets/js/fa.js',
        //'resources/assets/global/plugins/uniform/jquery.uniform.min.js',
        'resources/assets/js/bootstrap-switch.min.js',
        //THEME GLOBAL
        'resources/assets/js/app.js',
        //HEME LAYOUT SCRIPTS
        'resources/assets/js/layout.min.js',
        'resources/assets/js/demo.min.js',
        'resources/assets/js/quick-sidebar.min.js',
        //'resources/assets/js/app.js',
    ], 'public/js/all.js')
    .scripts([        
        'resources/assets/js/jquery.validate.min.js',
        'resources/assets/js/additional-methods.min.js',
        'resources/assets/js/select2.full.min.js',
        'resources/assets/js/jquery.backstretch.min.js',
        'resources/assets/js/app.js',
        'resources/assets/js/login-5.js',
    ], 'public/js/login.js')
    .scripts([        
        'resources/assets/js/jquery.dataTables.min.js',
        'resources/assets/js/dataTables.buttons.min.js',        
    ], 'public/js/datatables.js');
   
//.sass('resources/assets/sass/app.scss', 'public/css');
