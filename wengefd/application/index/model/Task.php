<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Task
{
    public function getall($where,$field="*"){
        return Db::name('task')->where($where)->field($field)->select();
    }

    public function getlim($where){
        return Db::name('task')->where($where)->field('id,title,teid,sid,pj')->limit(3)->order('time')->select();
    }

    public function getpage($where = ''){
        return Db::name('task')->order('id desc')->where($where)->paginate(15);
    }

    public function getpage8($where = ''){
        return Db::name('task')->order('id desc')->where($where)->paginate(8);
    }

    public function getone($where){
        return Db::name('task')->where($where)->find();
    }

    public function getonly($id,$col){
        return Db::name('task')->where('id',$id)->value($col);
    }

    public function setinc($id){
        return Db::name('task')->where('id',$id)->setInc('taskstatus');
    }

    public function add($data){
        return Db::name('task')->insertGetId($data);
    }

    public function edit($data){
        Db::name('task')->update($data);
    }

    public function joins($j,$o,$i,$n){
        return Db::table('task')->alias('t')->join($j,$o)->where($i)->field($n)->find();
    }

    public function join($j,$o,$i,$n){
        return Db::table('task')->alias('t')->join($j,$o)->where($i)->field($n)->select();
    }

    public function count($where){
        return Db::table('task')->where($where)->count();
    }

}