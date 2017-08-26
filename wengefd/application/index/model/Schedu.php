<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 14:52
 */

namespace app\index\model;
use think\Db;

class Schedu
{
    public function getonly($id){
        return Db::name('schedu')->where('id',$id)->value('number');
    }

    public function getall($where){
        return Db::name('schedu')->where($where)->order('id')->select();
    }

    public function add($data){
        return Db::name('schedu')->insertGetId($data);
    }

    public function edit($data){
        Db::name('schedu')->update($data);
    }
}