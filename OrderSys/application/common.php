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
function cou($v){
    if($v == 1){
        return '<span style="color:red">课程新接入</span>';
    }else if($v ==2) {
        return '拆课表未完成';
    }else{
        return '拆课表已完成';
    }
}

function task($l){
    switch ($l){
        case 1:
            return '未分配';
            break;
        case 2:
            return '已分配';
            break;
        case 4:
            return '已完成';
            break;
        case 5:
            return '修改';
            break;
        case 6:
            return '争议';
            break;
    }
}

function red($r){
    if($r != '已付清' && $r != '无'){
        return "<span style='color: red;'>$r</span>";
    }else{
        return $r;
    }
}

function sty($t){
    if($t > 5){
        return "<span style='color: red;'>$t</span>";
    }else{
        return $t;
    }
}

function base($b){
    return base64_decode($b);
}

function che($c){
    if($c == ''){
        return 0;
    }else{
        return $c;
    }
}

function statu($t){
    if($t == 1 ){
        return '未分配';
    }else  if($t == 2 ){
        return '已分配';
    }else  if($t == 3 ){
        return '未完成';
    }else  if($t == 4 ){
        return '已完成';
    }else  if($t == 5 ){
        return '修改';
    }else if($t == 6){
        return '争议';
    }
}

function zone($z){
    if($z == 1 ){
        return '美国东部';
    }else  if($z == 2 ){
        return '美国中部';
    }else  if($z == 3 ){
         return '美国山地';
    }else  if($z == 4 ){
        return '美国西部';
    }else{
        return '北京时间';
    }
}

function level($l){
    switch ($l){
        case 1:
            return 'A';
            break;
        case 2:
            return 'B';
            break;
        case 3:
            return 'C';
            break;
        case 4:
            return 'D';
            break;
    }
}

/*
 * $z  时区
 * $t  时间
 * */
function gettime($z,$t){
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
    $m['h'] = floor($sjc/3600);
    $sjc = $sjc/60;
    $m['m'] = $sjc%60;
    $m['bj'] = $bj;
    //echo '时间差'.$m.'<br />';
    return $m;
}

function clas($m){
    switch ($m){
        case 1;
            return '销售人员组';
            break;
        case 2;
            return '任务管理组';
            break;
        case 3;
            return '财务人员组';
            break;
        case 4;
            return 'TA人员组';
            break;
    }
}

function two($t){
    return number_format($t,2);
}

function export_csv($filename,$data)
{
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=".$filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    echo $data;
}

function qzjz($q){
    if($q == '1'){
        return '全职';
    }else{
        return '兼职';
    }
}

function chst($c){
    if($c == '0'){
        return '首次提交';
    }elseif($c == '1'){
        return '第二次提交';
    }else{
        return '第三次提交';
    }
}

function chec($q){
    if($q == '1'){
        return '通过';
    }else if($q == '0') {
        return '暂未知';
    }else if($q == '2') {
        return '不通过';
    }
}

function ch($q){
    if($q == '0'){
        return '暂未知';
    }elseif($q == '1'){
        return '抽检';
    }else if($q == '2') {
        return '不抽检';
    }
}