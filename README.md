# SmallGo
   SmallGo是一个开源的淘宝客系统，支持pc和手机浏览，支持微信，基于全球最流行php框架laravel开发，后台采用laravel-admin开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，以帮助想做淘宝客的朋友。突破了传统淘宝客程序对自动采集商品收费的模式，代码不加密，方便大家修改。

   采用laravel作为开发框架，项目后台依赖laravel-admin搭建，需要安装PHP 7.1+和Laravel 5.5，php包管理采用composer，如您不了解composer，请自行百度学习，以下内容默认您对larvavel和composer已经了解或熟悉，前端包管理采用npm，前端资源编译采用laravel-mix

   ## 主要特色：
   ###### <font color=#ff0000>优惠券 淘口令 淘点金 后台更新商品信息 支持微信 单品自动更新 联盟精选导入 关键词提取</font>
       
安装(linux) 

1、
    
    $ git clone https://gitee.com/jcove/SmallGo.git
    
    $ cd SmallGo 
    
    $ chmod -R 775 storage
    
    $ chmod -R 775 public/uploads
    
    $ chmod -R 775 bootstrap/cache
    
    $ composer install
2、 
    
   在浏览器地址栏输入： http://你的域名/install
   
   按照提示进行安装
   
   进入 《环境设置》 后，建议选择《直接编辑》，修改如下配置，如无，请添加
   
    DB_HOST=127.0.0.1，数据库地址
   
    DB_PORT=3306， 数据库端口
   
    DB_DATABASE=smallgo，数据库名
   
    DB_USERNAME=homestead，数据库用户名
   
    DB_PASSWORD=secret，数据库密码
   
    TAOBAO_APP_KEY      =   你的淘宝开放平台APP_KEY
   
    TAOBAO_APP_SECRET   =   你的淘宝开放平台APP_SECRET
   
    AD_ZONE_ID          =   adzone_id,在pid中，PID：mm_memberid_siteid_adzoneid
   
    TAOBAO_PID          =   淘宝联盟pid，形如：mm_xxxxx_xxxxx_xxxx
   
    BOSONNLP_TOKEN      =   BosonNLP分词Token,注册地址https://bosonnlp.com
   
   如果选择《向导模式》，安装完毕后请手动修改.env文件中如下配置
   
    AOBAO_APP_KEY      =   你的淘宝开放平台APP_KEY
      
    AOBAO_APP_SECRET   =   你的淘宝开放平台APP_SECRET
      
    AD_ZONE_ID          =   adzone_id,在pid中，PID：mm_memberid_siteid_adzoneid
      
    TAOBAO_PID          =   淘宝联盟pid，形如：mm_xxxxx_xxxxx_xxxx
      
    BOSONNLP_TOKEN      =   BosonNLP分词Token,注册地址https://bosonnlp.com
      
    
后台：http://你的域名/admin  用户名：admin 密码：admin

安装参考：http://www.361dream.com/article/63

如遇到问题请加群，或者发帖求助
    
演示站点 http://demo.nayiya.com (支持pc、微信和手机浏览)

####演示站点环境：

操作系统: centos7.2  

php环境：lnmp集成环境，mysql5.7，php7.1
  
完整安装流程：http://www.361dream.com/article/65  
  
交流社区(搭建中) http://www.361dream.com


QQ交流群：169730866