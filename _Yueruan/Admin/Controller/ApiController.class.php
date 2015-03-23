<?php
namespace Admin\Controller;
use Think\Controller;
class ApiController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
        echo 'Welcome to use DaoCMS API';
    }
 
    public function jwc(){
        header("Content-type: application/json; charset=utf-8");
        $url = 'http://jwc.wyu.cn/www/newslist.asp?id=52';  //这儿填页面地址
        $content = file_get_contents($url);
        $content = iconv("gb2312", "utf-8//IGNORE", $content);
        /* $expression = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";  图片匹配 */
        $expression = "/<td width=\"406\">[\s\S]*?<\/tr>/"; 
        preg_match_all($expression,$content,$match); 
        foreach ($match[0] as $key => $value) {
            preg_match('/<a href=\"(.*?)\"/',$value,$matched);
            $return[$key]['url'] = $matched[1];
            preg_match('/target=\"_blank\">(.*?)<\/a>/',$value,$matched);
            $return[$key]['title'] = $matched[1];
            preg_match('/<td width=\"74\">(.*?)<\/td>/',$value,$matched);
            $return[$key]['author'] = $matched[1];
            preg_match('/<span class=\"red\">(.*?)<\/span>/',$value,$matched);
            $return[$key]['date'] = $matched[1];
            unset($matched);
        }
        //清除内存
        $url = null;
        $content = null;
        $expression = null;
        unset($match);
        
        $this->ajaxReturn($return,'json');
    }
    
    public function uikit(){
        header("Content-type: application/json; charset=utf-8");
        include '/Public/plugins/plugins.php';
        $this->ajaxReturn($uikit,'json');
    }
    
}

