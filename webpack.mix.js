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
  .disableSuccessNotifications()
  .disableNotifications()