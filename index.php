<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
//define('NO_CACHE_RUNTIME',True);

//每个应用都可以在不同的情况下设置自己的状态（或者称之为应用场景），并且加载不同的配置文件。
//举个例子，你需要在公司和家里分别设置不同的数据库测试环境。那么可以这样处理，在公司环境中就会自动加载该状态对应的配置文件（位于 Application/Common/Conf/office.php ）
//define('APP_STATUS','office');


//设定非允许访问目录的默认文档

//为了避免某些服务器开启了目录浏览权限后可以直接在浏览器输入URL地址查看目录，系统默认开启了目录安全文件机制，会在自动生成目录的时候生成空白的 index.html 文件
//还可以支持多个安全文件写入，例如你想同时写入index.html和index.htm 两个文件，以满足不同的服务器部署环境
//define('DIR_SECURE_FILENAME', 'default.html,index.html,index.htm');


//如果你的环境足够安全，不希望生成目录安全文件，可以在入口文件里面关闭目录安全文件的生成
//define('BUILD_DIR_SECURE', false);

//默认的安全文件只是写入一个空白字符串，如果需要写入其他内容，可以通过DIR_SECURE_CONTENT参数来指定
//注意：目录安全文件仅在第一次运行的时候生成，如果你需要重新生成的话，可以删除RUNTIME_PATH目录，并且重命名COMMON_PATH目录。
//define('DIR_SECURE_CONTENT', '<title>404  Access Deny!</title><h1>Not Allow Access !</h1>');

//Common模块本身不能通过URL直接访问，公共模块的其他文件则可以被其他模块继承或者调用，如果要更改，我们可以在入口文件中重新定义 COMMON_PATH
//define('COMMON_PATH','./Common/');

// 定义应用目录
//define('APP_PATH','./_Studio/');
define('APP_PATH','./_Yueruan/');

// 绑定模块
//define('BIND_MODULE','Admin');
//define('BIND_CONTROLLER','Index');

// 默认模块与控控制器
define('DEFAULT_MODULE','Home');
define('DEFAULT_CONTROLLER','Index');

// 引入ThinkPHP入口文件
require './_Core/ThinkPHP.php';		//ThinkPHP Engine version 3.2.3