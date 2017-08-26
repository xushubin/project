<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:00
 */

namespace app\index\controller;

use app\index\model\Admin;
use app\index\model\Chaike;
use app\index\model\Check;
use app\index\model\Course;
use app\index\model\Log;
use app\index\model\Pay;
use app\index\model\Perpoint;
use app\index\model\Cpoint;
use app\index\model\Regulate;
use app\index\model\Ta;
use app\index\model\Term;
use think\Controller;
use app\index\model\Source;
use app\index\model\Taskid;
use app\index\model\Unitpr;
use app\index\model\User;
use app\index\model\Order;

class Backstage extends Controller
{
    protected $sou;
    protected $user;
    protected $task;
    protected $order;
    protected $unit;
    protected $pay;
    protected $cour;
    protected $ta;
    protected $admin;
    protected $chai;
    protected $term;
    protected $regulate;
    protected $log;
    protected $check;
    protected $per;
    protected $cpoint;

    public function __construct()
    {
        parent::__construct();
        if(!session('?id')){
            $this->error('请先登录','/');
        }
        $this->assign('name',session('name'));
        $this->assign('class',session('class'));
        $request = \think\Request::instance();
       // echo '<pre>';
       // print_r($request);
        $action = $request->controller();
        //echo $action;
        $this->assign('action',$action);
        $this->sou = new Source();
        $this->user = new User();
        $this->task = new Taskid();
        $this->order = new Order();
        $this->unit = new Unitpr();
        $this->pay = new Pay();
        $this->cour = new Course();
        $this->ta = new Ta();
        $this->admin = new Admin();
        $this->chai = new Chaike();
        $this->term = new Term();
        $this->log = new Log();
        $this->check = new Check();
        $this->regulate = new Regulate();
        $this->per = new Perpoint();
        $this->cpoint = new Cpoint();
    }

    public function index(){
        return $this->fetch();
    }
}