const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('admin/layout.scss')
    	.sass('global/plugins-md.scss')
    	.sass('global/components-md.scss')
    	.sass('admin/themes/default.scss')
    	.sass('pages/login.scss')
        .sass('pages/profile.scss')
    	.sass('pages/portfolio.scss')
    	.copy('resources/assets/js/layout.js', 'public/js/layout.js')
    	.copy('resources/assets/js/metronic.js', 'public/js/metronic.js')
        .copy('resources/assets/js/login.js', 'public/js/login.js')
    	.copy('resources/assets/js/portfolio.js', 'public/js/portfolio.js')
    	.webpack('app.js', null, 'vue');
});
