const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue();
mix.js('resources/js/admin.js', 'public/js').vue();

mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('autoprefixer'),
]);

mix.postCss('resources/css/admin.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('autoprefixer'),
]);

if (mix.inProduction()) {
    mix.version();
}
