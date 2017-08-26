<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class Clas
{
    public function getmsg(){
        return db('clas')->select();
    }

    public function getname($id){
        return db('clas')->where("id = $id")->find();
    }

    public function edit($data){
        db('clas')->update($data);
    }

    public function add($data){
        db('clas')->insertAll($data);
    }

    public function del($id){
        db('clas')->delete($id);
    }
}