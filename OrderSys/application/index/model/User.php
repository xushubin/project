<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class User
{
    public function getone($where){
        return Db::name('user')->where($where)->select();
    }

    public function add($data){
        Db::name('user')->insert($data);
    }
}