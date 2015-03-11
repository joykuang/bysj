<?php
namespace Home\Controller;
use Think\Controller;
class GroupController extends Controller {
    
    public function index(){
        //创建数据库连接实例
        $user = M('user_account');
        $user_data = $user->limit(8)->select();
        
        //注册公共资源URL
        $this->assign('js_url',C('js'));
        $this->assign('fa_css',C('fa_css'));
        
        //注册模板数据
        //$this->assign('user_data',$user_data);
        $this->assign('user_data2',$user_data);
        $this->assign('user_data_item',$user_data[0]);        
        $this->display();

    }
    
}

