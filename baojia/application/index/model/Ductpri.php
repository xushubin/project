<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 11:22
 */

namespace app\index\model;
use think\Db;

class Ductpri
{
    public function getmsg(){
        return db('ductpri')->select();
    }

    public function edit($data){
        db('ductpri')->update($data);
    }

    public function add($data){
        db('ductpri')->insert($data);
    }

    public function del($id){
        db('ductpri')->delete($id);
    }

}