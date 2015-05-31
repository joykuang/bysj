<?php
namespace Admin\Controller;
use Think\Controller;
class PageController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
      
      $post_data = D('Post');
      $post_record = $post_data->getPostList(10);
      $this->assign('post',$post_record);
      $this->display();
      
      /*
      dump($post_record);
      trace($post_data->_sql(),'SQL语句','user');
      trace(THEME_PATH,'主题路径','user');
      trace(THTME_NAME,'主题名称','user');
      */
      
        
        //$post_record = $post_data->limit(10)->select(); //输出查询记录集
        //$cc['post_id'] = 1;
        //$cc['post_status'] = 0;
        
        //echo $post_data->getLastSql();
        //echo '<hr>';
        //$post_ziduan = $post_data->getDbFields();   

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
      
    }
 
    public function viewpost(){
        if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
            $post_data = M('Post');
            $post_record = $post_data ->find(I('id'));
            if (sizeof($post_record) > 0) {
                //dump($post_record);
              $this->ajaxReturn($post_record);
            } else {
                echo 'No record found! ';
            }
            echo '<hr><b>SQL: </b><b>';
            echo $post_data->_sql();
            echo '</b>';
        } else {
            echo 'URL ERROR! ';
        }
    }
 
    public function create(){
        //撰写文章
      $connClass = M("Class");
      $connMedia = M("Upload");
      $class = $connClass->where("class_level=1 and class_class_id=0")->select();
      $media = $connMedia->order("upload_date desc")->select();
      $classes = "";
      foreach($class as $k => $v){
        $classes .= '<option value="'.$v["class_id"].'">├ '.$v["class_title"].'</option>';
        $second = $connClass->where("class_class_id=".$v["class_id"])->select();
        foreach($second as $kk => $vv){
          $classes .= '<option value="'.$vv["class_id"].'">│└ '.$vv["class_title"].'</option>';
        }
      }
      $this->assign("class", $classes);
      $this->assign("media", $media);
      $this->assign("action", "new");
      
      $this->display("edit");
    }
    
    public function edit(){
        //编辑文章
      $conn = M("Post");
      $connClass = M("Class");
      $connMedia = M("Upload");
        if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
          $post = $conn->find(I("id"));
          $class = $connClass->where("class_level=1 and class_class_id=0")->select();
          $media = $connMedia->order("upload_date desc")->select();
          $classes = "";
          foreach($class as $k => $v){
            $classes .= '<option value="'.$v["class_id"].'">├ '.$v["class_title"].'</option>';
            $second = $connClass->where("class_class_id=".$v["class_id"])->select();
            foreach($second as $kk => $vv){
              $classes .= '<option value="'.$vv["class_id"].'">│└ '.$vv["class_title"].'</option>';
            }
          }
          
          if (sizeof($post) > 0) {
            $this->assign("post", $post);
            $this->assign("class", $classes);
            $this->assign("media", $media);
            $this->assign("action", "edit");
            $this->display();
          } else {
            $this->error("未找到记录！");
          }
        } else {
            $this->error("URL错误！");
        }
    }
    
    public function delete(){
        //删除文章
        if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
            $post_data = M('Post');
            $post_record = $post_data ->delete(I('id'));
          if ($post_record == 1) {
            $return['status']='success';
            $return['class']='success';
            $return['message']='删除成功！';
            $return['token']=md5(date('Y/M/d H:m:s').'success');
          } else {
            $return['status']='success';
            $return['class']='info';
            $return['message']='记录不存在！';
            $return['token']=md5(date('Y/M/d H:m:s').'info');
          }
        } else {
          $return['status']='error';
          $return['class']='danger';
          $return['message']='访问URL错误！';
          $return['token']=md5(date('Y/M/d H:m:s').'error');
        }
      $this->ajaxReturn($return);
    }
    
    public function verify(){
        //审核文章
    }
    
    public function save(){
        //保存文章
      $conn = M("Post");
      if (IS_POST){
        if (I("get.id")) {
          $where["post_id"] = I("get.id");
          $data["post_content"] = I("post.data_content");
          //$data["post_author_id"] = 1;
          $data["post_update"] = date("Y-m-d H:i:s");
          $data["post_class_id"] = I("post.post_class_id");
          $data["post_status"] = I("post.post_status");
          $data["post_title"] = I("post.post_title");
          $data["post_face"] = I("post.post_face");
          
          
          $post = $conn->where($where)->save($data);
          $this->success("保存成功！");
          //保存操作
        } else {
        //新增操作

          $data["post_content"] = I("post.data_content");
          $data["post_author_id"] = 1;
          $data["post_date"] = date("Y-m-d H:i:s");
          $data["post_update"] = date("Y-m-d H:i:s");
          $data["post_class_id"] = I("post.post_class_id");
          $data["post_status"] = I("post.post_status");
          $data["post_title"] = I("post.post_title");
          $data["post_face"] = I("post.post_face");
          
          $post = $conn->add($data);
          $this->success("新增博文成功！");
        }
      } else {
        //错误操作
      }
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

