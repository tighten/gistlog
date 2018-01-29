const { mix } = require('laravel-mix');
var tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
    //.less('resources/assets/less/app.less', 'public/css/app.css')
    //.less('resources/assets/less/landing.less', 'public/css/landing.css')
    .less('resources/assets/less/base.less', './public/css')
    .options({
        postCss: [
            tailwindcss('tailwind.js'),
        ],
    })
    .browserSync({
        host: '192.168.10.10',
        proxy: 'http://gistlog.test',
        notify: false,
        open: false,
        files: [
            'app/**/*',
            'public/**/*',
            'resources/views/**/*'
        ],
        watchOptions: {
            usePolling: true,
            interval: 500
        }
    });