<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12
 * Time: 15:01
 */

namespace app\admin\controller;
use app\index\model\Student;
use app\index\model\Teach;
use app\index\model\Task;
use think\Controller;

class Admin extends Controller
{
    protected $stud;
    protected $tea;
    protected $task;

    public function __construct()
    {
        parent::__construct();
        $this->stud = new Student();
        $this->task = new Task();
        $this->tea = new Teach();
        $this->assign('name','wenge');
        $action = request()->controller();
        $this->assign('action',$action);
        if(!session('?admin')){
            $this->success('您未登录',url('index/index'));
        }
    }
}