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
    mix.less('app.less')
       .scripts(['jquery.js', 'jquery_extensions.js'], 'public/js/jquery.js')
       .scripts(['handlebars.js'], 'public/js/handlebars.js')
       .scripts(['main.js'], 'public/js/main.js');
});
