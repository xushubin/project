<?php
namespace app\index\controller;

use app\index\model\Admin;
use think\Controller;
use think\Cookie;

class Index extends Controller
{
    public function index()
    {
        if(session('?id')){
           $this->success('您已登录','/index.php/index/Backstage/index');
        }
        if(Cookie::has('name') && Cookie::has('pass')){
            $this->assign('name',cookie('name'));
            $this->assign('pass',cookie('pass'));
        }else{
            $this->assign('name','');
            $this->assign('pass','');
        }
        return $this->fetch();
    }

    public function login(){
        $post = input('post.');
        $ad = new Admin();
        $msg = $ad->getone($post['name']);
        if(empty($msg)){
            $this->error('用户名错误');
        }
        if($msg['pass'] != md5($post['pass'])){
            $this->error('密码错误');
        }
        if(isset($post['reme'])){
            cookie('name', $post['name'], 7*24*3600);
            cookie('pass', $post['pass'], 7*24*3600);
        }
        session('name', $post['name']);
        session('id', $msg['id']);
        session('class', $msg['class']);
        $this->success('登录成功',url('Backstage/index'));
    }

    public function logout(){
        session(null);
        $this->success('退出成功','/');
    }
}