<?php
namespace Admin\Controller;
use Think\Controller;
class ClassController extends Controller {
    public function _empty(){
        $this->show('404 NOT FOUND!','utf-8');
    }

    public function index(){
      $conn = M('Class');
      $class = $conn ->order("class_sort desc")->select();
      $this->assign("class", $class);
      
      $this->display();
    }
  
    public function delete(){
        //删除文章
        if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
            $conn = M('Class');
            $class = $conn ->delete(I('id'));
          if ($class == 1) {
          $this->success("分类目录删除成功");
          } else {
          $this->error("分类目录不存在");
          }
        } else {
          $this->error("访问URL错误");
        }
    }
  
    public function save(){
      
      //
    }
}

