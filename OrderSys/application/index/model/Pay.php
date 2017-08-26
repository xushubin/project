<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Pay
{
    public function getone($where){
        return Db::name('pay')->where($where)->select();
    }

    public function getms($where){
        return Db::name('pay')->where($where)->order('paytime desc')->field('paymark,lastdate')->find();
    }

    public function geto($id){
        return Db::name('pay')->where("orderid = '$id'")->order('paytime')->field('paymoney,lastdate,payentry')->select();
    }

    public function getall(){
        return Db::name('pay')->order('paytime desc')->select();
    }

    public function getmsg($id){
        return Db::name('pay')->where("userid = $id")->order('paytime desc')->select();
    }

    public function add($data){
        Db::name('pay')->insert($data);
    }
}