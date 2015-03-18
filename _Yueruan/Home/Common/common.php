<?php/*
	 function getgroupname($gid) {
		$Group = M('user_group');	
		$Group_list = $Group->find($gid);
		
		if ($gid == 0) { return '顶级用户组';
		}else{
		return $Group_list['group_name']?$Group_list['group_name']:"非法用户组";
		}
	}
	
	 function getclassname($cid) {
		$Class = M('article_class');	
		$Class_list = $Class->find($cid);
		
		if ($cid == 0) { return '顶级分类';
		}else{
		return $Class_list['title']?$Class_list['title']:"非法分类";
		}
	}

	 function getauthor($uid) {
		$Author = M('user_account');	
		$Authors = $Author->find($cid);
		
		$Detail = M('user_detail');	
		$Details = $Detail->find($Authors['detail']);		
		
		if ($uid == 0) { return '无此用户';
		}else{
		return $Details['realname']?$Details['realname']:"无此用户";
		}
	}	
	
	 function gstatus($gstatus) {
		
		if ($gstatus == 0) { return '正常';
		}elseif ($gstatus  == 1) { return '冻结';
		}elseif ($gstatus  == 2) { return '禁用';
		}else{
		return '非法';
		}
	}	
	
	 function sex($sex) {
		
		if ($sex == 0) { return '女';
		}elseif ($sex  == 1) { return '男';
		}else{
		return '非法';
		}
	}		*/
function reader($url)
{
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

    return $reader;
}


?>