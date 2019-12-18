# SmallGo
   SmallGo是一个开源的淘宝客系统，支持pc和手机浏览，支持微信，基于全球最流行php框架laravel开发，后台采用laravel-admin开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，以帮助想做淘宝客的朋友。突破了传统淘宝客程序对自动采集商品收费的模式，代码不加密，方便大家修改。

   采用laravel作为开发框架，项目后台依赖laravel-admin搭建，需要安装PHP 7.1+和Laravel 5.5，php包管理采用composer，如您不了解composer，请自行百度学习，以下内容默认您对larvavel和composer已经了解或熟悉，前端包管理采用npm，前端资源编译采用laravel-mix

   ## 主要特色：
   ###### <font color=#ff0000>优惠券 淘口令 淘点金 后台更新商品信息 支持微信 单品自动更新 联盟精选导入 关键词提取</font>
       
安装(linux) 

    
    $ git clone https://gitee.com/jcove/SmallGo.git
    
或者
    
    $ git clone https://github.com/jcove/SmallGo.git
然后
     
    $ cd SmallGo 
    
    $ cp .example.env .env
    
修改.env文件里如下数据库配置为你的数据库

    DB_DATABASE=你的数据库名
    DB_USERNAME=你的数据库用户名
    DB_PASSWORD=你的数据库密码
然后
    
    $ chmod -R 775 storage
    
    $ chmod -R 775 public/uploads
    
    $ chmod -R 775 bootstrap/cache
    
    $ composer install
    
    $ php artisan smallgo:install

      
    
后台：http://你的域名/admin  用户名：admin 密码：admin

#SmallGo已停止更新，作者认为以后App将是主角，web应用将被弱化，作者无力开发App，决定停更，特此声明！