const mix = require('laravel-mix');

mix.css('resources/css/admin.css', 'dist/css/admin.css')
   .js('resources/js/admin.js', 'dist/js/admin.js');