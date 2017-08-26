<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function cou($c){
    $c = explode(" ",$c);
    $res = '';
    foreach ($c as $v){
        if($v == 1){
            $res .= ' 语文';
        }else if($v == 2){
            $res .= ' 数学';
        }else if($v == 3){
            $res .= ' 英语';
        }
    }
    return $res;
}

function cour($v){
    if($v == 1){
        return ' 语文';
    }else if($v == 2){
        return ' 数学';
    }else if($v == 3){
        return ' 英语';
    }
}

function two($t){
    return number_format($t,2);
}

function name($t){
    $pro = new \app\index\model\Student();
    $m = $pro->getonly($t);
    return $m;
}

function num($n){
    $s = strlen($n);
    if($s > 60){
        return mb_substr($n,0,30,"utf-8").' ......';
    }else{
        return $n;
    }
}