<?php

namespace Admin\Model;
use Think\Model;
class PageModel extends Model{
    
/**
 * 文章列表
 * @author Joy Kuang <q-cute@163.com>
 */
    public function getPageList($recordset_count = 10, $condition = array()){
        if ($recordset_count <= 0) return false;
        if (sizeof($condition) > 0) $post_record = $this->where($condition)->limit($recordset_count)->select();
        else $post_record = $this->limit($recordset_count)->select();
        return $post_record;
    }
    
/**
 * 查看文章
 * @author Joy Kuang <q-cute@163.com>
 */
    public function getPage($data_id){
        if(!$data_id) $data_id = I('id');
        if (!preg_match('/^[1-9]\d*$/', $data_id)) return false;
        else return $this->find($data_id);
    }
    
}