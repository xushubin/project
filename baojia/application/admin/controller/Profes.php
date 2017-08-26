<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 15:55
 */

namespace app\admin\controller;

use think\Controller;

class Profes extends Controller
{
    private $pro;
    public function __construct()
    {
        parent::__construct();
        $this->pro = new \app\index\model\Profess();
    }

    public function index(){
        $id = input('id');
        $cla = new \app\index\model\Clas();
        $mag = $cla->getmsg();

        $this->assign('mag',$mag);
        if($id == 0){
            $this->assign('id',0);
            $msg = $this->pro->getall();
        }else{
            $msg = $this->pro->getmsg($id);
            $this->assign('id',$id);
        }
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function edit(){
        $post = input('post.');
        $this->pro->edit($post);
        $this->success('课程修改成功');
    }

    public function add(){
        $post = input('post.');
        $this->pro->add($post);
        $this->success('课程新增成功');
    }

    public function del(){
        $post = input('id');
        $this->pro->del($post);
        $this->success('课程删除成功');
    }
}