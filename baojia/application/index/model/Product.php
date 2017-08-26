<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class Product
{
    public function getmsg(){
        return db('product')->select();
    }

    public function getkey($id){
        return db('product')->where("id = $id")->field('key')->find();
    }

    public function edit($data){
        db('product')->update($data);
    }

    public function add($data){
        db('product')->insert($data);
    }

    public function del($id){
        db('product')->delete($id);
    }
}