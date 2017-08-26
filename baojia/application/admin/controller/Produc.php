<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 15:13
 */

namespace app\admin\controller;

use think\Controller;

class Produc extends Controller
{
    private $pro;
    public function __construct()
    {
        parent::__construct();
        $this->pro = new \app\index\model\Product();
    }

    public function index(){
        $msg = $this->pro->getmsg();
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function edit(){
        $post = input('post.');
         //echo '<pre>';
        //print_r($post);
        $this->pro->edit($post);
        $this->success('产品类型修改成功');
    }

    public function add(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $this->pro->add($post);
        $this->success('产品类型新增成功');
    }

    public function del(){
        $post = input('id');
        $this->pro->del($post);
        $this->success('产品类型删除成功');
    }

}