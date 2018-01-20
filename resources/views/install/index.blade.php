<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmallGo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">

    <h1>SmallGo  安装协议</h1>
    <div style="background: #eee;padding: 30px;margin-bottom: 40px">
        <p>版权所有 (c) 2017，筑梦科技保留所有权利。</p>

        <p>感谢您选择SmallGo，希望我们的努力能为您提供一个简单、强大的站点解决方案。我们的网址为 <a href="http://www.361dream.com" target="_blank">http://www.361dream.com</a>。</p>

        <p>用户须知：本协议是您与筑梦科技之间关于您使用SmallGo产品及服务的法律协议。无论您是个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，包括免除或者限制筑梦责任的免责条款及对您的权利限制。请您审阅并接受或不接受本服务条款。如您不同意本服务条款及/或筑梦随时对其的修改，您应不使用或主动取消SmallGo产品。否则，您的任何对SmallGo的相关服务的注册、登陆、下载、查看等使用行为将被视为您对本服务条款全部的完全接受，包括接受筑梦对服务条款随时所做的任何修改。</p>

        <p>本服务条款一旦发生变更, 筑梦将在产品官网上公布修改内容。修改后的服务条款一旦在网站公布即有效代替原来的服务条款。您可随时登陆官网查阅最新版服务条款。如果您选择接受本条款，即表示您同意接受协议各项条件的约束。如果您不同意本服务条款，则不能获得使用本服务的权利。您若有违反本条款规定，筑梦科技有权随时中止或终止您对SmallGo产品的使用资格并保留追究相关法律责任的权利。</p>

        <p>在理解、同意、并遵守本协议的全部条款后，方可开始使用SmallGo产品。您也可能与筑梦科技直接签订另一书面协议，以补充或者取代本协议的全部或者任何部分。</p>

        <p>筑梦科技拥有SmallGo的全部知识产权，包括商标和著作权。本软件只供许可协议，并非出售。顶想只允许您在遵守本协议各项条款的情况下复制、下载、安装、使用或者以其他方式受益于本软件的功能或者知识产权。</p>
        <p>SmallGo遵循Apache Licence2开源协议，并且免费使用（但不包括其衍生产品、插件或者服务）。Apache Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，允许代码修改，再作为开源或商业软件发布。需要满足的条件：<br/>
            1． 需要给用户一份Apache Licence ；<br/>
            2． 如果你修改了代码，需要在被修改的文件中说明；<br/>
            3． 在延伸的代码中（修改和有源代码衍生的代码中）需要带有原来代码中的协议，商标，专利声明和其他原来作者规定需要包含的说明；<br/>
            4． 如果再发布的产品中包含一个Notice文件，则在Notice文件中需要带有本协议内容。你可以在Notice中增加自己的许可，但不可以表现为对Apache Licence构成更改。</p>
    </div>

    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <a class="btn btn-primary btn-large" href="{{url('/install/db')}}">同意安装协议</a>
            <a class="btn btn-large" href="http://www.361dream.com">不同意</a>
        </div>
    </div>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>