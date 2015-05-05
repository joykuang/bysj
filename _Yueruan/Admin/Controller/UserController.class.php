<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        $post_data = D('User');
        //$post_record = $post_data->limit(10)->select(); //输出查询记录集
        //$cc['post_id'] = 1;
        //$cc['post_status'] = 0;
        $post_record = $post_data->postlist(10);
        echo $post_data->getLastSql();
        echo '<hr>';
        $post_ziduan = $post_data->getDbFields();   

        /*
        foreach ($post_record as $k => $v) {
            echo '<b>第'.$k.'条记录：</b><br>';
            foreach ($v as $kk => $vv) {
                echo '<b>'.$kk.':  </b>'.$vv.'<br>';
            }
        }*/
      
        //dump($post_ziduan);
        //dump($post_record);
        //$this->ajaxReturn($post_record);
      $this->assign('post',$post_record);
      $this->display();
    }
 
    public function viewpost(){
        if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
            $post_data = M('Post');
            $post_record = $post_data ->find(I('id'));
            if (sizeof($post_record) > 0) {
                dump($post_record);
            } else {
                echo 'No record found! ';
            }
            echo '<hr><b>SQL: </b><b>';
            echo $post_data->getLastSql();
            echo '</b>';
        } else {
            echo 'URL ERROR! ';
        }
    }
    
}

