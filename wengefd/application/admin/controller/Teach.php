<?php

namespace app\admin\controller;

class Teach extends Admin{

    public function index(){
        $data = $this->tea->getpage();
        $msg = $data->items();
        $page = $data->render();
//        echo '<pre>';
//        print_r($msg);
        $this->assign('page',$page);
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function detail(){
        $id = input('id');
        $msg = $this->tea->getone("id = $id");
        $msg['tutotype'] = unserialize($msg['tutotype']);
        foreach ($msg['tutotype'] as $k=>$v){
            if($v['0'] == ''){
                unset($msg['tutotype'][$k]);
            }
        }
       $cou = count($msg['tutotype'])+1;
//        echo '<pre>';
//        print_r($msg);
//        die;
        $this->assign('msg',$msg);
        $this->assign('cou',$cou);
        return $this->fetch();
    }

    public function chang(){
        $post['id'] = input('id');
        $post['is_ok'] = input('ok');
        $this->tea->edit($post);
        $this->success('审核状态修改成功！',url('teach/index'));
    }
}