<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Source
{
    public function getone($id){
        return Db::name('source')->where("id = $id")->find();
    }

    public function edit($data){
        Db::name('source')->update($data);
    }
}