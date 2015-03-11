<?php
namespace Books\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        $url = $_GET['url'];
        //$url = 'http://www.23us.com/html/0/492/16180771.html';
        //TODO: The Reader APP only support 23us.com.

        if (!$url) echo 'ERROR: No URL!';
        else {

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
            $reader['title'] = iconv('gb2312', 'utf-8',split('</h1>', $reader['title'])[0]);
            $reader['novel'] = split('<dd id="contents">', $contents)[1];
            $reader['novel'] = split('</dd>', $reader['novel'])[0];
            $reader['novel'] = iconv('gb2312', 'utf-8',str_replace('<br /><br />', '<br />', $reader['novel']));
			
			echo "<h1>";
			echo $reader['title'];
			echo " - ";
			echo split('章 ', $reader['title'])[1];
			echo "</h1><hr>";
			echo $reader['novel'];

            $link = split('<h3>', $contents)[1];
            $link = split('</h3>', $link)[0];
            $link = split('</a>', $link);
            $url_pre = split('"', $link[0])[1];
            $url_next = split('"', $link[2])[1];

			$url_mod = split('/', $url);
            $url_mod_end = $url_mod[sizeof($url_mod) - 1];
			
            $url_pre = str_replace($url_mod_end, $url_pre, $url);
            $url_next = str_replace($url_mod_end, $url_next, $url);
			
			echo '
			<hr>
			<a href="/Books/Index/index?url='.$url_pre.'">前一章</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/Books/Index/index?url='.$url_next.'">后一章</a>
			';
        }
        }
		
    public function catchnovel(){
		$novel = D('Novels');
		$novel_data = $novel->limit(16)->select();
		dump($novel_data);
	}
	
    public function novel(){
		$nid = $_GET['nid'];
		if (!($nid < 0)) {
			$novel = D('Novels');
			//$novel_data = $novel->find($nid);
			$novel_data = $novel->where('id='.$nid)->find();
			if (!($novel_data == NULL)) {
				echo '<h1>';
				echo $novel_data['title'];
				echo '</h1><hr>';
				echo $novel_data['content'];
				echo '<hr>';
				
				echo '<p style="text-align:center">';
				echo '<a href="?nid='.($nid <= 1?1:($nid-1)).'">前一章</a> &nbsp;&nbsp;&nbsp;&nbsp;';				
				echo '<a href="?nid='.($nid+1).'">后一章</a> <br>';
				echo $novel->getLastSql();
			} else echo "Novel was not found!";
		} else echo "Incorrect Novel ID Format!";
	}	
	
    public function savenovel(){
		$url = $_GET['url'];
        if (!$url) echo 'ERROR: No URL!';
        else {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $contents = curl_exec($ch);
            curl_close($ch);

            $reader['title'] = split('<h1>', $contents)[1];
            $reader['title'] = iconv('gb2312', 'utf-8',split('</h1>', $reader['title'])[0]);
            $reader['novel'] = split('<dd id="contents">', $contents)[1];
            $reader['novel'] = split('</dd>', $reader['novel'])[0];
            $reader['novel'] = iconv('gb2312', 'utf-8',str_replace('<br /><br />', '<br />', $reader['novel']));
			
			
			//$reader['title'] = split('章 ', $reader['title'])[1];
			/*
			echo "<h1>";
			echo $reader['title'];
			echo " - ";
			echo split('章 ', $reader['title'])[1];
			echo "</h1><hr>";
			echo $reader['novel'];*/

            $link = split('<h3>', $contents)[1];
            $link = split('</h3>', $link)[0];
            $link = split('</a>', $link);
            $url_pre = split('"', $link[0])[1];
            $url_next = split('"', $link[2])[1];

			$url_mod = split('/', $url);
            $url_mod_end = $url_mod[sizeof($url_mod) - 1];			
			
            $url_pre = str_replace($url_mod_end, $url_pre, $url);
            $url_next = str_replace($url_mod_end, $url_next, $url);
			
			/*echo '
			<hr>
			<a href="/Books/Index/index?url='.$url_pre.'">前一章</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="/Books/Index/index?url='.$url_next.'">后一章</a>
			';*/
			
			//$novel = D('Novels');
			$novel = D('lxzs');
			$novel_data = $novel->where("title like '%s'",$reader['title'])->select();
			
			if ($novel_data == NULL) {
				if (!$reader['title'] == "") {
				
				/*$data['title'] = $reader['title'];
				$data['content'] = $reader['novel'];
				$novel->add($data);*/
				
				
				$novel = new \Think\Model;
				$novel->execute("INSERT INTO lxzs ( title , content )VALUES ( '".$reader['title']."' , '".$reader['novel']."' )");
				
				echo "章节“".$reader['title']."” 已成功添加！<br>";
				
				} else echo "章节添加失败！无法抓取内容！<br>";
				
			} else {
			echo "章节添加失败！章节已存在！<br>";
			}
        }
		
		//if ($url == 'http://www.23wx.com/html/0/74/21743088.html') {
		if ($url == 'http://www.23wx.com/html/28/28318/17528792.html') {
		
		echo "Catch Finished!";
		
		}else {
		//require '/Books/Index/index?url='.$url_next;
		
		 redirect('/Books/Index/savenovel?url='.$url_next, 1, ' 页面跳转中 ...');
		 /*
		            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1/Books/Index/savenovel?url='.$url_next);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            echo curl_exec($ch);
            curl_close($ch);*/
		}
	}
	
	public function test(){

		$prefix = '第五百一十二章';
		
		echo "章节已成功添加！";	
	
		$testdb = M('testdb');
		//$testdb_item = $testdb->create();
		$data['item'] = "网站名称";
		$data['value'] = "悦软工作室主页";
		$result = $testdb->data($data)->add();
		
		if ($result == true) echo "数据成功写入";
		
		
		
	
	}
	
	

}

