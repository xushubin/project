<?php

namespace app\admin\controller;

class Task extends Admin{

    public function index(){
        $data = $this->task->getpage();
        $msg = $data->items();
        $page = $data->render();
        $this->assign('page',$page);
        $this->assign('msg',$msg);
        return $this->fetch();
    }
}