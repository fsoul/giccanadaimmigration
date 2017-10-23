const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const webpack = require('webpack');
const themePath = 'wp-content/themes/giccanada';
const isDev = process.env.NODE_ENV === 'development';

module.exports = {
    devtool: isDev ? "source-map" : false,
    entry: './' + themePath + '/src/app.js',
    output: {
        path: path.resolve(__dirname, themePath + '/public'),
        filename: 'giccanada.js',
        library: 'app',
        publicPath: "./public/"
    },
    module: {
        rules: [
            {
                test: /\.scss$/,

                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [{
                        loader: 'css-loader',
                        options: {
                            minimize: !isDev
                        }
                    }, {
                        loader: 'sass-loader'
                    }]
                })
            },
            {
                test: /\.png|\.jpg|\.svg$/,
                use: [{
                    loader: "file-loader?name=images/[name]-[hash:10].[ext]"
                }]
            },
            {
                test: /\.woff2?$|\.ttf$|\.eot$$/,
                use: [{
                    loader: "file-loader?name=fonts/[name]-[hash:10].[ext]"
                }]
            }

        ]
    },
    plugins: [
        new ExtractTextPlugin('../style.css'),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            'window.jQuery': "jquery",
            Tether: "tether",
            'Popper': 'popper.js'
        })
    ]
};

if (!isDev) {
    module.exports.plugins.push(
        new webpack.optimize.UglifyJsPlugin({
            mangle: true,
            compress: {
                warnings: false, // Suppress uglification warnings
                pure_getters: true,
                unsafe: true,
                unsafe_comps: true,
                screw_ie8: true
            },
            output: {
                comments: false
            },
            sourceMap: true,
            exclude: [/\.min\.js$/gi] // skip pre-minified libs
        })
    );
}