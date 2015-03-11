<?php
return array(
        //'配置项'=>'配置值'

        //  设置禁止访问的模块列表
        //'MODULE_DENY_LIST' => array('Common','Runtime','Api'),
	
        //设置访问列表
        //'MODULE_ALLOW_LIST' => array('Home','Admin','User'),
        //'DEFAULT_MODULE' => 'Home',
        //设置之后，除了Home、Admin和User模块之外的模块都不能被直接访问，并且Home模块是默认访问模块（可以不出现在URL地址）
	
        // 单模块设计，关闭多模块访问
	//'MULTI_MODULE' => false,
        //'DEFAULT_MODULE' => 'Home',
        //一旦关闭多模块访问后，就只能访问默认模块（这里设置的是Home）。单模块设计后公共模块依然有效
	
        //数据库的相关配置
        'APP_DEBUG' =>true,
        'DB_TYPE'   =>'mysql',
        'DB_HOST'   =>'mysql.sql104.cdncenter.net',
        'DB_NAME'   =>'sq_joykuang',
        'DB_USER'   =>'sq_joykuang',
        'DB_PWD'    =>'sq_joykuang',
        'DB_PREFIX' =>'studio_',
    
        //公众资源URL
        'bootstrap_js'  =>  '/Public/plugins/bootstrap-3.3.0/js/bootstrap.min.js',
        'bootstrap_css' =>  '/Public/plugins/bootstrap-3.3.0/css/bootstrap.min.css',
    
        'jquery'    => '/Public/plugins/jquery/jquery-1.11.1.min.js',
    
        'flexslider_css'    => '/Public/plugins/flexslider-2.2.2/flexslider.css',
        'flexslider_js'    => '/Public/plugins/flexslider-2.2.2/jquery.flexslider-min.js',

        'uikit_js'    => '/Public/plugins/uikit-2.11.0/js/uikit.min.js',
        'uikit_flat_css'    => '/Public/plugins/uikit-2.11.0/css/uikit.almost-flat.min.css',
        'uikit_gradient_css'    => '/Public/plugins/uikit-2.11.0/css/uikit.gradient.min.css',
        'uikit_css'    => '/Public/plugins/uikit-2.11.0/css/uikit.min.css',
    
        'fa_css'    => '/Public/css-fa-4.1.0/css/font-awesome.min.css',
    
        'js' => '/Public/js',
        'css' => '/Public/css',
        'img' => '/Public/img',
    
        'fancybox_js'  =>  '/Public/plugins/fancybox-2.1.5/js/jquery.fancybox.min.js',
        'fancybox_css' =>  '/Public/plugins/fancybox-2.1.5/css/jquery.fancybox.css',    
   
);