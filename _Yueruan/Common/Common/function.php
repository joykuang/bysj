<?php
  function getData($get_data_id = 1, $get_data_field = 'post', $get_data_item = 'title'){
    if (preg_match('/^[1-9]\d*$/', $get_data_id) != 1) return false;
    
    //博文信息
    if ($get_data_field == 'post') {
      $data_src = D('Admin/Post')->getPost($get_data_id);
      if ($get_data_item == 'title') return $data_src['post_title'];
      elseif ($get_data_item == 'class') return $data_src['post_class_id'];
      elseif ($get_data_item == 'date') return $data_src['post_date'];
      elseif ($get_data_item == 'update') return $data_src['post_update'];
      elseif ($get_data_item == 'status') return $data_src['post_status'];
      elseif ($get_data_item == 'data') return $data_src['post_data'];
      elseif ($get_data_item == 'roles') return $data_src['post_roles'];
      elseif ($get_data_item == 'author') return $data_src['post_author_id'];
      elseif ($get_data_item == 'type') return $data_src['post_type_id'];
      elseif ($get_data_item == 'slug') return $data_src['post_slug'];
      elseif ($get_data_item == 'content') return $data_src['post_content'];
      elseif ($get_data_item == 'excerpt') return $data_src['post_excerpt'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
    
    
    //分类目录信息
    } elseif ($get_data_field == 'class') {
      if ($get_data_id >0) $data_src = D('Admin/Class')->getClassInfo($get_data_id);
      
      if ($get_data_item == 'title' and $get_data_id == 0) return "顶级分类";
      if ($get_data_item == 'title') return $data_src['class_title'];
      elseif ($get_data_item == 'class') return $data_src['class_class_id'];
      elseif ($get_data_item == 'author') return $data_src['class_author_id'];
      elseif ($get_data_item == 'excerpt') return $data_src['class_excerpt'];
      elseif ($get_data_item == 'data') return $data_src['class_data'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
      
    
    } elseif ($get_data_field == 'user') {
      $data_src = D('Admin/User')->getUser($get_data_id);
      if ($get_data_item == 'account') return $data_src['user_account'];
      elseif ($get_data_item == 'nickname') return $data_src['user_nickname']?$data_src['user_nickname']:$data_src['user_account'];
      elseif ($get_data_item == 'realname') return $data_src['user_realname'];
      elseif ($get_data_item == 'email') return $data_src['user_email'];
      elseif ($get_data_item == 'group') return $data_src['user_group_id'];
      elseif ($get_data_item == 'status') return $data_src['user_status'];
      elseif ($get_data_item == 'avatar') return $data_src['user_avatar'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
      
    
    } elseif ($get_data_field == 'media') {
      $data_src = D('Admin/Upload')->getFile($get_data_id);
      if ($get_data_item == 'url') return "/Uploads/".$data_src['upload_savepath'].$data_src['upload_savename'];
      elseif ($get_data_item == 'filename') return $data_src['upload_name'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
    
    } else return false;
  
  }
	

function checkLogin() {
  return session('?login_user');
}


function loadOption(){
  $conn = D("Admin/Option");
  $option = $conn->where("option_autoload=1")->select();
  foreach ($option as $k => $v) {
  //$option[$v["option_item"]] = $v["option_value"];
  C($v["option_item"], $v["option_value"]);
  //return $option;
  }
}
?>