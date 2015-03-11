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

?>