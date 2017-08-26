<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class From
{
    public function getmsg(){
        return db('from')->select();
    }

    public function getkey($id){
        return db('from')->where("id = $id")->field('key')->find();
    }

    public function edit($data){
        db('from')->update($data);
    }

    public function add($data){
        db('from')->insert($data);
    }

    public function del($id){
        db('from')->delete($id);
    }

}