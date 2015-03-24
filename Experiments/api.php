<?php
    header("Content-type: text/html; charset=utf-8");
    $url = 'http://jwc.wyu.cn/www/newslist.asp?id=51';  //Õâ¶ùÌîÒ³ÃæµØÖ·
    $content = file_get_contents($url);
    $content = iconv("gb2312", "utf-8//IGNORE", $content);
    /* $expression = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";  Í¼Æ¬Æ¥Åä */
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
    //Çå³ýÄÚ´æ
    $url = null;
    $content = null;
    $expression = null;
    unset($match);
    var_dump($return);
    
    //var_dump($match);
    //foreach ($m as $show) { echo $show .'<br>';}
    //echo $info;
?>