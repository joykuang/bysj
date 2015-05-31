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
        /* 'APP_DEBUG'     =>        true,
        'DB_TYPE'           =>        'mysql',
        'DB_HOST'          =>        'localhost',
        'DB_NAME'         =>        'daocms',
        'DB_USER'          =>        'root',
        'DB_PWD'           =>        'joy',
        'DB_PREFIX'       =>        'cms_',
        */
    'DEFAULT_THEME' => 'Default',
    'TMPL_PARSE_STRING'   =>    array(
      '__VIEW__' => '/_Yueruan/Home/View',
      '__DEFAULT__' => '/_Yueruan/Home/View/Default'
    ),
);