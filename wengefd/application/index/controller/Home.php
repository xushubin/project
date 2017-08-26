<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12
 * Time: 15:01
 */

namespace app\index\controller;
use app\index\model\Chatnum;
use app\index\model\Payment;
use app\index\model\Record;
use app\index\model\Schedu;
use app\index\model\Student;
use app\index\model\Task;
use app\index\model\Taskstatus;
use app\index\model\Teach;
use think\Controller;

class Home extends Controller
{
    protected $stud;
    protected $tea;
    protected $task;
    protected $pay;
    protected $stat;
    protected $sch;
    protected $record;

    public function __construct()
    {
        parent::__construct();
        $this->stud = new Student();
        $this->tea = new Teach();
        $this->task = new Task();
        $this->pay = new Payment();
        $this->stat = new Taskstatus();
        $this->sch = new Schedu();
        $this->record = new Record();
        $action = request()->action();
        $this->assign('action',$action);
        if(session('?name')){
            $this->assign('islogin','1');
            $id = session('id');
            $msg = $this->stud->getone("id = $id");
            if($msg['avatar'] == ''){
                $this->assign('avatar','__PUBLIC__/images/avatar2.png');
            }else{
                $avar = '/public/uploads/'.$msg['avatar'];
                $this->assign('avatar',$avar);
            }
        }else{
            $this->assign('islogin','0');
        }
    }
}