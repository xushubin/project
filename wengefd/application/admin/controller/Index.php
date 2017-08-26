<?php
namespace app\admin\controller;

use think\Controller;
use think\Cookie;

class Index extends Controller
{
    public function index()
    {
        if(session('?admin')){
            $this->success('您已登录',url('Teach/index'));
        }
        if(Cookie::has('admin') && Cookie::has('password')){
            $this->assign('name',cookie('admin'));
            $this->assign('pass',cookie('password'));
        }else{
            $this->assign('name','');
            $this->assign('pass','');
        }
        return $this->fetch();
    }

    public function login(){
        $post = input('post.');
        if($post['name'] != 'admin' || $post['pass'] != 'wenge'){
            $this->error('用户名或密码错误，请重新输入！');
        }
        if(isset($post['reme'])){
            cookie('admin', $post['name'], 7*24*3600);
            cookie('password', $post['pass'], 7*24*3600);
        }
        session('admin', 'wenge');
        $this->success('登陆成功',url('teach/index'));
    }

    public function logout(){
        session('admin', null);
        $this->success('退出成功',url('index/index'));
    }
}
