<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Student
{
    public function getall($where){
        return Db::name('student')->where($where)->select();
    }

    public function getpage($where = ''){
        return Db::name('student')->order('id desc')->where($where)->paginate(15);
    }

    public function getone($where,$feild="*"){
        return Db::name('student')->where($where)->field($feild)->find();
    }

    public function add($data){
        return Db::name('student')->insertGetId($data);
    }

    public function edit($data){
        Db::name('student')->update($data);
    }

    public function getonly($id){
        return Db::name('student')->where('id',$id)->value('name');
    }
}