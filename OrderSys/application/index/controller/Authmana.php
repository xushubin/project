<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:24
 */

namespace app\index\controller;


use app\index\model\Admin;

class Authmana extends Backstage
{
    protected $admin;

    public function __construct()
    {
        parent::__construct();
        $this->admin = new Admin();
    }

    public function index(){
        $msg = $this->admin->getall();
//        echo '<pre>';
//        print_r($msg);
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function addmana(){
        $post = input('post.');

        $post['pass'] = md5($post['pass']);
        $this->admin->add($post);
        $this->success('管理人员添加成功');
    }

    public function editpass(){
        $post = input('post.');
//        echo '<pre>';
//        print_r($post);
        $post['pass'] = md5($post['pass']);
        $this->admin->edit($post);
        $this->success('管理人员密码修改成功');
    }

}