<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 10:14
 */

namespace app\admin\controller;

use think\Controller;
use app\index\model\Clas;


class Index extends Controller
{
    private $cla;
    public function __construct()
    {
        parent::__construct();
        $this->cla = new Clas();
    }

    public function index(){
        $msg = $this->cla->getmsg();
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function edit(){
        $post = input('post.');
        $this->cla->edit($post);
        $this->success('专业修改成功');
    }

    public function add(){
        $post = input('post.');
        $arr = explode(',',$post['name']);
       // echo '<pre>';
        //print_r($arr);
        foreach($arr as $k=>$v){
            if($v != ''){
                $msg[$k]['name']=$v;
            }
        }
      //print_r($msg);
        $this->cla->add($msg);
        $this->success('专业新增成功');
    }

    public function del(){
        $post = input('id');
        $this->cla->del($post);
        $this->success('专业删除成功');
    }

}