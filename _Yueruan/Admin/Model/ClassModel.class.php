<?php

namespace Admin\Model;
use Think\Model;
class ClassModel extends Model{
    
/**
 * 分类列表
 * @author Joy Kuang <q-cute@163.com>
 */
    public function getClassList($recordset_count = 10, $condition = array()){
        if ($recordset_count <= 0) return false;
        if (sizeof($condition) > 0) $post_record = $this->where($condition)->limit($recordset_count)->select();
        else $post_record = $this->limit($recordset_count)->select();
        return $post_record;
    }
    
/**
 * 分类目录详情
 * @author Joy Kuang <q-cute@163.com>
 */
    public function getClassInfo($data_id){
        if(!$data_id) $data_id = I('id');
        if (!preg_match('/^[1-9]\d*$/', $data_id)) return false;
        else return $this->find($data_id);
    }
  
/**
 * 获取分类目录子类
 * @author Joy Kuang <q-cute@163.com>
 */
    public function getClass($data_id){
        if (!$data_id) return $this->where('class_class_id=0')->select();
        if (!preg_match('/^[1-9]\d*$/', $data_id)) return false;
        else return $this->where('class_class_id='.$data_id)->select();
    }
    
}