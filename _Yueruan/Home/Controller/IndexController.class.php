<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
  public function _empty(){
      $this->show('404 NOT FOUND!','utf-8');
  }

  public function index(){
    $option = loadOption();
    $conn = D("Admin/Post");
    $post = $conn->where("post_status=0")->order("post_date desc")->select();
    
    
    
    //调试
    //dump($post);
    
    //模板变量映射
    $this->assign("post", $post);
    $this->assign("recent", $post);
    $this->assign("option", $option);
    
    $theme = "Striped";
    if (is_readable(realpath(APP_PATH."Home/View/".$theme."/"))) $this->theme($theme)->display();
    else $this->display();
    
  }
  
    public function post(){
    $option = loadOption();
    if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
      $conn = M('Post');
      $post = $conn->where("post_status=0 AND post_id=".I('id')) ->select();
      $posts = $conn->where("post_status=0")->order("post_date desc")->select();
      if (sizeof($posts) > 0) {
        //dump($post_record);
        //$this->ajaxReturn($post_record);
        
        //调试
        //dump($post);
        
        //模板变量映射
        $this->assign("post", $post[0]);
        $this->assign("posts", $posts);
        $this->assign("recent", $posts);
        $this->assign("option", $option);
        
        $theme = "Striped";
        if (is_readable(realpath(APP_PATH."Home/View/".$theme."/"))) $this->theme($theme)->display();
        else $this->display();
      } else {
        echo 'No record found! ';
      }
      /*echo '<hr><b>SQL: </b><b>';
      echo $post_data->_sql();
      echo '</b>';*/
    } else {
      echo 'URL ERROR! ';
    }
  }
	
	public function verify(){
		ob_end_clean();
		$config = array(
			'fontSize' => 24, //  验证码字体大小
			'length' => 5, //  验证码位数
			'useNoise' => false, //  关闭验证码杂点
		);
		
		$Verify = new \Think\Verify($config);
		$Verify->entry();
		
	}
  
  public function json(){
    echo checkLogin();
    loadOption();
    $this->ajaxReturn($option);
  }

}

