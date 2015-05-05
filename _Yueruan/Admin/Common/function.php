<?php
  function getData($get_data_id = 1, $get_data_field = 'post', $get_data_item = 'title'){
    if (preg_match('/^[1-9]\d*$/', $get_data_id) != 1) return false;
    
    //博文信息
    if ($get_data_field == 'post') {
      $data_src = D('post')->getPost($get_data_id);
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
      $data_src = D('class')->getClassInfo($get_data_id);
      if ($get_data_item == 'title') return $data_src['class_title'];
      elseif ($get_data_item == 'class') return $data_src['class_class_id'];
      elseif ($get_data_item == 'author') return $data_src['class_author_id'];
      elseif ($get_data_item == 'excerpt') return $data_src['class_excerpt'];
      elseif ($get_data_item == 'data') return $data_src['class_data'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
      
    
    } elseif ($get_data_field == 'user') {
      $data_src = D('user')->getUser($get_data_id);
      if ($get_data_item == 'account') return $data_src['user_account'];
      elseif ($get_data_item == 'nickname') return $data_src['user_nickname'];
      elseif ($get_data_item == 'realname') return $data_src['user_realname'];
      elseif ($get_data_item == 'email') return $data_src['user_email'];
      elseif ($get_data_item == 'group') return $data_src['user_group_id'];
      elseif ($get_data_item == 'status') return $data_src['user_status'];
      elseif ($get_data_item == 'avatar') return $data_src['user_avatar'];
      elseif ($get_data_item == 'all') return $data_src;
      else return false;
      
    
    } elseif ($get_data_field == 'media') {
    
    } else return false;
  
  }
	
?>