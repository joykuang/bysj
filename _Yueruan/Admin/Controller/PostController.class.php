<?php
namespace Admin\Controller;
use Think\Controller;
class PostController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        $post_data = M('post');
        $post_record = $post_data->limit(10)->select();
        dump($post_record);
    }
 
    public function newpost(){
        //撰写文章
    }
    
    public function editpost(){
        //编辑文章
    }
    
    public function delete(){
        //删除文章
    }
    
    public function verify(){
        //审核文章
    }
    
    public function save(){
        //保存文章
    }
    
    public function recycle(){
        //文章回收站
    }
    
    public function comment(){
        //所有评论
    }
    
    public function cverify(){
        //审核评论
    }
    
    public function creply(){
        //回复评论
    }
    
    public function crecycle(){
        //评论回收站
    }

    public function cdelete(){
        //删除评论
    }
    
}

