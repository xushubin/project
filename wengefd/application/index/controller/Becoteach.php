<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/23
 * Time: 16:53
 */

namespace app\index\controller;


class Becoteach extends Home
{

    public function becoteach(){
        $this->assign('title','成为老师');
        return $this->fetch();
    }

    public function regsiter(){
        $post = input('post.');
        $msg = $this->tea->getone(" name = '$post[name]'");
        if(!empty($msg)){
            $this->error('用户名已存在');
        }
        $post['pass'] = md5($post['pass']);
        $post['tutoty'] = '';
        foreach ($post['tutotype'] as $v){
            $post['tutoty'] .= ' '.$v[0];
        }
        $post['course'] = '';
        if(isset($post['cours'])){
            foreach ($post['cours'] as $v){
                $post['course'] .= ' '.$v;
            }
        }
        unset($post['cours']);
        $post['tutotype'] = serialize($post['tutotype']);
        $avatar = request()->file('avatar');
        if(!empty($avatar)){
            $info = $avatar->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post['avatar'] = $info->getSaveName();
            }
        }
        $post['avatar'] = str_replace('\\','/',$post['avatar']);

        $idcard = request()->file('idcard');
        if(!empty($idcard)){
            $info = $idcard->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post['idcard'] = $info->getSaveName();
            }
        }
        $degree = request()->file('degree');
        if(!empty($degree)){
            $info = $degree->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post['degree'] = $info->getSaveName();
            }
        }

        $this->tea->add($post);
        $this->success('申请提交成功!');
    }

}