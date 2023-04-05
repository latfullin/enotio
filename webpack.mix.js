const path = require('path')
const mix = require('laravel-mix')
const postcssSortMediaQueries = require('postcss-sort-media-queries')

mix
  .setPublicPath('public')
  .js('resources/js/app.js', 'public/js')
  .sass('resources/scss/app.scss', 'public/css')
  .options({
    postCss: [postcssSortMediaQueries],
  })
  .version()
  .sourceMaps(false, 'inline-source-map')
  .copyDirectory('resources/static', 'public')
  .alias({
    '@': path.join(__dirname, 'resources/js'),
    '@fonts': path.join(__dirname, 'resources/fonts'),
    '@images': path.join(__dirname, 'resources/static/images'),
    '@sass': path.join(__dirname, 'resources/scss'),
  })
  .disableSuccessNotifications()
  .disableNotifications()