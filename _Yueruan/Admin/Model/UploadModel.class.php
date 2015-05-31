<?php
/** 
* 用户信息模型
* @intro        用户快速查找指定用户相关详细信息 
* @author       Joy Kuang <q-cute@163.com> 
* @version      1.0 
* @date         2015-4-18 21:18:58 
*/  

namespace Admin\Model;
use Think\Model;
class UploadModel extends Model{
  /**
  * 查看文件信息
  * @pama 
  * @author Joy Kuang <q-cute@163.com>
  */
  public function getFile($data_id){
    if(!$data_id) $data_id = I('id');
    if (!preg_match('/^[1-9]\d*$/', $data_id)) return false;
    else return $this->find($data_id);
  }
    
}

?>