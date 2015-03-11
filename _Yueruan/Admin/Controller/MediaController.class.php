<?php
namespace Admin\Controller;
use Think\Controller;
class MediaController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){/*
        echo "服务器系统：" .get_os(). "<br>";
        echo "服务器软件：" .$_SERVER["SERVER_SOFTWARE"]. "<br>";
        echo "解析器版本：PHP " .phpversion(). "<br>";        
        echo "当前浏览器：" .$_SERVER["HTTP_USER_AGENT"]. "<br>";
        echo "图像库版本：GD " .gd_info()["GD Version"]."<br>";
        echo "数据库版本：" ."SQLite ".phpversion("sqlite3")."<br>";
        echo "加速器版本：Zend Engine " .zend_version()."<br>";
        echo "内存使用率：" .convert(memory_get_usage(true)). " / 8388608 KB";*/
		
		echo "Media Page!";

    }
	
	public function upload(){
		$upload = new \Think\Upload();//  实例化上传类
		$upload->maxSize = 3145728 ;//  设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'zip', 'rar', '7z', 'doc', 'ppt', 'xls', 'docx', 'pptx', 'xlsx', 'txt');//  设置附件上传类型
		$upload->savePath = './'; //  设置附件上传目录
		//  上传文件
		$info = $upload->upload();
		if(!$info) {//  上传错误提示错误信息
			$this->error($upload->getError());
		} else {//  上传成功
			//$this->success(' 上传成功！ ');
			//echo '{ status: "true", filename: "xxxxxxx", size: "23456KB" }';
			header("Content-type:text/json");
			foreach($info as $file ){
				echo ch_json_encode($file);
			}
		}
	}
	
	public function select(){
	echo '
        <script src="/uikit/vendor/jquery.js"></script>
		<form action="/Admin/Media/upload" enctype="multipart/form-data" method="post" >
		<input type="text" name="name" />
		<input type="file" name="photo" />
		<input type="submit" value=" 提交 " >
		</form>	
	
	';
	
	
	}	
	
	public function post(){
	
	dump($_POST);
	
	}		
	

}

