const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const WebpackAssetsManifest = require('webpack-assets-manifest');


module.exports = (env, argv) => ({
	entry: {
    'main': [
      './assets/js/main.js',
    ]
  },
	output: {
		path: __dirname + '/dist',
		filename: 'js/main.[contenthash].js'
	},
	module: {
		rules: [
		{
			test: /\.(jpg|png|gif|svg)$/,
			use: [
			{
				loader: 'file-loader',
				options: {
					name: "./images/[name].[ext]",
					publicPath: argv.mode === 'production' ? '../' : ''
				},
			},
			{
				loader: 'image-webpack-loader',
				options: {
					disable: argv.mode !== 'production',
				},
			}
			]
		},
		{
			test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
			exclude: [/images/],
			use: [{
				loader: 'file-loader',
				options: {
					name: '[name].[ext]',
					outputPath: 'fonts/'
				}
			}]
		}
		]
	},
	plugins: [
    new WebpackAssetsManifest({
      // Options go here
    }),
	],
  externals: {
    jquery: 'jQuery'
  }
});
