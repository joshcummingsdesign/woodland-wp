const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = (entries, presets, compact, isProduction, plugins, lazypipe) =>
  lazypipe()
    .pipe(plugins.webpackStream, {
      mode: isProduction ? 'production' : 'development',
      devtool: isProduction ? 'none' : 'eval-source-map',
      cache: true,
      entry: entries,
      output: {
        filename: '[name].js'
      },
      module: {
        rules: [
          {
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /tests/,
            query: {
              presets: presets,
              cacheDirectory: true,
              compact: compact
            }
          }
        ]
      },
      optimization: {
        minimizer: [
          new UglifyJsPlugin({
            uglifyOptions: {
              sourceMap: true,
              compress: {
                warnings: false,
              },
              output: {
                comments: false
              }
            }
          }),
        ],
      },
      plugins: [
        new plugins.webpackStream.webpack.ProvidePlugin({
          $: 'jquery',
          jQuery: 'jquery',
          'window.jQuery': 'jquery'
        })
      ]
    })();
