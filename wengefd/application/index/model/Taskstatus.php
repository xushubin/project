<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 14:52
 */

namespace app\index\model;
use think\Db;

class Taskstatus
{
    public function getonly($id){
        return Db::name('taskstatus')->where('id',$id)->value('name');
    }

}