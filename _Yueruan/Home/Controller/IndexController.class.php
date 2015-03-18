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
        $post_id = I('id');
        if ($post_id <= 0) {
            echo 'URL ERROR!';
        } else {
            $post_data = D('Admin/Post');
            $post_record = $post_data->viewpost($post_id);
            if ($post_record == null) {
                echo 'No record found!';
            } else {
                echo $post_record[0]['post_title'];
                echo '<hr>';
                echo $post_record[0]['post_content'];
            }
            
            echo '<hr><b>SQL: </b><b>';
            echo $post_data->getLastSql();
            echo '</b>';
        }
    }
 
     public function page(){
        //$post_data = D('Post');

    }
    
}

