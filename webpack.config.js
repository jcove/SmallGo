const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
module.exports = {
    devtool: 'eval-source-map',
    entry:  __dirname + "/app/main.js",//已多次提及的唯一入口文件
    output: {
        path: __dirname + "/public",//打包后的文件存放的地方
        filename: "bundle[hash].js"//打包后输出文件的文件名
    },
    devServer: {
        contentBase: "./build",//本地服务器所加载的页面所在的目录
        historyApiFallback: true,//不跳转
        inline: true//实时刷新
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: {
                    loader: "babel-loader",
                },
                exclude: /node_modules/
            },
            {
                test:/\.less$/,
                use:[
                    {
                        loader: "style-loader"
                    }, {
                        loader: "css-loader",
                        options: {
                            importLoaders: 1
                        }
                    },
                    {
                        loader: "less-loader"
                    }
                ]
            },
            {
                test   : /\.woff/,
                loader : 'url-loader?limit=10000&mimetype=application/font-woff'
            },
            {test: /\.ttf$/, loader: "url-loader?limit=10000&mimetype=application/octet-stream"},
            {test: /\.eot$/, loader: "file-loader"},
            {test: /\.svg$/, loader: "url-loader?limit=10000&mimetype=image/svg+xml"},
            { test: /\.(gif|jpg|png|woff|svg|eot|ttf)\??.*$/, loader: 'url-loader?limit=8192&name=images/[hash:8].[name].[ext]'},
            {
                test: /\.(htm|html)$/i,
                loader: 'html-withimg-loader'
            }
        ]
    },
    plugins:[
        new HtmlWebpackPlugin({
            template: __dirname + "/app/index.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'video.html',
            template: __dirname + "/app/video.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'plan.html',
            template: __dirname + "/app/plan.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'eb.html',
            template: __dirname + "/app/eb.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'o2o.html',
            template: __dirname + "/app/o2o.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'game.html',
            template: __dirname + "/app/game.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'erp.html',
            template: __dirname + "/app/erp.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'wx.html',
            template: __dirname + "/app/wx.tmpl.html"//new 一个这个插件的实例，并传入相关的参数
        }),
        new HtmlWebpackPlugin({
            filename: 'gov.html',
            template: __dirname + "/app/gov.html"//new 一个这个插件的实例，并传入相关的参数
        })
    ]
};
