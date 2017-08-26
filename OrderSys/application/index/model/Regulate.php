<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Regulate
{
    public function getone($where){
        return Db::name('regulate')->where($where)->find();
    }

    public function getall($where){
        return Db::name('regulate')->where($where)->select();
    }

    public function edit($data){
        Db::name('regulate')->update($data);
    }

    public function add($data){
        return Db::name('regulate')->insertGetId($data);
    }
}