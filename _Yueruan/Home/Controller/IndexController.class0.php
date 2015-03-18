<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	
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
      $this->show('<title>PHP Information</title>','utf-8');
       phpinfo();
    }
    /*
    public function _url($Date){
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, "$Date");
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contents = curl_exec($ch);
        curl_close($ch);
        return $contents;
    }*/

    public function reader(){
        $url = $_GET['url'];
        //$url = 'http://www.23us.com/html/0/492/16180771.html';
        //TODO: The Reader APP only support 23us.com.

        if (!$url) echo 'ERROR: No URL!';
        else {
            $url_mod = split('/', $url);
            $url_mod_end = $url_mod[sizeof($url_mod) - 1];


            //$html = file_get_contents($url);
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $contents = curl_exec($ch);
            curl_close($ch);

            $reader['title'] = split('<h1>', $contents)[1];
            $reader['title'] = split('</h1>', $reader['title'])[0];

            $reader['novel'] = split('<dd id="contents">', $contents)[1];
            $reader['novel'] = split('</dd>', $reader['novel'])[0];
            //$reader['novel'] = split('</dd>', $reader['novel'])[0];

            $reader['novel'] = str_replace('<br /><br />', '<br />', $reader['novel']);
            /*echo '<h1>';
            echo $reader['title'];
            echo '</h1>';
            echo $reader['novel'];*/
            $this->assign('reader_title', iconv('gb2312', 'utf-8', $reader['title']));
            $this->assign('reader_content', iconv('gb2312', 'utf-8', $reader['novel']));

            $link = split('<h3>', $contents)[1];
            $link = split('</h3>', $link)[0];
            $link = split('</a>', $link);
            $url_pre = split('"', $link[0])[1];
            $url_next = split('"', $link[2])[1];

            $url_pre = str_replace($url_mod_end, $url_pre, $url);
            $url_next = str_replace($url_mod_end, $url_next, $url);

            /*
            echo '<h4>';
            echo '<a href="/Home/Index/reader?url='.$url_pre.'">Previous Page</a>&nbsp;&nbsp;<a href="/Home/Index/reader?url='.$url_next.'">Next Page</a>';
            echo '</h4>';*/

            $this->assign('reader_url_pre', '/Home/Index/reader?url=' . $url_pre);
            $this->assign('reader_url_next', '/Home/Index/reader?url=' . $url_next);

            $this->display();
        }
        }


        public function book(){
            $this->display();
        }

        public function categary(){
            $this->display();
        }

        public function page(){
            $this->display();
        }

        public function attachment(){
            $this->display();
        }

        public function topic(){
            $this->display();
        }   
        
         public function activity(){
            $this->display();
        }

        public function album(){
            $this->display();
        }

        public function article(){
            $this->display();
        }

        public function post(){
            $this->display();
        }              
        public function product(){
            $this->display();
        }   
        
         public function news(){
            $this->display();
        }

    public function user(){
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

        public function group(){
            $this->display();
        }

        public function author(){
            $this->display();
        } 

}

