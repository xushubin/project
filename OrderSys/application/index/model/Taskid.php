<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Taskid
{
    public function getone($id){
        return Db::name('taskid')->where("id = $id")->find();
    }

    public function getall($where){
        return Db::name('taskid')->where($where)->select();
    }

    public function edit($data){
        Db::name('taskid')->update($data);
    }
}