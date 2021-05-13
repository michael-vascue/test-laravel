const mix = require('laravel-mix');

mix.disableNotifications(); //close the laravel mix notification (snore toast)

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();



