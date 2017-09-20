const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const webpack = require('webpack');
const themePath = 'wp-content/themes/giccanada';
const isDev = true;

module.exports = {
    devtool: isDev ? "source-map" : false,
    entry: './' + themePath + '/src/app.js',
    output: {
        path: path.resolve(__dirname, themePath + '/public'),
        filename: 'giccanada.js',
        library: [
            'header',
            'Window'
        ],
        publicPath: "./public/"
    },
    watch: isDev,
    module: {

        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [{
                        loader : 'css-loader',
                        options: {
                            minimize: !isDev
                        }
                    }, {
                        loader: 'sass-loader',
                        options: {
                            include: [
                                path.resolve(__dirname, '/node_modules/bootstrap/scss'),
                                path.resolve(__dirname, '/node_modules/owl.carousel/src/scss')
                            ]
                        }
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
            Tether: "tether"
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