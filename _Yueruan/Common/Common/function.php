<?php
    function convert($size) {
        $unit = array('B','KB','MB','GB','TB','PB');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    function get_os() {
        $os = php_uname(); $split = "[()]";
        $os = split($split, $os);

        return $os[1]." ".($bit[2]="i586"?"64位":"32位");
    }

/*
 * @输入：$filesize 转换单位的数值，不带单位 
 * @输入：$bit 四舍五入的位数，默认为零 
 * @返回：带单位的文件大小值。
*/
function fsize($filesize, $bit = 0) {
	if ($filesize < 0) return false;
	if ($filesize >=0) $result = $filesize.'B';
	if ($filesize >=1024) $result = round(($filesize/1024),$bit).'KB';
	if ($filesize >= 1024*1024) $result = round(($filesize/(1024*1024)),$bit).'MB';
	if ($filesize >= 1024*1024*1024) $result = round(($filesize/(1024*1024*1024)),$bit).'GB';
	if ($filesize >= 1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024)),$bit).'TB';
	if ($filesize >= 1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024)),$bit).'PB';
	if ($filesize >= 1024*1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024*1024)),$bit).'EB';
	if ($filesize >= 1024*1024*1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024*1024*1024)),$bit).'ZB';
	if ($filesize >= 1024*1024*1024*1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024*1024*1024*1024)),$bit).'YB';
	if ($filesize >= 1024*1024*1024*1024*1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024*1024*1024*1024)),$bit).'DB';
	if ($filesize >= 1024*1024*1024*1024*1024*1024*1024*1024*1024*1024) $result = round(($filesize/(1024*1024*1024*1024*1024*1024*1024*1024*1024)),$bit).'NB';
	return $result;
}    
    
/*
	* 处理json_encode() 不支持中文的情况
	*
	* 实际应用中，当有中文字符时，当直接使用json_encode() 函数会使汉字不能正常显示
	* 所以有了这个适用性比较广的函数 ch_json_encode()[2] 来解决这个问题
	*
	* charset: UTF-8
	* create date: 2012-7-8
	* @author Zhao Binyan
	* @copyright (C) 2011-2012 itbdw
	*//**
	* 处理 json_encode() 不支持中文的情况
	*
	* @param array|object $data
	* @return array|object
	*/
	
	function ch_json_encode($data) {
	
	/**
	* 将中文编码
	* @param array $data
	* @returnstring
	*/
	
		function ch_urlencode($data) {
			if (is_array($data) || is_object($data)) {
				foreach ($data as $k => $v) {
					if (is_scalar($v)) {
						if (is_array($data)) {
							$data[$k] = urlencode($v);
						} elseif (is_object($data)) {
							$data->$k = urlencode($v);
						}
					} elseif (is_array($data)) {
						$data[$k] = ch_urlencode($v);//递归调用该函数
					} elseif (is_object($data)) {
						$data->$k = ch_urlencode($v);
					}
				}
			}
			return $data;
		}
		
		$ret = ch_urlencode($data);
		$ret =json_encode($ret);
		return urldecode($ret);
	}

/**
 * 居中剪裁图片
 * @param $img_url 图片绝对地址
 * @param $cut_width 裁剪宽度
 * @param $cut_height 采集高度
 * @param string $save_img_url 保存的图片绝对地址，如果为'',则覆盖掉原图片
 * @param bool $is_delete 当save_img_url不为空时，是否删掉原始img
 */
function imageCenterCut($img_url, $cut_width, $cut_height, $save_img_url='', $is_delete=false){
    $cut_width = intval($cut_width);
    $cut_height = intval($cut_height);
    $image = new \Think\Image();
    $image->open($img_url);
    $image_width = $image->width();
    $image_height = $image->height();
    //居中裁剪图片
    if($image_width / $image_height > $cut_width / $cut_height){
        $image->crop(round($image_height / $cut_height * $cut_width), $image_height, round(($image_width - $image_height / $cut_height * $cut_width) / 2), 0);
    }else if($image_width / $image_height < $cut_width / $cut_height){
        $image->crop($image_width, round($image_width / $cut_width * $cut_height), 0, round(($image_height - $image_width / $cut_width * $cut_height) / 2));
    }else{
        //长宽比相同
        if($image_width == $cut_width){
            //如果长宽相等，则直接copy一份
            if(!empty($save_img_url)){
                copy($img_url, $save_img_url);
                //删掉原图
                if($is_delete){
                    unlink($img_url);
                }
            }
        }else{
            if(empty($save_img_url)){
                $image->thumb($cut_width, $cut_height)->save($img_url);
            }else{
                $image->thumb($cut_width, $cut_height)->save($save_img_url);
                //删掉原图
                if($is_delete){
                    unlink($img_url);
                }
            }
        }
        return;
    }
    if(empty($save_img_url)){
        $image->thumb($cut_width, $cut_height)->save($img_url);
    }else{
        $image->thumb($cut_width, $cut_height)->save($save_img_url);
        //删掉原图
        if($is_delete){
            unlink($img_url);
        }
    }
}
?>