<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 16:05
 */

namespace app\index\model;
use think\Db;

class Unitpr
{
    public function getone($data){
        return Db::name('unitpr')->where("task = $data")->field('quotgr')->order('quotgr')->select();
    }

    public function getmsg($task,$quotgr,$zi){
        return Db::name('unitpr')->where("task = $task and quotgr = $quotgr")->field($zi)->find();
    }

}