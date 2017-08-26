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
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
// 应用公共文件

/*
 * $z  时区
 * $t  时间
 * */
function gettime($z,$t){
    date_default_timezone_set('America/New_York');
    $i=date('I');
    if($i == 1){//夏令时
        if($z == 1 ){//东部时间  +12   =北京时间
            $bj = $t + 12*3600;
        }else  if($z == 2 ){//中部时间  +13   =北京时间
            $bj = $t + 13*3600;
        }else  if($z == 3 ){//山地时间  +14   =北京时间
            $bj = $t + 14*3600;
        }else  if($z == 4 ){//西部时间  +15   =北京时间
            $bj = $t + 15*3600;
        }else{//北京时间
            $bj = $t;
        }
    }else{//非夏令时
        if($z == 1 ){//东部时间  +13   =北京时间
            $bj = $t + 13*3600;
        }else  if($z == 2 ){//中部时间  +14   =北京时间
            $bj = $t + 14*3600;
        }else  if($z == 3 ){//山地时间  +15   =北京时间
            $bj = $t + 15*3600;
        }else  if($z == 4 ){//西部时间  +16   =北京时间
            $bj = $t + 16*3600;
        }else{//北京时间
            $bj = $t;
        }
    }
    //echo $bj;
    $sjc = $bj - time();
    //echo $t.'<br />';
    //echo $sjc.'<br />';
    $m = $sjc/3600;
    //echo '时间差'.$m.'<br />';
    if($m >= 36){
        return 0;
    }else if($m>=24 && $m<36){
        return 0.15;
    }else if($m>=12 && $m<24){
        return 0.35;
    }else if($m>=6 && $m<12){
        return 0.45;
    }else{
        return 0.65;
    }
}

function msg($v){
    if($v == 36){
        return '大于36小时';
    }else if($v == 24){
        return '36-24小时';
    }else if($v == 12){
        return '24-12小时';
    }else if($v == 6){
        return '6-12小时';
    }else if($v == 0){
        return '小于6小时';
    }
}


function name($id){
    $pro = new \app\index\model\Clas();
    $m = $pro->getname($id);
    if($id != 0){
        return $m['name'].'专业';
    }

}