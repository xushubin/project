<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Teach
{
    public function getall($where = ''){
        return Db::name('teacher')->order('id desc')->where($where)->select();
    }

    public function getpage($where = ''){
        return Db::name('teacher')->order('id desc')->where($where)->paginate(15);
    }

    public function getpa1($where = ''){
        return Db::name('teacher')->order('id desc')->where($where)->paginate(8);
    }

    public function getonly($id,$col){
        return Db::name('teacher')->where('id',$id)->value($col);
    }

    public function getone($where,$field = '*'){
        return Db::name('teacher')->where($where)->field($field)->find();
    }

    public function add($data){
        return Db::name('teacher')->insertGetId($data);
    }

    public function edit($data){
        Db::name('teacher')->update($data);
    }

    public function setinc($id){
        return Db::name('teacher')->where('id',$id)->setInc('tasknum');
    }

    public function setnum($id){
        return Db::name('teacher')->where('id',$id)->setInc('studnum');
    }
}
