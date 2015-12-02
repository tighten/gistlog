var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    // run: gulp && gulp watch | php artisan serve --host=0.0.0.0
    mix.browserSync({
        proxy:  'localhost:8000',
        notify: false
    });

    mix.less('app.less');
});
