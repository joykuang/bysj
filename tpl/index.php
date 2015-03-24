<?php
    $env = 'development';

    function ver(){
        $str = md5(md5(time('YYYY-MM-dd H:m:s').'DaoCMS -- Copyright (c) Yueruan Studio 2015'));
        $str = md5(base64_encode($str));
        echo substr($str,8,8);
    }
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
    <!-- 声明文档使用的字符编码 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- 为移动设备添加 viewport --><!-- `width=device-width` 会导致 iPhone 5 添加到主屏后以 WebApp 全屏模式打开页面时出现黑边 http://bigc.at/ios-webapp-viewport-meta.orz -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <!--"添加到主屏幕"后，全屏显示 -->
    <meta name="apple-touch-fullscreen" content="yes">
    <!--IOS私有属性(apple-mobile-web-app-capable),启用 webapp 模式, 会隐藏工具栏和菜单栏，和其它配合使用。-->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!--在webapp模式下，改变顶部状态条的颜色。-->
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <!--忽略将页面中的数字识别为电话号码 -->
    <meta content="telephone=no" name="format-detection">
    <!-- iOS 设备 begin -->
    <meta name="apple-mobile-web-app-title" content="道CMS">
    <link rel="Shortcut Icon" href=" http://www.letv.com/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="http://i1.letvimg.com/img/201310/09/appLetv.png"/>
        <title>我的网站 &rsaquo;&rsaquo; Dao CMS 内容管理系统 @Powered By 悦软工作室(Yueruan Studio)</title>
        <link href="/Public/plugins/uikit/css/uikit.almost-flat.min.css?<?php ver() ?>" rel="stylesheet">       
        <link href="/Public/plugins/uikit/css/components/tooltip.gradient.min.css?<?php ver() ?>" rel="stylesheet">
        <?php if ($env == 'development') { ?>
        <link href="style.less?<?php ver() ?>" rel="stylesheet/less" type="text/css">
        <!-- Less.js 脚本设置 -->
        <script>
        less = {
            env: "development",
            //async: true,
            //fileAsync: true,
            //poll: 1000,
            //functions: {},
            //dumpLineNumbers: "comments",
            relativeUrls: true,
            //compress: true,
            //rootpath: ":/a.com/"
        };
        </script>
        <script src="/Public/plugins/less.js/less.min.js?<?php ver() ?>"></script>
        <?php } else { ?>
        <link href="style.css?<?php ver() ?>" rel="stylesheet">   
        <?php } ?>
    </head>

    <body class="cms">
        <div class="cms-left">
            <div class="cms-left-account"  style="display: none;">
                <img class="avatar" src="osang.jpg">
            </div>
            <ul class="cms-left-sidebar">
                <li class="sidebar-item active">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-dashboard"></span>
                        <span class="link-item link-title">导航表</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>导航表</h3>
                        <li class="sub-link active"><a href="javascript:;">后台首页</a></li>
                        <li class="sub-link"><a href="javascript:;">程序更新</a></li>
                        <li class="sub-link"><a href="javascript:;">网站统计</a></li>
                        <li class="sub-link"><a href="javascript:;">服务支持</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-file-text"></span>
                        <span class="link-item link-title">文章</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>文章</h3>
                        <li class="sub-link"><a href="javascript:;">所有文章</a></li>
                        <li class="sub-link"><a href="javascript:;">评论管理</a></li>
                        <li class="sub-link"><a href="javascript:;">文章类型</a></li>
                        <li class="sub-link"><a href="javascript:;">文章回收</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-folder-open"></span>
                        <span class="link-item link-title">分类</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>分类</h3>
                        <li class="sub-link"><a href="javascript:;">全部分类</a></li>
                        <li class="sub-link"><a href="javascript:;">所有标签</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-file"></span>
                        <span class="link-item link-title">页面</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>页面</h3>
                        <li class="sub-link"><a href="javascript:;">所有页面</a></li>
                        <li class="sub-link"><a href="javascript:;">模板管理</a></li>
                        <li class="sub-link"><a href="javascript:;">页面类型</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-film"></span>
                        <span class="link-item link-title">媒体</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>媒体</h3>
                        <li class="sub-link"><a href="javascript:;">媒体管理</a></li>
                        <li class="sub-link"><a href="javascript:;">上传文件</a></li>
                        <li class="sub-link"><a href="javascript:;">文件统计</a></li>
                        <li class="sub-link"><a href="javascript:;">垃圾清理</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-user"></span>
                        <span class="link-item link-title">用户</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>用户</h3>
                        <li class="sub-link"><a href="javascript:;">我的账号</a></li>
                        <li class="sub-link"><a href="javascript:;">所有用户</a></li>
                        <li class="sub-link"><a href="javascript:;">群组管理</a></li>
                        <li class="sub-link"><a href="javascript:;">角色指派</a></li>
                        <li class="sub-link"><a href="javascript:;">权限分配</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item" style="margin-top: 1em;">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-magic"></span>
                        <span class="link-item link-title">主题</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>主题</h3>
                        <li class="sub-link"><a href="javascript:;">所有主题</a></li>
                        <li class="sub-link"><a href="javascript:;">主题安装</a></li>
                        <li class="sub-link"><a href="javascript:;">主题市场</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-puzzle-piece"></span>
                        <span class="link-item link-title">扩展</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>扩展</h3>
                        <li class="sub-link"><a href="javascript:;">所有插件</a></li>
                        <li class="sub-link"><a href="javascript:;">插件安装</a></li>
                        <li class="sub-link"><a href="javascript:;">插件市场</a></li>
                        <li class="sub-link"><a href="javascript:;">导入</a></li>
                        <li class="sub-link"><a href="javascript:;">导出</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-database"></span>
                        <span class="link-item link-title">数据</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>数据</h3>
                        <li class="sub-link"><a href="javascript:;">数据库状态</a></li>
                        <li class="sub-link"><a href="javascript:;">优化数据库</a></li>
                        <li class="sub-link"><a href="javascript:;">备份数据库</a></li>
                        <li class="sub-link"><a href="javascript:;">恢复数据库</a></li>
                        <li class="sub-link"><a href="javascript:;">修复数据库</a></li>
                        <li class="sub-link"><a href="javascript:;">管理数据库</a></li>
                        <li class="sub-link"><a href="javascript:;">重置数据库</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-cog"></span>
                        <span class="link-item link-title">设置</span>
                        <span class="link-item link-arrow uk-icon-angle-right"></span>
                        <div class="clearfix"></div>
                    </a>
                    <ul class="sub-menu">
                        <h3>设置</h3>
                        <li class="sub-link"><a href="javascript:;">一般设置</a></li>
                        <li class="sub-link"><a href="javascript:;">内容设置</a></li>
                        <li class="sub-link"><a href="javascript:;">阅读设置</a></li>
                        <li class="sub-link"><a href="javascript:;">路由设置</a></li>
                        <li class="sub-link"><a href="javascript:;">安全设置</a></li>
                        <li class="sub-link"><a href="javascript:;">高级设置</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item tooltip-about">
                    <a class="item-link">
                        <span class="link-item link-icon uk-icon-info-circle"></span>
                        <span class="link-item link-title">关于</span>
                        <div class="clearfix"></div>
                    </a>
                    <div class="clearfix"></div>
                </li>
                <li class="sidebar-item tooltip-switcher" style="display: none;">
                    <a class="item-link sidebar-switcher">
                        <span class="link-item link-icon uk-icon-arrow-circle-left"></span>
                        <span class="link-item link-title" style="font-size: 12px;">折叠菜单</span>
                        <div class="clearfix"></div>
                    </a>
                    <div class="clearfix"></div>
                </li>
                <div class="clearfix"></div>
            </ul>
        
        </div>
        <div class="cms-right">
            <div class="cms-top">
                <ul class="cms-nav uk-float-left">
                    <li>
                        <a class="cms-icon uk-icon-wordpress"></a>
                        <ul>
                            <li><a><i class="cms-icon uk-icon-eye"></i>查看网站</a></li>
                            <li><a><i class="cms-icon uk-icon-coffee"></i>网站状态</a></li>
                            <li><a><i class="cms-icon uk-icon-bar-chart"></i>站长统计</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>系统设置</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <li>
                        <a class="cms-icon uk-icon-plus-circle"></a>
                        <ul>
                            <li><a><i class="cms-icon uk-icon-eye"></i>撰写文章</a></li>
                            <li><a><i class="cms-icon uk-icon-coffee"></i>新建页面</a></li>
                            <li><a><i class="cms-icon uk-icon-bar-chart"></i>添加分类</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>上传媒体</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>新增用户</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <li>
                        <a class="cms-icon uk-icon-comments"></a>
                        <ul>
                            <li><a><i class="cms-icon uk-icon-cog"></i>文章评论</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>站内私信</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>系统通知</a></li>
                            <li><a><i class="cms-icon uk-icon-cog"></i>发送消息</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <div class="clearfix"></div>
                </ul>
                
                <ul class="cms-nav uk-float-right">
                    <li>
                        <a class="cms-icon uk-icon-info-circle"></a>
                        <ul>
                            <li><a><i class="cms-icon no-icon"></i>查看网站</a></li>
                            <li><a><i class="cms-icon no-icon"></i>网站状态</a></li>
                            <li><a><i class="cms-icon no-icon"></i>站长统计</a></li>
                            <li><a><i class="cms-icon no-icon"></i>系统设置</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <li>
                        <a class="cms-icon uk-icon-user"></a>
                        <ul>
                            <li><a><i class="cms-icon no-icon"></i>撰写文章</a></li>
                            <li><a><i class="cms-icon no-icon"></i>新建页面</a></li>
                            <li><a><i class="cms-icon no-icon"></i>添加分类</a></li>
                            <li><a><i class="cms-icon no-icon"></i>上传媒体</a></li>
                            <li><a><i class="cms-icon no-icon"></i>新增用户</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <li>
                        <a class="cms-icon uk-icon-cog"></a>
                        <ul>
                            <li><a><i class="cms-icon no-icon"></i>文章评论</a></li>
                            <li><a><i class="cms-icon no-icon"></i>站内私信</a></li>
                            <li><a><i class="cms-icon no-icon"></i>系统通知</a></li>
                            <li><a><i class="cms-icon no-icon"></i>发送消息</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </li>
                    
                    <div class="clearfix"></div>
                </ul>
            </div>
            <div class="cms-content">
                <div class="cms-content-wrap"></div>
            </div>
        </div>
        <!--  JS库  -->
        <script src="/Public/js/require.js?<?php ver()?>"></script> 
        <script>
            requirejs.config({
                baseUrl: '/Public/js',
                paths: {
                    jquery: '../plugins/jquery/jquery-1.11.2.min',
                    uikit: '../plugins/uikit/js/uikit.min',
                    components: '../plugins/uikit/js/components',
                    core: '../plugins/uikit/js/core'
                }
            });
            requirejs(['jquery'], function(){
                requirejs(['uikit', 'components/tooltip.min'], function(){
                    $.getScript('main.js');
                });
            });
        </script>
    </body>
</html>
