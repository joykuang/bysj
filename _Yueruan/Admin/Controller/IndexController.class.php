<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        echo "服务器系统：" .get_os(). "<br>";
        echo "服务器软件：" .$_SERVER["SERVER_SOFTWARE"]. "<br>";
        echo "解析器版本：PHP " .phpversion(). "<br>";        
        echo "当前浏览器：" .$_SERVER["HTTP_USER_AGENT"]. "<br>";
        echo "图像库版本：GD " .gd_info()["GD Version"]."<br>";
        echo "数据库版本：" ."SQLite ".phpversion("sqlite3")."<br>";
        echo "加速器版本：Zend Engine " .zend_version()."<br>";
        echo "内存使用率：" .convert(memory_get_usage(true)). " / 8388608 KB";

    }
        
    public function info(){
        phpinfo();
    }

    public function article(){
        //创建数据库连接实例
        $article = M('articles');
        $article_data = $article->limit(8)->select();
        
        $i = 1;

        echo '<table>';

        foreach ($article_data as $items) {

            if ($i == 1) {

                echo "<tr><td><b>#count</b></td>";

            foreach ($items as $key => $value) {
                echo "<td>". $key. "</td>";
                //echo $value ." ";
            } echo "</tr>"; }

            echo "<tr><td><b>#" .$i. "</b></td>";

            foreach ($items as $value) {
                echo "<td>".$value ."</td>";
            }

            echo "</tr>";

            $i++;

        }

        echo '</table>';

        $this->show(' ','utf-8');
    }    

    public function update(){
        
        $this->show('Application is updating!','utf-8');

    }
	
    public function account(){
        
        $this->show('您好，您的资产现金剩余：','utf-8');
		echo '1,000,000,000,000,000 元 <br>';
		
		echo ' <img src="/Admin/Index/verify"> ';
		
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

}

