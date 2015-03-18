<?php
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

?>