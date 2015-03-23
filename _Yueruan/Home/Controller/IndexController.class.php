<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        
    }
    
    public function post(){
        $post_data = D('Admin/Post');
        $post_record = $post_data->postview();
        if (!$post_record) {
            echo 'URL ERROR!';
        } elseif ($post_record == null){
            echo 'No record found!';
        } else {
            dump($post_record);
            echo '<hr><b>SQL: </b><b>';
            echo $post_data->getLastSql();
            echo '</b>';
        } 
    }
 
     public function page(){
        //$post_data = D('Post');

    }
    
}

