const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const cssnano = require('cssnano');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

const JS_DIR = path.resolve(__dirname, 'src/js');
const IMG_DIR = path.resolve(__dirname, 'src/img');
const LIB_DIR = path.resolve(__dirname, 'src/library');
const BUILD_DIR = path.resolve(__dirname, 'build');

const entry = {
	main: JS_DIR + '/main.js',
	single: JS_DIR + '/single.js',
	editor: JS_DIR + '/editor.js',
	blocks: JS_DIR + '/blocks.js',
};

const output = {
	path: BUILD_DIR,
	filename: 'js/[name].js',
};

const rules = [
	{
		test: /\.js$/,
		include: [JS_DIR],
		exclude: /node_modules/,
		use: 'babel-loader',
	},
	{
		test: /\.scss$/,
		exclude: /node_modules/,
		use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
	},
	{
		test: /\.(png|jpg|svg|jpeg|gif|ico|webp)$/,
		use: [
			{
				loader: 'file-loader',
				options: {
					name: '[path][name].[ext]',
					publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../',
				},
			},
		],
	},
	{
		test: /\.(eot|otf|ttf|woff|woff2)$/i,
		exclude: [IMG_DIR, /node_modules/],
		type: 'asset/resource',
		generator: {
			filename: 'library/fonts/[name][ext]',
		},
	},
];

const plugins = (argv) => [
	new CleanWebpackPlugin({
		cleanStaleWebpackAssets: 'production' === argv.mode,
	}),

	new MiniCssExtractPlugin({
		filename: 'css/[name].css',
	}),

	new CopyPlugin({
		patterns: [{ from: LIB_DIR, to: BUILD_DIR + '/library' }],
	}),

	new DependencyExtractionWebpackPlugin({
		injectPolyfill: true,
		combineAssets: true,
	}),
];

module.exports = (env, argv) => ({
	entry: entry,
	output: output,
	devtool: 'source-map',
	module: {
		rules: rules,
	},
	optimization: {
		minimizer: [new CssMinimizerPlugin(), new TerserPlugin({ parallel: true })],
	},
	plugins: plugins(argv),
	externals: {
		jquery: 'jQuery',
	},
	stats: {
		errorDetails: true,
	},
});
