<?php
namespace app\index\controller;
use think\Cookie;


class Index extends Home
{
    public function index()
    {
        if(Cookie::has('user') && Cookie::has('pass')){
            $this->assign('name',cookie('user'));
            $this->assign('pass',cookie('pass'));
        }else{
            $this->assign('name','');
            $this->assign('pass','');
        }
        $this->assign('title','首页');
        return $this->fetch();
    }

    public function about(){
        $this->assign('title','关于我们');
        return $this->fetch();
    }
}
