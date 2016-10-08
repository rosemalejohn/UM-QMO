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

elixir.sourcemaps = false;

elixir(mix => {
    mix
        .webpack('app.js', null, 'vue')

        .scripts([
            'metronic.js',
            'layout.js',
            'portfolio.js'
        ], 'public/js/app-theme.js')

        .scripts([
            'metronic.js',
            'layout.js',
            'login.js'
        ], 'public/js/guest-theme.js')

        .sass([
            'admin/layout.scss',
            'global/plugins-md.scss',
            'global/components-md.scss',
            'admin/themes/default.scss',
            'pages/profile.scss',
            'pages/portfolio.scss',
            'pages/error.scss',
        ], 'public/css/app.css')

        .sass([
            'admin/layout.scss',
            'global/plugins-md.scss',
            'global/components-md.scss',
            'admin/themes/default.scss',
            'pages/login.scss',
        ], 'public/css/guest.css');
});
