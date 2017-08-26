<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Cpoint
{
    public function getall($where){
        return Db::name('cpoint')->where($where)->select();
    }

    public function add($data){
        Db::name('cpoint')->insert($data);
    }

    public function edit($data){
        Db::name('cpoint')->update($data);
    }
}