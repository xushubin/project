<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:45
 */

namespace app\index\controller;


class Taskcreate extends Backstage
{

    public function index(){
        return $this->fetch();
    }

    public function choicetask(){
        $userid = input('userid');
        $qqid = input('qqid');
        $wechatid = input('wechatid');
//        echo '<pre>';
//        print_r($post);
        $where = '';
        if($userid != ''){
            $where .= " userid = '$userid' and ";
        }

        if($qqid != ''){
            $where .= " qqid = '$qqid' and ";
        }

        if($wechatid != ''){
            $where .= " wechatid = '$wechatid' and ";
        }
        $where = substr($where, 0, -4);

        $msg = $this->user->getone($where);
      // print_r($msg);die;

        $mm = "qqid=$qqid&wechatid=$wechatid";
        if(empty($msg)){
            $this->error('未查询到任何用户编号，请创建用户',url('usermana/createuser',$mm));
        }

        $this->assign('qqid',$qqid);
        $this->assign('wechatid',$wechatid);
        $this->assign('userid',$userid);
        $this->assign('mm',$mm);
        $this->assign('msg',$msg);
        return $this->fetch();

    }

    public function createOrder(){
        $post = input('post.');
        $unitpr= $this->unit->getone($post['taskid']);
        $sourm = $this->sou->getone($post['name']);
        $taskid= $this->task->getone($post['taskid']);
        //print_r($sourm);
        //print_r($taskid);
        $userid = ++$sourm['lastid'];
        $orderid = ++$taskid['lastid'];

        $us['userid'] = $userid;
        $us['qqid'] = $post['qqid'];
        $us['wechatid'] = $post['wechatid'];
        $this->user->add($us);
            $or['userid'] = $userid;
            $or['orderid'] = $orderid;
            $or['taskid'] = $post['taskid'];
        if($taskid['id'] != '1') {
            $or['id'] = $this->order->add($or);
        }else{
            $or['id'] = '0';
        }

        $sourm['lastid'] = $userid;
        $this->sou->edit($sourm);

        $taskid['lastid'] = $orderid;
        $this->task->edit($taskid);
//
        $this->assign('or',$or);
        $this->assign('url',url('usermana/createuser',"qqid=".$post['qqid']."&wechatid=".$post['wechatid']));
        $this->assign('unitpr',$unitpr);
        $this->assign('taskid',$post['taskid']);
        return $this->fetch();
    }

    public function fanorder(){
        $id = input('id');
        $taskid = input('taskid');
        $unitpr= $this->unit->getone($taskid);
        $or= $this->order->getid($id);
        $or['id'] = $id;
		 $or['taskid'] = $taskid;
        $this->assign('or',$or);
        $this->assign('unitpr',$unitpr);
		 $this->assign('url','');
        $this->assign('taskid',$taskid);
        return $this->fetch('createOrder');
    }

    public function createtask(){
        $post = input('post.');
//        echo '<pre>';
//        print_r($post);
        $unitpr= $this->unit->getone($post['taskid']);
        //print_r($unitpr);
        $taskid= $this->task->getone($post['taskid']);
        $orderid = ++$taskid['lastid'];
        $or['userid'] = $post['userid'];
        $or['orderid'] = $orderid;
        $or['taskid'] = $post['taskid'];
        $taskid['lastid'] = $orderid;
        $this->task->edit($taskid);
        if($taskid['id'] != '1') {
            $or['id'] = $this->order->add($or);
        }else{
            $or['id'] = '0';
        }
        $this->assign('or',$or);
        $this->assign('url',url('choicetask',"userid=".$post['uid']."&qqid=".$post['qqid']."&wechatid=".$post['wechatid']));
        $this->assign('taskid',$post['taskid']);
        $this->assign('unitpr',$unitpr);
        return $this->fetch('createorder');
    }

    public function calcu(){
        $time = input('time');
        $zone = input('zone');

        $time = strtotime($time);
        $m = gettime($zone,$time);
	
        if($m['h'] >= 48){
            $m['z'] = 'dayu48';
        }else if($m['h']>=24 && $m['h']<48){
            $m['z'] = '48to24';
        }else if($m['h']>=12 && $m['h']<24){
            $m['z'] = '24to12';
        }else if($m['h']>=6 && $m['h']<12){
            $m['z'] = '12to6';
        }else{
            $m['z'] = '6to0';
        }
        return json($m['z']);
    }

    public function invoice(){
        $post = input("post.");
//
//        echo '<pre>';
//        print_r($post);
//        die;
        $log['uid'] = session('id');
        $log['tid'] = $post['id'];
        $log['class'] = '销售接单：'.$post['orderid'];
        $log['logtime'] = time();
        $log['remark'] = $post['remark'];
        $this->log->add($log);

        $taskid = $post['taskid'];
        if (isset($post['deadline'])) {
            if ($post['deadline'] == '') {
                $post['deadline'] = 0;
            } else {
                $post['deadline'] = strtotime($post['deadline']);
            }
        }
        if (isset($post['closdate'])) {
            $post['closdate'] = strtotime($post['closdate']);
        }
        $unit = 0;
        $post['zontotal'] = 0;
        if ($taskid != '5'){
            $unitpr = $this->unit->getmsg($post['taskid'], $post['quotgr'], $post['utitpr']);//单价
            $unit = number_format($unitpr[$post['utitpr']], 2);
            $total = $unit * $post['ductnum'] + $post['addmoney'] - $post['discount'];
            $post['zontotal'] = $total;
        }
        unset($post['utitpr']);
        unset($post['taskid']);
        //$total = number_format($total,2);//总价
        $post['ordertime'] = time();
        $this->order->edit($post);
        $msg = $this->order->getid($post['id']);
        $this->assign('taskid',$taskid);
        $this->assign('post',$post);
        $this->assign('unit',$unit);
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function course(){
        $post = input('post.');
        $post['couid'] = $post['orderid'];
        unset($post['utitpr']);
        unset($post['taskid']);
        unset($post['orderid']);
        $id = $this->cour->add($post);
        $data['uid'] = session('id');
        $data['tid'] = $id;
        $data['remark'] = $post['remark'];
        $data['logtime'] = time();
        $data['class'] = '新课程接入';
        $this->log->add($data);
        $this->success('C类任务提交成功！',url('index'));
    }

}