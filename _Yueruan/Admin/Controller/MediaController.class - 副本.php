<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Storage;
use Think\Storage\Driver;
class MediaController extends Controller {
  public function _empty(){
      $this->show('404 NOT FOUND!','utf-8');
  }
  public function index(){
    $conn = M('upload');
    $file = $conn->order('upload_date desc')->select();
    $this->assign('upload', $file);
    $date = $conn->distinct(true)->field('DATE_FORMAT(upload_date, "%Y年%m月") as upload_date')->order('upload_date desc')->select();
    $this->assign('upload_date', $date);
    $this->display();
  }
  public function json(){
    $date = I('get.date');
    $search = I('get.search');
    $str = split('年', $date);
    $str_m = split('月', $str[1]);
    $datestr = $str[0] . '/' . $str_m[0] . '/01 00:00:00';
    $datestred = strtotime($datestr);
    $conn = M('upload');
    if ($datestred) {
      if ($search){
      $sql = 'SELECT * FROM (SELECT *, TO_DAYS(DATE_SUB(upload_date, interval 1 microsecond)) as uplodad_str FROM `cms_upload` WHERE upload_name like "'.$search.'%") as rs WHERE (uplodad_str > TO_DAYS("'.$datestr.'") AND uplodad_str < TO_DAYS(DATE_SUB(DATE_ADD("'.$datestr.'", interval 1 month), interval 1 microsecond))) ORDER BY upload_date desc';
      }else{
      $sql = 'SELECT * FROM (SELECT *, TO_DAYS(DATE_SUB(upload_date, interval 1 microsecond)) as uplodad_str FROM `cms_upload`) as rs WHERE (uplodad_str > TO_DAYS("'.$datestr.'") AND uplodad_str < TO_DAYS(DATE_SUB(DATE_ADD("'.$datestr.'", interval 1 month), interval 1 microsecond))) ORDER BY upload_date desc';
      }
      $file = $conn->query($sql);
    }else{
      if ($search){
        $file = $conn->where('upload_name like "'.$search.'%"')->order('upload_date desc')->select();
      }else{
        $file = $conn->order('upload_date desc')->select();
      }
    }
    foreach($file as $k => $v) {
      $file[$k]['upload_author'] = getData($file[$k]['upload_author_id'],'user', 'nickname');
      $file[$k]['upload_datestr'] = date('Y年m月d日 @ H时i分s秒',strtotime($file[$k]['upload_date']));
    }
    $this->ajaxReturn($file);
  }
  public function upload(){	
    $this->display();
  }
	public function save(){
		$upload = new \Think\Upload();
		$upload->maxSize = 16*1024*1024 ;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'bmp', 'zip', 'rar', '7z', 'doc', 'ppt', 'xls', 'docx', 'pptx', 'xlsx', 'txt');
		$upload->savePath = './';
		$info = $upload->upload();
		if(!$info) {
      $this->ajaxReturn($upload->getError());
		} else {
      foreach($info as $info2 ) foreach($info2 as $k => $v ) $item[$k]=$v;
      $upload_conn = M('upload');
      $data['upload_name']=$item['name'];
      $data['upload_date']=date('Y-m-d H:i:s');
      $data['upload_md5']=$item['md5'];
      $data['upload_sha1']=$item['sha1'];
      $data['upload_ext']=$item['ext'];
      $data['upload_savename']=$item['savename'];
      $data['upload_savepath']=$item['savepath'];
      $data['upload_author_id']=1;
      $data['upload_size']=$item['size'];
      $data['upload_type']=$item['type'];
      $upload_conn->add($data);
      $this->ajaxReturn($info[0]);
		}
	}
  public function delete(){
    if (ereg("^[0-9]*[1-9][0-9]*$",I('id')) == 1){
      $post_data = M('Upload');
      $post_record = $post_data ->find(I('id'));
      if ($post_record["upload_id"] >0) {
        $file = realpath(APP_PATH."../Uploads/".$post_record["upload_savepath"].$post_record["upload_savename"]);
        if (file_exists($file)) {
        $delete =  unlink($file);
          if ($delete) {
            $post_record = $post_data ->delete(I('id'));
            $return['status']='success';
            $return['class']='success';
            $return['message']='删除成功！';
            $return['token']=md5(date('Y/M/d H:m:s').'success');
          } else {
            $return['status']='error';
            $return['class']='danger';
            $return['message']='未知错误，删除失败！';
            $return['token']=md5(date('Y/M/d H:m:s').'error');
          }
        }else{
          $return['status']='success';
          $return['class']='info';
          $return['message']='记录不存在！';
          $return['token']=md5(date('Y/M/d H:m:s').'info');
        }
      }
      $this->ajaxReturn($return);
    }
  }
}

