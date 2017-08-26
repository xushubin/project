<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Term
{
    public function getone($id){
        return Db::name('term')->where("id = $id")->find();
    }

    public function getall($where){
        return Db::name('term')->where($where)->select();
    }

    public function edit($data){
        Db::name('term')->update($data);
    }

    public function add($data){
        return Db::name('term')->insertGetId($data);
    }
}