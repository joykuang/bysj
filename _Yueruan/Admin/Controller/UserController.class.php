<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    
    public function index(){
        //创建数据库连接实例
        $user = M('user_account');
        $user_data = $user->limit(15)->select();
        
        //注册公共资源URL
        $this->assign('js_url',C('js'));
        $this->assign('fa_css',C('fa_css'));
        
        //注册模板数据
        //$this->assign('user_data',$user_data);
        $this->assign('user_data2',$user_data);
        $this->assign('skey',md5(time()).md5(date()));
        $this->assign('user_data_item',$user_data[0]);        
        $this->display();

    }
  
    public function useradd(){
   
        $this->show('User add!');

    } 
  
    public function usernew(){
   
        $this->show('User new!');

    }
  
      public function useredit(){
   
        $this->show('User edit!');

    }    
  
      public function usersave(){
   
        $this->show('User save!');

    }    
  
      public function userinfo(){
   
        //注册公共资源URL
        $this->assign('js_url',C('js'));
        $this->assign('fa_css',C('fa_css'));
            
        $this->display();

    }    
  
      public function userapi(){
   
        $uid = $_GET['uid'];
        $safekey = $_GET['skey'];
        
        if (!$safekey) { echo 'ERROR: No Safe Key Set'; }  
        else { 
          
          if (!$uid) { echo 'ERROR: No User ID!'; }
          else {
            
            if (!is_numeric($uid))  { echo 'ERROR: Incorrect User ID Format!'; }
            else {
            $user = D('Users');
            $user_items = $user->find($uid);
         
            if (count($user_items) == 0) { echo 'Result: No User Found!'; }
            
            else {
              $this->show('{ 
                "uid": "'.$user_items['id'].'",'.
                '"account":"' .$user_items['account'].'",'.
                '"passwd":"'.$user_items['passwd'].'",'.
                '"register_time":"' .$user_items['register_time'].'",'.
                '"last_login_time":"'.$user_items['last_login_time'].'",'.
                '"last_login_ip":"' .$user_items['last_login_ip'].'",'.
                '"astatus":"' .$user_items['astatus'].'",'.
                '"verify":"'.$user_items['verify'].'",'.
                '"groups":"'.$user_items['groups'].'",'.
                '"realname":"'.$user_items['realname'].'",'.
                '"sex":"'.$user_items['sex'].'",'.
                '"birth":"'.$user_items['birth'].'",'.
                '"area":"'.$user_items['area'].'",'.
                '"icon":"'.$user_items['icon'].'",'.
                '"email":"'.$user_items['email'].'",'.
                '"qq":"'.$user_items['qq'].'",'.
                '"weibo":"'.$user_items['weibo'].'",'.
                '"tel":"'.$user_items['tel'].'"'.
                ' }','utf-8');
             // dump($user_items);
              /*
              echo $user_items['id'];
              echo $user_items['account'];
              echo $user_items['passwd'];
              echo $user_items['register_time'];
              echo $user_items['last_login_time'];
              echo $user_items['last_login_ip'];
              echo $user_items['astatus'];
              echo $user_items['verify'];
              echo $user_items['groups'];
              echo $user_items['realname'];
              echo $user_items['sex'];
              echo $user_items['birth'];
              echo $user_items['area'];
              echo $user_items['icon'];
              echo $user_items['email'];
              echo $user_items['qq'];
              echo $user_items['weibo'];
              echo $user_items['tel'];
              
              echo '<br>';
              echo '<br>';
              echo '<br>';
              
              */
              /*
              print_r ('{ 
                "uid": "'.$user_items['id'].'",'.
                '"account":"' .$user_items['account'].'",'.
                '"passwd":"'.$user_items['passwd'].'",'.
                '"register_time":"' .$user_items['register_time'].'",'.
                '"last_login_time":"'.$user_items['last_login_time'].'",'.
                '"last_login_ip":"' .$user_items['last_login_ip'].'",'.
                '"astatus":"' .$user_items['astatus'].'",'.
                '"verify":"'.$user_items['verify'].'",'.
                '"groups":"'.$user_items['groups'].'",'.
                '"realname":"'.$user_items['realname'].'",'.
                '"sex":"'.$user_items['sex'].'",'.
                '"birth":"'.$user_items['birth'].'",'.
                '"area":"'.$user_items['area'].'",'.
                '"icon":"'.$user_items['icon'].'",'.
                '"email":"'.$user_items['email'].'",'.
                '"qq":"'.$user_items['qq'].'",'.
                '"weibo":"'.$user_items['weibo'].'",'.
                '"tel":"'.$user_items['tel'].'"'.
                ' }');*/
              
            }
              
            }
            
          } 
        
        }

    }    
    
}

