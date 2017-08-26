<?php
namespace app\index\controller;

use app\index\model\Student;
use app\index\model\Teach;
use think\Controller;

class User extends Controller
{

    public function redirec(){
        if(!session('?name')){
            $this->error('请先登录','/?login');
        }

        $class = session('class');
        if($class == 1){
            $this->redirect(url('students/inde'));
        }else{
            $this->redirect(url('teach/inde'));
        }
    }

    public function login(){
        $post = input('post.');
        if(!captcha_check($post['code'])){
            $this->error('验证码错误，请重新输入');
        };
        if($post['is'] == 1){
            $cl = '学员：';
            $stud = new Student();
        }else{
            $cl = '老师：';
            $stud = new Teach();
        }
        // print_r($post);die;
        $msg = $stud->getone(" name = '$post[user]'");
        if($post['is'] == 2 && $msg['is_ok'] == '0') {
            $this->error('用户名未审核通过，请联系管理员');
        }
        if(empty($msg)){
            $this->error('用户名不存在，请重新输入');
        }

        if(md5($post['pass']) != $msg['pass']){
            $this->error('密码错误，请重新输入');
        }
        if(isset($post['remen'])){
            cookie('user', $post['user'], 7*24*3600);
            cookie('pass', $post['pass'], 7*24*3600);
        }
        session('name', $cl.$msg['name']);
        session('id', $msg['id']);
        session('class', $post['is']);
        $this->success('登陆成功','/');
    }

    public function reg(){
        $this->assign('title','注册');
        $this->assign('islogin',0);
        $this->assign('action','');
        return $this->fetch();
    }

    public function regsiter(){
        $post = input('post.');
        $stud = new Student();
        $msg = $stud->getone(" name = '$post[name]'");
        if(!empty($msg)){
            $this->error('用户名已存在');
        }
        $post['pass'] = md5($post['pass']);
        $sid = $stud->add($post);
        $this->assign('sid',$sid);
        $this->assign('name',$post['name']);
        $this->assign('title','完善信息');
        $this->assign('islogin',0);
        $this->assign('action','');
        return $this->fetch();
    }

    public function enrol(){
        $post = input('post.');
        $stud = new Student();
        $file = request()->file('file');

        if(!empty($file)){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post['avatar'] = $info->getSaveName();
            }
        }
        $stud->edit($post);
        session('name', '学员：'.$post['name']);
        session('id', $post['id']);
        session('class', '1');//学员
        $this->success('注册成功','/');
    }

    public function logout(){
        session('name', null);
        session('id', null);
        session('class', null);
        $this->redirect('/');
    }

}
