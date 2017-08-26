<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Log
{
    public function getall($where){
        return Db::name('log')->where($where)->select();
    }

    public function add($data){
        Db::name('log')->insert($data);
    }
}