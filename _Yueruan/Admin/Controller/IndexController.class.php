<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
      
      $theme = "Blue";
      if (is_readable(realpath(APP_PATH."Admin/View/".$theme."/"))) $this->theme('Blue')->display();
      else $this->display();
      
    }
        
    public function info(){
        //phpinfo();
      $this->display();
    }
  
    public function pinfo(){
        phpinfo();
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

