<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Ta
{
    public function getone($where){
        return Db::name('ta')->where($where)->find();
    }

    public function getall($field = "*",$where = ""){
        return Db::name('ta')->field($field)->where($where)->select();
    }

    public function add($data){
        Db::name('ta')->insert($data);
    }

    public function edit($data){
        Db::name('ta')->update($data);
    }

    public function del($id){
        Db::name('ta')->delete($id);
    }

    public function getonly($id,$col="name"){
        return Db::name('ta')->where('id',$id)->value($col);
    }
}