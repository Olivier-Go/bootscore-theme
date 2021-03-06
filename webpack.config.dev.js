const webpack = require('webpack');
const path = require('path');

// mini-css-extract-plugin (https://github.com/webpack-contrib/mini-css-extract-plugin) : permet d'extraire le code CSS provenant de plusieurs fichiers
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
// browser-sync-webpack-plugin (https://www.npmjs.com/package/browser-sync-webpack-plugin) : permet d'utiliser Browsersync avec Webpack.
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
// copy-webpack-plugin (https://github.com/webpack-contrib/copy-webpack-plugin) : permet de copier des répertoires ou fichiers de notre application
const CopyPlugin = require('copy-webpack-plugin');
// chokidar (https://github.com/paulmillr/chokidar) : permet d'ajouter des écouteurs d'événement sur des modifications de fichiers
const chokidar = require('chokidar');
// webpack-build-notifier  (https://www.npmjs.com/package/webpack-build-notifier) : permet de recevoir des notifications au niveau du système d'exploitation à chaque nouveau build de Webpack
const WebpackBuildNotifierPlugin = require('webpack-build-notifier');


const watchMode = process.env.NODE_ENV === 'watch';

let config = {
  entry: [
    './src/js/app.js',
    './src/scss/style.scss',
  ],
  mode: 'development',
  output: {
    path: path.resolve(__dirname, "./public"),
    filename: "js/app.js"
  },
  devtool: 'source-map',
  module: {
    rules: [
      // Sass
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          watchMode ?
          // Utilisation du style-loader avec le watcher
          {
            loader: 'style-loader',
            options: {
              sourceMap: true
            }
          } :
          // Utilisation de mini-css-extract-plugin en dehors watcher
          {
            loader: MiniCSSExtractPlugin.loader,
            options: {
              sourceMap: true
            }
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true
            }
          },
          // Permet de compiler le sass
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true
            }
          }
        ]
      },
    ]
  },
  // Configuration du serveur de développement qui rechargera automatiquement les contenus lors d'un changement
  devServer: {
    contentBase: path.join(__dirname, 'public'),
    hot: true,
    watchContentBase: true,
    port: 3100,
    host: '0.0.0.0',
    before: function(app, server) {
      // Gestion manuelle de la recharge tous les websockets de watching à la modification des fichiers HTML à l'aide de chokidar
      chokidar.watch([
        './app/assets/**/*.html'
      ]).on(
        'all',
        function() {
          // @todo filter sockets that must be reloaded based on http URL
          server.sockWrite(server.sockets, 'content-changed')
        }
      )
    }
  },
};


const plugins = [
  new MiniCSSExtractPlugin({
    filename: 'css/style.css'
  }),
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery'
  }),
  new CopyPlugin([
    {
      from: 'app/assets/**',
      to: '.',
      toType: 'dir',
      transformPath: (targetPath) => targetPath.replace(/^app\/assets\//, '')
    }
  ]),
  new webpack.HotModuleReplacementPlugin(),
  new BrowserSyncPlugin(
    {
      host: '0.0.0.0',
      port: 3000,
      proxy: 'http://localhost:3100/',
      open: 'external',
    },
    {
      // Browsersync ne se charge pas du reload, c'est le rôle du Dev Server
      reload: false
    }
  ),
];

if (watchMode) {
  plugins.push(
    new WebpackBuildNotifierPlugin({
      title: "Webpack",
      suppressSuccess: true
    })
  );
}

config.plugins = plugins;

module.exports = config;
