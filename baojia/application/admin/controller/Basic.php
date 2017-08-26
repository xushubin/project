<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 15:44
 */

namespace app\admin\controller;


use think\Controller;

class Basic extends Controller
{
    private $duct;
    public function __construct()
    {
        parent::__construct();
        $this->duct = new \app\index\model\Ductpri();
    }

    public function index(){
        $msg = $this->duct->getmsg();
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function edit(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $this->duct->edit($post);
        $this->success('产品类基础价格修改成功');
    }

    public function add(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $this->duct->add($post);
        $this->success('产品类基础价格新增成功');
    }

    public function del(){
        $post = input('id');
        $this->duct->del($post);
        $this->success('产品类基础价格删除成功');
    }

}