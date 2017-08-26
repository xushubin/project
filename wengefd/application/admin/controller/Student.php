<?php

namespace app\admin\controller;

class Student extends Admin{

    public function index(){
        $data = $this->stud->getpage();
        $msg = $data->items();
        $page = $data->render();
//        echo '<pre>';
//        print_r($msg);die;
        $this->assign('page',$page);
        $this->assign('msg',$msg);
        return $this->fetch();
    }
}