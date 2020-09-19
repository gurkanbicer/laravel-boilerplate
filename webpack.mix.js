const mix = require('laravel-mix');

mix.copy('resources/assets/stisla', 'public/assets/stisla');
mix.js('resources/assets/boilerplate/js/app.js', 'public/assets/boilerplate/js')
    .sass('resources/assets/boilerplate/sass/app.scss', 'public/assets/boilerplate/css');
