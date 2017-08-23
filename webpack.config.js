const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

const themePath = 'wp-content/themes/giccanada';

module.exports = {
    entry: `./${themePath}/src/app.js`,
    output: {
        path: path.resolve(__dirname, `${themePath}/public`),
        filename: 'giccanada.js',
        publicPath: "./public/"
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: ['css-loader', 'sass-loader']
                })
            },
            {
                test: /\.png|\.jpg$/,
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
        new ExtractTextPlugin('../style.css')
    ]
};
