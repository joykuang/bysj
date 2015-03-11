<?php
$input = '50303320';

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

	echo fsize($input, 2);

?>