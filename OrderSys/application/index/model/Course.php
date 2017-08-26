<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Course
{
    public function getone($where){
        return Db::name('course')->where($where)->find();
    }

    public function getall(){
        return Db::name('course')->select();
}

    public function add($data){
        return Db::name('course')->insertGetId($data);
    }

    public function edit($data){
        Db::name('course')->update($data);
    }

    public function getonly($where,$field){
        return Db::name('course')->where($where)->value($field);
    }

    public function joins($table,$con,$where,$field){
        return Db::name('course')->alias('c')->join($table,$con)->where($where)->field($field)->find();
    }
}