<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Check
{
    public function getone($where){
        return Db::name('check')->where($where)->select();
    }

    public function add($data){
        Db::name('check')->insert($data);
    }

    public function edit($data){
        Db::name('check')->update($data);
    }

    public function getcou($where){
        return Db::name('check')->where($where)->count();
    }
}