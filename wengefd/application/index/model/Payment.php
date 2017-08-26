<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Payment
{
    public function getall($where){
        return Db::name('payment')->where($where)->select();
    }

    public function getpage($where = ''){
        return Db::name('payment')->order('id desc')->where($where)->paginate(15);
    }

    public function getone($where){
        return Db::name('payment')->where($where)->find();
    }

    public function add($data){
        return Db::name('payment')->insertGetId($data);
    }

    public function edit($data){
        Db::name('payment')->update($data);
    }

    public function getonly($id,$col){
        return Db::name('payment')->where('id',$id)->value($col);
    }

}