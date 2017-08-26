<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;
use think\Paginator;

class Order
{
    public function getall($where,$order = '',$field  = "*"){
        return Db::name('order')->order($order)->where($where)->field($field)->paginate(15);
    }

    public function getamsg(){
        return Db::name('order')->order('ordertime desc')->where("remain !=0 and tasktitle != '' ")->field('saleper,id,taskstatus,orderid,userid,remain,tasktitle,shitotal,paystatus')->select();
    }

    public function getpage(){
        return Db::name('order')->order('ordertime desc')->where("zontotal != 0")->paginate(15);
    }

    public function getmsg($id){
        return Db::name('order')->where("userid = $id")->order('ordertime desc')->select();
    }

    public function getone($where){
        return Db::name('order')->where($where)->find();
    }

    public function getsel($where = '',$order = "ordertime desc",$field = "*"){
        return Db::name('order')->where($where)->order($order)->field($field)->select();
    }

    public function add($data){
        return Db::name('order')->insertGetId($data);
    }

    public function edit($data){
        Db::name('order')->update($data);
    }

    public function getid($id){
        return Db::name('order')->where("id = $id")->field('userid,orderid,shitotal')->find();
    }

    public function joins($table,$con,$where,$field){
        return Db::name('order')->alias('o')->join($table,$con)->where($where)->field($field)->find();
    }
}