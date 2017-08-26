<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 14:52
 */

namespace app\index\model;
use think\Db;

class Record
{
    public function add($data){
        return Db::name('record')->insertGetId($data);
    }

    public function getall($where){
        return Db::name('record')->where($where)->select();
    }

}