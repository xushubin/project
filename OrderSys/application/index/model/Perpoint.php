<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Perpoint
{
    public function getall($where){
        return Db::name('perpoint')->where($where)->order('time desc')->select();
    }

    public function add($data){
        Db::name('perpoint')->insert($data);
    }
}