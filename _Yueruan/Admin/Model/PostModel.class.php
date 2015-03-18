<?php

namespace Admin\Model;
use Think\Model;
class PostModel extends Model{
    
/**
 * 文章列表
 * @author Joy Kuang <q-cute@163.com>
 */
    public function postlist($recordset_count = 10, $condition = array()){
        if ($recordset_count <= 0) return false;
        if (sizeof($condition) > 0) $post_record = $this->where($condition)->limit($recordset_count)->select();
        else $post_record = $this->limit($recordset_count)->select();
        return $post_record;
    }
    
/**
 * 查看文章
 * @author Joy Kuang <q-cute@163.com>
 */
    public function viewpost($post_id){
        if (!is_int($post_id)) return false;
        if ($post_id <= 0) return false;
        $condition['post_id'] = $post_id;
        $post_record = $this->where($condition)->select();
        if (sizeof($post_record) > 0) return $post_record;
        else return null;
    }
    
}