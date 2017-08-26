<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class Baojia
{
    public function getmsg(){
        return db('baojia')->select();
    }

    public function getone($id){
        return db('baojia')->where("id = $id")->find();
    }

    public function edit($data){
        db('baojia')->update($data);
    }

    public function add($data){
        return db('baojia')->insertGetId($data);
       // return db('baojia')->getLastInsID();
    }

    public function del($id){
        db('baojia')->delete($id);
    }

}