<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 15:35
 */

namespace app\admin\controller;


use think\Controller;

class Shape extends Controller
{
    private $from;
    public function __construct()
    {
        parent::__construct();
        $this->from = new \app\index\model\From();
    }

    public function index(){
        $msg = $this->from->getmsg();
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function edit(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $this->from->edit($post);
        $this->success('形式修改成功');
    }

    public function add(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $this->from->add($post);
        $this->success('形式新增成功');
    }

    public function del(){
        $post = input('id');
        $this->from->del($post);
        $this->success('形式删除成功');
    }
}