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
//  mix.setResourceRoot('path'); 
//  mix.setPublicPath('path');

// mix.webpackConfig({
//     module: {
//       rules: [{
//         test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
//         loaders: [{
//           loader: 'file-loader',
//           options: {
//             name: (path) => {
//               if (!/node_modules|bower_components/.test(path)) {
//                 return 'fonts/[name].[ext]?[hash]';
//               }
//               return (
//                 'fonts/vendor/' +
//                 path
//                 .replace(/\\/g, '/')
//                 .replace(
//                   /((.*(node_modules|bower_components))|fonts|font|assets)\//g,
//                   ''
//                 ) +
//                 '?[hash]'
//               );
//             },
//           },
//         }],
//       }],
//     },
// })

mix.disableNotifications(); //close the laravel mix notification (snore toast)

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();



