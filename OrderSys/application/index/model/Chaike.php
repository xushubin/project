<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Chaike
{
    public function getone($where){
        return Db::name('chaike')->where($where)->find();
    }

    public function getpa($where,$order = '',$field  = "*"){
        return Db::name('chaike')->order($order)->where($where)->field($field)->paginate(15);
    }

    public function getall($where,$fie="*"){
        return Db::name('chaike')->where($where)->field($fie)->select();
    }

    public function add($data){
        Db::name('chaike')->insert($data);
    }

    public function edit($data){
        Db::name('chaike')->update($data);
    }

    public function joins($table,$con,$where,$field){
        return Db::name('chaike')->alias('c')->join($table,$con)->where($where)->field($field)->find();
    }
}