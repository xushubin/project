<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Admin
{
    public function getone($name){
        return Db::name('admin')->where("name = '$name'")->find();
    }

    public function getall(){
        return Db::name('admin')->where('class != 0')->select();
    }

    public function add($data){
        return Db::name('admin')->insertGetId($data);
    }

    public function edit($data){
        Db::name('admin')->update($data);
    }

    public function del($id){
        Db::name('admin')->delete($id);
    }

    public function getonly($id){
        return Db::name('admin')->where("id = $id")->value('name');
    }
}