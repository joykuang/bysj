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
class UserModel extends Model{
  /**
  * 查看用户信息
  * @pama 
  * @author Joy Kuang <q-cute@163.com>
  */
  public function getUser($data_id){
    if(!$data_id) $data_id = I('id');
    if (!preg_match('/^[1-9]\d*$/', $data_id)) return false;
    else return $this->find($data_id);
  }
    
}


























/*
namespace Home\Model;
use Think\Model\ViewModel;
class UsersModel extends ViewModel {
	
//Notes（笔记）：文件名【模型名.class.php	】，此外，表的字段不能有SQL语句的关键字【name password status group】
	
	public $viewFields = array(
		'user_account'=>array ( 'id','account','passwd','register_time','last_login_time','last_login_ip','astatus','verify' ),
		'user_group'=>array('group_name'=>'groups','_on'=>'user_account.belong=user_group.id'),
		'user_detail'=>array('realname','sex','birth','area','icon','email','qq','weibo','tel','_on'=>'user_account.detail=user_detail.id'),
	);
}
*/
?>