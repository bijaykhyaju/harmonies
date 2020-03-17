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

mix.js('resources/js/app.js', 'public/js')
    .js('node_modules/tone/build/Tone.js', 'public/js/Tone.js')
    .js('node_modules/tone/build/Tone.js.map', 'public/js/Tone.js.map')
   .sass('resources/sass/app.scss', 'public/css');
