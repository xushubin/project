<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class Profess
{
    public function getmsg($id){
        return db('profess')->where("profe = $id")->select();
    }

    public function getkey($id){
        return db('profess')->where("id = $id")->find();
    }

    public function getall(){
        return db('profess')->select();
    }

    public function edit($data){
        db('profess')->update($data);
    }

    public function add($data){
        db('profess')->insert($data);
    }

    public function del($id){
        db('profess')->where('id',$id)->delete();
    }
}