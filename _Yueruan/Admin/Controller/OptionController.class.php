<?php
namespace Admin\Controller;
use Think\Controller;
class OptionController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
      $conn = M("Option");
      $option = $conn->select();
      $this->assign("option", $option);
      $this->display();
    }
    
    public function save(){
      $conn = M("Option");
      
      if (I("options")) {
        foreach (I("options") as $k => $v) {
          $data["option_value"] = $v;
          $where["option_item"]=$k;
          $option = $conn->where($where)->save($data);
        }
      }
      redirect(U("/_Dao/Option/index"), 0, '操作完成，页面跳转中...');
    }
}

