<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:07
 */

namespace app\index\controller;

class Taskmana extends Backstage
{
    public function course(){//课程列表
        $msg = $this->cour->getall();
        foreach ($msg as $k=>$v){
            $msg[$k]['ta'] = $this->ta->getonly($v['ta']);
        }
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function coudetal(){//课程详情
        $id = input('id');
        $msg = $this->cour->getone("id = $id");
        if($msg['ta'] == 0){
            $tas = $this->ta->getall('id,name');
            $this->assign('tas',$tas);
            $this->assign('flag','0');
        }else{
            $msg['file'] = unserialize($msg['file']);
            $this->assign('flag','1');
        }

        $ter = $this->cpoint->getall("cid = $id");
        if(empty($ter)) {
            $sy = date('Y', strtotime($msg['startdate']));
            $ey = date('Y', strtotime($msg['enddate']));
            if ($sy == $ey) {//同一年
                $sn = date('n', strtotime($msg['startdate']));
                $en = date('n', strtotime($msg['enddate']));
                for ($i = $sn; $i <= $en; $i++) {
                    $da = $sy . '-' . $i;
                    $ed = date('t', strtotime(date($da)));
                    $date[] = $da . '-' . $ed;
                }
            } else {//跨年
                $sn = date('n', strtotime($msg['startdate']));
                $en = date('n', strtotime($msg['enddate']));
                $en = $en + 12;
                for ($i = $sn; $i <= $en; $i++) {
                    if ($i <= 12) {
                        $da = $sy . '-' . $i;
                        $ed = date('t', strtotime(date($da)));
                        $date[] = $da . '-' . $ed;
                    } else {
                        $a = $i - 12;
                        $da = $ey . '-' . $a;
                        $ed = date('t', strtotime(date($da)));
                        $date[] = $da . '-' . $ed;
                    }
                }
            }
            foreach ($date as $k=>$v){
                $dat['cid'] = $msg['id'];
                $dat['ta'] = $msg['ta'];
                $dat['date'] = $v;
                $ter[$k]['id'] = $this->cpoint->add($dat);
                $ter[$k]['date'] = $v;
                $ter[$k]['ta'] = $this->ta->getonly($msg['ta']);
                $ter[$k]['jidian'] = $msg['jidian'];
                $ter[$k]['laji'] = 0;
                $ter[$k]['fl'] = 0;
            }
        }else{
            foreach ($ter as $k=>$v){
                $ter[$k]['ta'] = $this->ta->getonly($v['ta']);
                if(empty($v['jidian'])){
                    $ter[$k]['jidian'] = $msg['jidian'];
                    $ter[$k]['fl'] = 0;
                }else{
                    $ter[$k]['fl'] = 1;
                }
            }
        }
        $tas = $this->ta->getall('id,name');
        foreach ($tas as $k=>$v){
            if($v['id'] == $msg['ta']){
                unset($tas[$k]);
            }
        }
//echo '<pre>';
//        print_r($ter);die;
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $this->assign('msg',$msg);
        $this->assign('ter',$ter);
        $this->assign('tas',$tas);
        return $this->fetch();
    }

    public function dojidian(){
        $arr = input('post.');
        $msg = $this->cour->getone("id = '$arr[cid]'");
        $this->cpoint->edit($arr);
        $log['uid'] = session('id');
        $log['tid'] = $msg['id'];
        $da['tid'] = $msg['couid'];
        $da['ta'] = $msg['ta'];
        $da['jidian'] = $arr['jidian'];
        $da['final'] = $arr['jidian'];
        $da['taskji'] = $msg['jidian'];
        $da['time'] = time();
        $this->per->add($da);
        $log['logtime'] = time();

        $y = date('n',time());
        $data['lastmon'] = $y;
        $data['id'] = $msg['ta'];
        $tas = $this->ta->getone("id = '$msg[ta]'");
        if($tas['lastmon'] == '0' || $tas['lastmon'] != $y){
            $data['monji'] = $arr['jidian'];
            $data['cpop'] = $arr['jidian'];
        }else{
            $data['monji'] = $tas['monji'] + $arr['jidian'];
            $data['cpop'] = $arr['jidian']+$tas['cpop'];
        }
        $this->ta->edit($data);

        if($arr['lata'] == '0' && $arr['laji'] == ''){
            $log['class'] = 'TA绩点结算';
            $ta = $this->ta->getonly($msg['ta']);
            $log['remark'] = $ta.',获得'.$arr['jidian'].'绩点。';
        }else{
            $da1['tid'] = $msg['couid'];
            $da1['ta'] = $arr['lata'];
            $da1['jidian'] = $arr['laji'];
            $da1['final'] = $arr['laji'];
            $da1['taskji'] = $msg['jidian'];
            $da1['time'] = time();
            $log['class'] = 'TA绩点结算（有TA更换情况）';
            $ta = $this->ta->getonly($msg['ta']);
            $ta1 = $this->ta->getonly($arr['lata']);
            $log['remark'] = $ta.',获得'.$arr['jidian'].'绩点，'.$ta1.'获得'.$arr['laji'].'绩点。';
            $this->per->add($da1);
            $data1['lastmon'] = $y;
            $data1['id'] = $arr['lata'];
            $tas1 = $this->ta->getone("id = '$arr[lata]'");
            if($tas1['lastmon'] == '0' || $tas1['lastmon'] != $y){
                $data1['monji'] = $arr['laji'];
                $data1['cpop'] = $arr['laji'];
            }else{
                $data1['monji'] = $tas1['monji'] + $arr['laji'];
                $data1['cpop'] = $arr['laji']+$tas1['cpop'];
            }
            $this->ta->edit($data1);
        }
        $this->log->add($log);
        $this->success('绩点结算成功');
    }

    public function couother(){//学期奖记录及绩效点调节
        $id = input('id');
        $msg = $this->cour->getone("id = $id");
        if($msg['ta'] == 0){
            $this->error('请先完善课程信息！');
        }

        $ter = $this->term->getall("cid = $id");
        if(empty($ter)){
            $sy = date('Y',strtotime($msg['startdate']));
            $ey = date('Y',strtotime($msg['enddate']));
            if($sy == $ey){//同一年
                $sn = date('n',strtotime($msg['startdate']));
                $en = date('n',strtotime($msg['enddate']));
                for($i=$sn;$i<=$en;$i++){
                    $da = $sy.'-'.$i;
                    $ed = date('t',strtotime(date($da)));
                    $date[] = $da.'-'.$ed;
                }
            }else{//跨年
                $sn = date('n',strtotime($msg['startdate']));
                $en = date('n',strtotime($msg['enddate']));
                $en = $en+12;
                for($i=$sn;$i<=$en;$i++){
                    if($i <= 12){
                        $da = $sy.'-'.$i;
                        $ed = date('t',strtotime(date($da)));
                        $date[] = $da.'-'.$ed;
                    }else{
                        $a = $i-12;
                        $da = $ey.'-'.$a;
                        $ed = date('t',strtotime(date($da)));
                        $date[] = $da.'-'.$ed;
                    }
                }
            }
            foreach ($date as $k=>$v){
                $dat['cid'] = $msg['id'];
                $dat['ta'] = $msg['ta'];
                $dat['date'] = $v;
                $ter[$k]['id'] = $this->term->add($dat);
                $ter[$k]['date'] = $v;
                $ter[$k]['level'] = 0;
                $ter[$k]['remark'] = '';
                $ter[$k]['jidian'] = 0;
            }
            $dat['cid'] = $msg['id'];
            $dat['ta'] = $msg['ta'];
            $dat['date'] = 0;
            $final['id'] = $this->term->add($dat);
            $final['level'] = 0;
            $final['remark'] = '';
            $final['jidian'] = 0;
        }else{
            $final = end($ter);
            array_pop($ter);
        }
        $reg = $this->regulate->getone("cid = $id");

        if(empty($reg)){
            if($msg['tasklevel'] == '1'){
                $jidian = $this->task->getone(11);
            }else if($msg['tasklevel'] == '2'){
                $jidian = $this->task->getone(12);
            }elseif($msg['tasklevel'] == '3'){
                $jidian = $this->task->getone(13);
            }elseif($msg['tasklevel'] == '4'){
                $jidian = $this->task->getone(14);
            }
            $this->assign('isji','1');
            $this->assign('jidian',$jidian);
        }else{
            $this->assign('isji','0');
            $this->assign('reg',$reg);
        }

        $this->assign('msg',$msg);
        $this->assign('final',$final);
        $this->assign('ter',$ter);
        return $this->fetch();
    }

    public function coulog(){
        $id = input('id');
        $log = $this->log->getall("tid = $id");
        foreach ($log as $k=>$v){
            $log[$k]['uid'] = $this->admin->getonly($v['uid']);
        }
        $this->assign('id',$id);
        $this->assign('log',$log);
        return $this->fetch();
    }

    public function xueqi(){//学期奖提交
        $post = input('post.');

        $this->term->edit($post);
        $log['uid'] = session('id');
        $log['tid'] = $post['cid'];
        if(!isset($post['date'])){
            $log['class'] = '最终等级记录，任务结束';
        }else{
            $log['class'] = $post['date'].'记录等级';
        }
        $log['remark'] = '等级为：'.$post['level'].'，备注为：'.$post['remark'];
        $log['logtime'] = time();
        $this->log->add($log);
        $this->success('学期奖更新成功');
    }

    public function regulate(){//绩效点调节
        $post = input('post.');
        if($post['jidian'] == ''){
            $this->error('请填写增减绩点数后在提交');
        }

        $tas = $this->cour->joins('ta','c.ta = ta.id',"c.id = '$post[cid]'",'ta.*');
        $data['id'] = $tas['id'];
        $ids = $this->cour->getonly("id = '$post[cid]'",'couid');
        $per['tid'] = $ids;
        $per['ta'] = $tas['id'];
        $per['time'] = time();
        $data['monji'] = $tas['monji'] + $post['jidian'];
        $data['cpop'] = $post['jidian']+$tas['cpop'];
        $per['jidian'] = $post['jidian'];
        $this->ta->edit($data);
        $this->per->add($per);
//        echo '<pre>';
//        print_r($post);
//        die;

        $log['uid'] = session('id');
        $log['tid'] = $post['cid'];
        $log['class'] = '绩效点调节';
        $log['logtime'] = time();
        $log['remark'] = "绩效点调节 ".$post['jidian']." 点，备注为：".$post['remark']."，最终绩点为：".$post['final'];
        $this->log->add($log);
        $this->regulate->add($post);
        $this->success('绩效点调节成功',url('couother','id='.$post['cid']));
    }

    public function editcou(){//课程编辑
        $post = input('post.');
        if(isset($post['ta'])) {
            $files = request()->file('file');
            $post['file'] = [];
            foreach ($files as $file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $post['file'][] = $info->getSaveName();
                }
            }
            $post['file'] = serialize($post['file']);
        }
        $level = $this->cour->getonly("id = '$post[id]'",'tasklevel');
        if($level == 1){
            $con = $this->task->getone(11);
        }else if($level == 2){
            $con = $this->task->getone(12);
        }elseif($level == 3){
            $con = $this->task->getone(13);
        }elseif($level == 4){
            $con = $this->task->getone(14);
        }
        $post['jidian'] = $con['lastid']*4/$post['length'];
        $ta = $this->ta->getonly($post['ta']);
        $data['uid'] = session('id');
        $data['tid'] = $post['id'];
        $data['logtime'] = time();
        $data['class'] = '任管添加课程信息';
        $data['remark'] = '分配课程给TA：'.$ta;
        $this->log->add($data);
        $this->cour->edit($post);

        $this->success('课程编辑成功',url("coudetal",'id='.$post['id']));
    }

    public function disconnect(){//拆课表
        $id = input('id');
        $msg = $this->cour->getone("id = $id");
        if($msg['ta'] == 0){
             $this->error('请先完善课程信息！');
        }
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $tas = $this->chai->getall("cid = $id");
        $date = date('Y').'-'.date('m').'-'.date('d').' 23:59:59';
        $this->assign('msg',$msg);
        $this->assign('date',$date);
        if($msg['coustatus'] == '3'){
//            echo '<pre>';
//            print_r($tas);die;
            if(count($tas) > 20){
                $data = $this->chai->getpa("cid = $id");
                $tas = $data->all();
                $page = $data->render();
            }else{
                $page = '';
            }
            foreach ($tas as $k=>$v){
                $ids = $this->chai->joins('order','order.orderid = c.taskid',"c.id='$v[id]'",'order.id,order.taskid,order.ductnum,order.check,order.chresult');
                $tas[$k]['oid'] = $ids['id'];
                $tas[$k]['chresult'] = $ids['chresult'];
                if($ids['check'] == 0) {
                    if ($ids['taskid'] == '1') {
                        $ru = $this->task->getone(7);
                    } else {
                        $ru = $this->task->getone(8);
                    }
                    if($ids['ductnum'] > $ru['lastid']){
                        $tas[$k]['check'] = 1;
                    }else{
                        $tas[$k]['check'] = 0;
                    }
                }else{
                    $tas[$k]['check'] = $ids['check'];
                }
            }
            $this->assign('page',$page);
            $this->assign('tas',$tas);
            $this->assign('id',$id);
            return $this->fetch('discon');
        }else{
            $ms = end($tas);
            if(is_array($ms)){
                $ck['0'] = $ms['taskid'];
            }else{
                $ck['0'] = $msg['couid'].'00';
            }
            for($i=1;$i<=15;$i++){
                $a = $i-1;
                $ck[$i] = ++$ck[$a];
            }
            $this->assign('ck',$ck);
            return $this->fetch();
        }
    }

    public function chaike(){//拆课表提交
        $post = input('post.');
        $date = date('Y-m-d',time());
        $id = $post['id'];
        unset($post['id']);

        if(isset($post['add'])){
            unset($post['add']);
            foreach ($post as $k => $v){
                if($v['tasktitle'] == '' || $v['percent'] == ''){
                    unset($post[$k]);
                }
                if($v['startdate'] == $date){
                    unset($post[$k]['startdate']);
                }
            }
            $cou = $this->cour->getone("id = '$id'");
            foreach ($post as $v) {
                $this->chai->add($v);
            }
            $tas = $this->chai->getall("cid = $id");
            foreach ($tas as $v){
                $data['userid'] = $cou['userid'];
                $data['orderid'] = $v['taskid'];
                $data['saleper'] = $cou['saleper'];
                $data['tasktitle'] = $v['tasktitle'];
                $data['deadline'] = strtotime($v['enddate']);
                $data['closdate'] = strtotime($v['startdate']);
                $data['quotgr'] = $cou['quotgr'];
                $data['addmark'] = $cou['addmark'];
                $data['addmoney'] = $cou['addmoney'];
                $data['discomar'] = $cou['discomar'];
                $data['discount'] = $cou['discount'];
                $data['tasklevel'] = $cou['tasklevel'];
                $data['remark'] = $cou['remark'];
                $data['ta'] = $cou['ta'];
                $data['taskid'] = 1;
                $data['taskstatus'] = 1;
                $data['zone'] = 5;
                $data['tasklength'] = $cou['length'];
                $data['ductnum'] = $v['percent'];
                $data['ordertime'] = time();
                $this->order->add($data);
            }
            $da['coustatus'] = 3;
            $da['id'] = $id;
            $this->cour->edit($da);
            $this->success('拆课表制作完成！',url('coudetal','id='.$id));
        }else{
            unset($post['save']);
            foreach ($post as $v){
                if($v['startdate'] == $date){
                    unset($v['startdate']);
                }
                $this->chai->add($v);
            }

            $data['coustatus'] = 2;
            $data['id'] = $id;
            $this->cour->edit($data);
            $this->redirect('disconnect',['id'=>$id]);

        }
    }

    public function chaitime(){//单个拆课表时间更新
        $post = input('post.');
        $datem = date('d');
        $dm = date('d',strtotime($post['startdate']));
        $id = $this->chai->joins('order','c.taskid = order.orderid',"c.id = '$post[id]'",'order.id');
        if($dm == $datem){
            unset($post['startdate']);
        }else{
            $data['closdate'] = strtotime($post['startdate']);
        }
        $this->chai->edit($post);
        $data['id'] = $id['id'];
        $data['deadline'] = strtotime($post['enddate']);
        $this->order->edit($data);
        $this->success('时间更新成功');
    }

    public function editta(){//更换TA表单页面
        $id = input('id');
        $cl = input('cl');
        if($cl == 2){//整课更换ta
            $msg = $this->cour->getone("id = $id");
            $msg['taskid'] = $msg['couid'];
            $msg['cid'] = $msg['id'];
        }else if($cl ==3){
            $msg = $this->order->getone("id = $id");
            $msg['jidian'] =  $msg['finalji'];
            $msg['cid'] = $msg['id'];
        }
        $tas = $this->ta->getall('id,name');
        foreach ($tas as $k=>$v){
            if($v['id'] == $msg['ta']){
                unset($tas[$k]);
            }
        }
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $this->assign('cl',$cl);
        $this->assign('tas',$tas);
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function upta(){//整课任务更换ta表单
        $id = input('id');
        $msg = $this->cour->getone("id = $id");
        $tas = $this->ta->getall('id,name');
        foreach ($tas as $k=>$v){
            if($v['id'] == $msg['ta']){
                unset($tas[$k]);
            }
        }
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $this->assign('tas',$tas);
        $this->assign("msg",$msg);
        return $this->fetch();
    }

    public function msg(){
        $id = input('id');
        $ren = input('ren');
        $m = $this->chai->getone("taskid = '$ren'");
        if(!is_array($m)){
            $arr['id'] = 0;
            $arr['msg'] = '该任务编号不存在';
            return json($arr);
        }
        $ms = $this->chai->getall("cid = $id");
        $allb = 0; //总比重
        $bz = 0; //当前比重
        foreach ($ms as $v){
            $allb += $v['percent'];
            if($v['id'] > $m['id']){
                continue;
            }
            $bz += $v['percent'];
        }
        $arr['bz'] = $bz;
        $arr['ren'] = ++$ren;
        $arr['sybz'] = $allb-$bz;
        return json($arr);
    }

    public function updateta(){
        $post = input('post.');
        $log['uid'] = session('id');
        $log['logtime'] = time();
        $log['tid'] = $post['id'];
        $ids = $this->chai->getall("cid = '$post[id]'","id");
        $cou['id'] = $post['id'];
        $cou['ta'] = $post['ta'];
        $cou['tasklevel'] = $post['tasklevel'];
        $this->cour->edit($cou);
        $m = $this->chai->getone("taskid = '$post[taren]'");
        foreach ($ids as $v){
            if($v['id'] <= $m['id']){
                continue;
            }
            $data['id'] = $v['id'];
            $data['enddate'] = $post['enddate'];
            $data['ta'] = $post['ta'];
            $this->chai->edit($data);
            $cou = $this->chai->joins('order','c.taskid = order.orderid',"c.id = '$v[id]'",'order.id');
            $da['id'] = $cou['id'];
            $da['deadline'] = strtotime($post['enddate']);
            $da['ta'] = $post['ta'];
            $da['tasklevel'] = $post['tasklevel'];
            $this->order->edit($da);
        }
        $ltn = $this->ta->getonly($post['ta']);
        $log['remark'] = 'TA：'. $post['yuta'].',比重：'.$post['yutabi'] .'更换成：'.$ltn.',比重：'.$post['xintabi'];
        $log['class'] = 'C类任务换TA';
        $this->log->add($log);
        $this->success('TA人员更换成功',url('coudetal','id='.$post['id']));
    }

    public function modifyta(){//更换TA处理页面
        $post = input('post.');
        $log['uid'] = session('id');
        $log['tid'] = $post['cid'];
        $log['logtime'] = time();
        if($post['cl'] == 2){//整课
            $tn = $this->cour->joins("ta","ta.id = c.ta","c.id = '$post[cid]'","ta.name");
            $ids = $this->chai->getall("cid = '$post[id]'","id");
            $cou['id'] = $post['id'];
            $cou['ta'] = $post['ta'];
            $cou['tasklevel'] = $post['tasklevel'];
            $this->cour->edit($cou);
            foreach ($ids as $v){
                $data['id'] = $v['id'];
                $data['enddate'] = $post['enddate'];
                $data['ta'] = $post['ta'];
                $this->chai->edit($data);
                $cou = $this->chai->joins('order','c.taskid = order.orderid',"c.id = '$v[id]'",'order.id');
                $da['id'] = $cou['id'];
                $da['deadline'] = strtotime($post['enddate']);
                $da['ta'] = $post['ta'];
                $da['tasklevel'] = $post['tasklevel'];
                $this->order->edit($da);
            }

            $ltn = $this->ta->getonly($post['ta']);
            $log['remark'] = 'TA：'. $tn['name'] .'更换成'.$ltn;
            $log['class'] = '整课换TA';
            $this->log->add($log);
            $this->success('TA人员更换成功',url('coudetal','id='.$post['cid']));
        }else{//非C类
            $da['id'] = $post['cid'];
            $da['deadline'] = strtotime($post['enddate']);
            $da['ta'] = $post['ta'];
            $da['tasklevel'] = $post['tasklevel'];
            $this->order->edit($da);
            $ltn = $this->ta->getonly($post['ta']);
            $log['class'] = '任务更换TA';
            $log['remark'] = 'TA人员更换为'.$ltn;
            $this->log->add($log);
            $this->success('TA人员更换成功',url('ordetal','id='.$post['cid']));
        }
    }

    public function index(){// 任务看板
        $where = "tasktitle != '' and taskstatus != 4 and ";
        if(session('class') == 4){
            $aid = session('id');
            $ta = $this->ta->getone("adminid = $aid");
            $where .= " ta = '$ta[id]' and ";
        }
        $where = substr($where, 0, -4);
        $msg = $this->order->getsel($where);
        $page = '';
//        $data = $msg->items();
        foreach ($msg as $k => $v){
            $m = gettime($v['zone'],$v['deadline']);
            if($m['h'] <= 0){
                //$data[$k]['time'] = '已截止';
                unset($msg[$k]);
                continue;
            }else {
                if($m['h'] > 48){
                    unset($msg[$k]);
                    continue;
                }else if($m['h'] < 12){
                    $msg[$k]['isred'] = 1;
                }else{
                    $msg[$k]['isred'] = 0;
                }
                $msg[$k]['time'] = $m['h'] . "小时" . $m['m'] . "分钟";
            }
            $msg[$k]['bj'] = date('Y-m-d H:i',$m['bj']);
            $msg[$k]['ta'] = $this->ta->getonly($v['ta']);
        }
//
//        die;
        $this->assign('time',3);
        $this->assign('taskid',10);
        $this->assign('taskstatus',-1);
        $this->assign('ord',0);
        $this->assign('jie',0);
        $this->assign('msg',$msg);
        $this->assign('page',$page);
        return $this->fetch();
    }

    public function filter(){//任务看板排序
        $taskid = input('taskid');
        $taskstatus = input('taskstatus');
        $ord = input('ord');
        $jie = input('jie');
        $time = input('time');
        if($ord == ''){
            $ord = 0;
        }
        if($jie == ''){
            $jie = 0;
        }
        $where = "tasktitle != '' and ";
        if($taskid != 10){
            $where .= " taskid = '$taskid' and ";
        }

        if($taskstatus == -1){
            $where .= " taskstatus != '4' and ";
        }else if($taskstatus != 10){
            $where .= " taskstatus = '$taskstatus' and ";
        }
        if(session('class') == 4){
            $aid = session('id');
            $ta = $this->ta->getone("adminid = $aid");
            $where .= " ta = '$ta[id]' and ";
        }
        $where = substr($where, 0, -4);
        $order = 'deadline desc';
//        if($ord == 1){
//            $order = "orderid desc";
//        }else if($ord == 2){
//            $order = "orderid";
//        }
//
//        if($jie == 1){
//            $order = "deadline desc";
//        }else if($jie == 2){
//            $order = "deadline";
//        }
        $fie = 'id,orderid,userid,tasktitle,remark,taskstatus,misslic,ta,taskmark,zone,deadline,paystatus,taskid';
        if($time ==5 || $time == 10){
            $msg = $this->order->getall($where,$order,$fie);
            $page = $msg->render();
            $data = $msg->all();
        }else{
            $page = '';
            $data = $this->order->getsel($where,$order,$fie);
        }

        foreach ($data as $k => $v) {
            $m = gettime($v['zone'], $v['deadline']);
            if($time == 1){
                if ($m['h'] < 0 || $m['h'] > 12) {
                    unset($data[$k]);
                    continue;
                }
            }else if($time == 2){
                if ($m['h'] < 0 || $m['h'] > 24) {
                    unset($data[$k]);
                    continue;
                }
            }else if($time == 3){
                if ($m['h'] < 0 || $m['h'] > 48) {
                    unset($data[$k]);
                    continue;
                }
            }else if($time == 4){
                if ($m['h'] < 0 || $m['h'] > 168) {
                    unset($data[$k]);
                    continue;
                }
            }else if($time == 5){
                if ($m['h'] < 0 || $m['h'] > 720) {
                    unset($data[$k]);
                    continue;
                }
            }else if($time == 6){
                if ($m['h'] > 0 ) {
                    unset($data[$k]);
                    continue;
                }
            }

            if ($m['h'] <= 0) {
                $data[$k]['time'] = '已过期'.$m['h'] . "小时";
            }else{
                $data[$k]['time'] = $m['h'] . "小时" . $m['m'] . "分钟";
            }
            if($m['h'] < 12 && $v['taskstatus'] != 4){
                $data[$k]['isred'] = 1;
            }else{
                $data[$k]['isred'] = 0;
            }

            $data[$k]['m'] = $m['h'];
            $data[$k]['bj'] = date('Y-m-d H:i',$m['bj']);
            $data[$k]['ta'] = $this->ta->getonly($v['ta']);
            if( $m['h'] < 0 && $m['h'] > -48 && $v['taskstatus'] != 4){
                $data[$k]['order'] = 1;
            }else if($m['h'] > 0){
                $data[$k]['order'] = 2;
            }else{
                $data[$k]['order'] = 3;
            }
        }
        $one = [];
        $two = [];
        $three = [];
        foreach ($data as $v){
            if($v['order'] == 1){
                $one[] = $v;
            }else if($v['order'] == 2){
                $two[] = $v;
            }else{
                $three[] = $v;
            }
        }
        arsort($two);

        $data = array_merge($one,$two,$three);
//        echo '<pre>';
//        print_r($data);die;
        $this->assign('taskid',$taskid);
        $this->assign('taskstatus',$taskstatus);
        $this->assign('msg',$data);
        $this->assign('page',$page);
        $this->assign('ord',$ord);
        $this->assign('jie',$jie);
        $this->assign('time',$time);
        return $this->fetch('index');
    }

    public function add(){//任务更换状态提交
        $post = input('post.');
        $log['uid'] = session('id');
        $log['tid'] = $post['id'];
        $log['logtime'] = time();
        $log['remark'] = $post['taskmark'];
        if($post['taskstatus'] == 1){
            $log['class'] = '修改任务状态为：未分配';
        }elseif ($post['taskstatus'] == 2){
            $log['class'] = '修改任务状态为：已分配';
        }elseif ($post['taskstatus'] == 4){
            $log['class'] = '修改任务状态为：已完成';
        }elseif ($post['taskstatus'] == 5){
            $log['class'] = '修改任务状态为：修改';
        }elseif ($post['taskstatus'] == 6){
            $log['class'] = '修改任务状态为：争议';
        }
        if($post['taskid'] != 1 && $post['taskstatus'] == '4'){//绩点结算
            $tas = $this->order->joins('ta','o.ta = ta.id',"o.id = '$post[id]'",'o.finalji,ta.*');
            $y = date('n',time());
            $data['id'] = $tas['id'];
            $ids = $this->order->getid($post['id']);
            $per['tid'] = $ids['orderid'];
            $per['ta'] = $tas['id'];
            $per['time'] = time();
            if($post['taskid'] == 3){//E类
                if($tas['class'] == 1){//全职
                    if($tas['lastmon'] == '0' || $tas['lastmon'] != $y){
                        $data['monji'] = $tas['finalji'];
                        $data['epop'] = $tas['finalji'];
                    }else{
                        $data['monji'] = $tas['monji'] + $tas['finalji'];
                        $data['epop'] = $tas['finalji']+$tas['epop'];
                    }
                    //$data['jidian'] = $tas['finalji']+$tas['jidian'];
                    $per['jidian'] = $tas['finalji'];
                    $per['final'] = $tas['finalji'];
                    $per['taskji'] = $tas['finalji'];
                }else{//兼职
                    if($tas['lastmon'] == '0' || $tas['lastmon'] != $y){
                        $data['epay'] = $tas['finalji']*$tas['eper'];
                        $data['monji'] = $data['epay'];
                        $data['epop'] = $tas['finalji'];
                    }else{
                        $data['epay'] = $tas['finalji']*$tas['eper']+$tas['epay'];
                        $data['monji'] = $tas['monji'] + $tas['finalji']*$tas['eper'];
                        $data['epop'] = $tas['finalji'];
                    }
                    //$data['jidian'] = $data['epay']+$tas['jidian'];
                    $per['jidian'] = $tas['finalji'];
                    $per['final'] = $tas['eper'];
                    $per['taskji'] = $tas['finalji']*$tas['eper'];
                }
            }else{
                if($tas['class'] == 1){//全职
                    if($tas['lastmon'] == '0' || $tas['lastmon'] != $y){
                        $data['monji'] = $tas['finalji'];
                        $data['phpop'] = $tas['finalji'];
                    }else{
                        $data['monji'] = $tas['monji'] + $tas['finalji'];
                        $data['phpop'] = $tas['finalji'] + $tas['phpop'];
                    }
                    //$data['jidian'] = $tas['finalji']+$tas['jidian'];
                    $per['jidian'] = $tas['finalji'];
                    $per['final'] = $tas['finalji'];
                    $per['taskji'] = $tas['finalji'];
                }else{
                    $phpay = $tas['finalji']*$tas['phper'];
                    if($tas['lastmon'] == '0' || $tas['lastmon'] != $y){
                        $data['phpay'] = $phpay;
                        $data['monji'] = $phpay;
                        $data['phpop'] = $tas['finalji'];
                    }else{
                        $data['monji'] = $tas['monji'] + $phpay;
                        $data['phpay'] = $phpay + $tas['phpay'];
                        $data['phpop'] = $tas['finalji'] + $tas['phpop'];
                    }
                    //$data['jidian'] =  $data['phpay']+$tas['jidian'];
                    $per['jidian'] = $tas['finalji'];
                    $per['final'] = $tas['phper'];
                    $per['taskji'] = $tas['finalji']*$tas['phper'];
                }
            }
            $data['lastmon'] = $y;
//            echo '<pre>';
//            print_r($data);
//            print_r($per);
//            die;
            $this->ta->edit($data);
            $this->per->add($per);
        }
        $this->log->add($log);
        $this->order->edit($post);
        $this->success('数据更新成功');
    }

    public function tamana(){//TA管理
        $msg = $this->ta->getall();
//        echo '<pre>';
//        print_r($msg);die;
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function addta(){//TA新增编辑
        $id = input('id');
        if($id != ''){
            $msg = $this->ta->getone("id = $id");
            $this->assign('msg',$msg);
            $this->assign('is','1');
        }else{
            $this->assign('is','0');
        }
        return $this->fetch();
    }

    public function edita(){//处理TA新增或编辑
        $post = input('post.');
        if(isset($post['id'])){
            $this->ta->edit($post);
        }else{
//            echo '<pre>';
//            print_r($post);die;
            $data['name'] = $post['name'];
            $data['pass'] = md5($post['pass']);
            $data['class'] = 4;
            $post['adminid'] = $this->admin->add($data);
            unset($post['pass']);
            $this->ta->add($post);
        }
        $this->success('TA添加/编辑成功！',url('tamana'));
    }

    public function delta(){//TA删除
        $id = input('id');
        $msg = $this->ta->getone("id = $id");
        $this->ta->del($id);
        $this->admin->del($msg['adminid']);
        $this->success('删除成功');
    }

    public function manage(){//管理策略显示
        $msg = $this->task->getall("id > 6");
//        echo '<pre>';
//        print_r($msg);
        foreach ($msg as $v){
            $this->assign($v['name'],$v['lastid']);
        }
        return $this->fetch();
    }

    public function editmana(){//管理策略编辑
        $post = input('post.');
        if($post['pass'] != 'xrjy2017'){
            $this->error('确认码错误！');
        }
        unset($post['pass']);
        foreach ($post as $k=>$v){
            $data['id'] = $k;
            $data['lastid'] = $v;
            $this->task->edit($data);
        }
        $this->success('管理策略编辑成功');
    }

    public function search(){//搜索
        $post = input('id');
        if($post == ''){
            $this->error('请输入任务编号后查询！');
        }
        $msg = $this->order->getone("orderid = '$post'");
        if(!$msg){
            $this->error('请输入正确的任务编号后查询！');
        }
        $m = gettime($msg['zone'],$msg['deadline']);
//        echo '<pre>';
//        print_r($msg);
//        print_r($m);
//        DIE;
        $msg['bj'] = $m['bj'];
        if ($m['h'] <= 0) {
            $msg['time'] = '已截止';
        } else {
            $msg['time'] = $m['h'] . "小时" . $m['m'] . "分钟";
        }
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $this->assign('msg',$msg);
        return $this->fetch('ordetal');
    }

    public function ordetal(){//任务详情
        $post = input('id');
        $msg = $this->order->getone("id = '$post'");
        $m = gettime($msg['zone'],$msg['deadline']);
        $msg['bj'] = $m['bj'];
        if ($m['h'] <= 0) {
            $msg['time'] = '已截止';
        } else {
            $msg['time'] = $m['h'] . "小时" . $m['m'] . "分钟";
        }
        $tas = $this->ta->getall('id,name');
        $msg['ta'] = $this->ta->getonly($msg['ta']);
        $this->assign('msg',$msg);
        $this->assign('tas',$tas);
        return $this->fetch();
    }

    public function ordji(){//任务绩点提交
        $arr = input('post.');
//        echo '<pre>';
//        print_r($arr);die;
        if(isset($arr['ta'])){
            $log['uid'] = session('id');
            $log['tid'] = $arr['id'];
            $ltn = $this->ta->getonly($arr['ta']);
            $log['class'] = '任务分配给TA：'.$ltn;
            $log['logtime'] = time();
            $log['remark'] = '';
            $this->log->add($log);
            $arr['taskstatus'] = 2;
        }
        $this->order->edit($arr);
        $this->success('任务绩点提交成功');
    }

    public function orexam(){//审核列表
        $post = input('id');
        $msg = $this->order->getone("id = '$post'");

        if($msg['taskid'] == '1'){
            $ru = $this->task->getone(7);
        }else{
            $ru = $this->task->getone(8);
        }
        if($msg['check'] == 0){
            if($msg['ductnum'] > $ru['lastid']){
                $log['class'] = '该任务符合必检条件，自动设置该任务为抽检';
                $log['uid'] = session('id');
                $log['tid'] = $post;
                $log['logtime'] = time();
                $log['remark'] = '';
                $this->log->add($log);

                $data['id'] = $msg['id'];
                $data['check'] = 1;
                $this->order->edit($data);
                $msg = $this->order->getone("id = '$post'");
            }
        }

        $m = gettime($msg['zone'],$msg['deadline']);
        $msg['bj'] = $m['bj'];
        if ($m['h'] <= 0) {
            $msg['time'] = '已截止';
        } else {
            $msg['time'] = $m['h'] . "小时" . $m['m'] . "分钟";
        }
        $ch = $this->check->getone("orid = $post");
        if(empty($ch)){
            $this->assign('fl','0');//ta是否显示上传资料表单
            $this->assign('ch','0');//当前是否有历史审核资料
            $this->assign('flag','0');//当前是否有需要审核的资料
        }else{
//            echo '<pre>';
//            print_r($ch);
//            die;
            $xu = end($ch);
            if($xu['check'] == 2 && $xu['chstatus'] < 2){
                $this->assign('fl','0');
            }else{
                $this->assign('fl','1');
            }
            if($xu['check'] == 0){
                array_pop($ch);
                $this->assign('flag','1');
            }else{
                $this->assign('flag','0');
            }
            $this->assign('ch','1');
            $this->assign('check',$ch);
            $this->assign('xu',$xu);
        }
        $this->assign('msg',$msg);
//die;
        return $this->fetch();
    }

    public function upcheck(){//ta上传资料
        $arr = input('post.');
        $arr['chstatus'] = $this->check->getcou("orid = '$arr[orid]'");
        $voucher = request()->file('voucher');
        $chfile1 = request()->file('chfile1');
        $chfile2 = request()->file('chfile2');
        $chfile3 = request()->file('chfile3');
        if ($voucher) {
            $info1 = $voucher->move(ROOT_PATH . 'public' . DS . 'uploads');
            $arr['voucher'] = $info1->getSaveName();
        }

        if ($chfile1) {
            $info2 = $chfile1->move(ROOT_PATH . 'public' . DS . 'uploads');
            $arr['chfile1'] = $info2->getSaveName();
        }

        if ($chfile2) {
            $info3 = $chfile2->move(ROOT_PATH . 'public' . DS . 'uploads');
            $arr['chfile2'] = $info3->getSaveName();
        }

        if ($chfile3) {
            $info4 = $chfile3->move(ROOT_PATH . 'public' . DS . 'uploads');
            $arr['chfile3'] = $info4->getSaveName();
        }
        $ci = $arr['chstatus']+1;
        $log['class'] = 'TA上传资料第'.$ci.'次';
        $log['uid'] = session('id');
        $log['tid'] = $arr['orid'];
        $log['logtime'] = time();
        $log['remark'] = '';
        $this->log->add($log);
        $arr['time'] = time();
        $this->check->add($arr);
        $this->success('资料提交成功');
    }

    public function orcheck(){//资料审核
        $arr = input('post.');
        $data['id'] = $arr['orid'];
        $data['chresult'] = $arr['check'];
        $arr['chectime'] = time();
        $data['chectime'] = time();
        if($arr['check'] == 1){
            $log['class'] = '审核资料为通过';
        }else{
            $log['class'] = '审核资料为不通过';
        }
        $log['uid'] = session('id');
        $log['tid'] = $arr['orid'];
        $log['logtime'] = time();
        $log['remark'] = $arr['remark'];
        $this->log->add($log);
        $this->check->edit($arr);
        $this->order->edit($data);
        $this->success('资料审核成功');
    }

    public function check(){//审核抽检列表及导出
        $msg = $this->order->getsel();
        foreach ($msg as $k=>$v){
            if($v['check'] == 0){
                if($v['taskid'] == '1'){
                    $ru = $this->task->getone(7);
                }else{
                    $ru = $this->task->getone(8);
                }
                if($v['ductnum'] <= $ru['lastid']){
                    unset($msg[$k]);
                    continue;
                }
            }
            $msg[$k]['ta'] = $this->ta->getonly($v['ta']);
            if($v['chectime'] == ''){
                $msg[$k]['chectime'] = '暂未审核';
            }else{
                $msg[$k]['chectime'] = date('Y-m-d H:i:s',$v['chectime']);
            }
            if($v['check'] == '0'){
                $msg[$k]['check'] = '暂未知';
            }elseif($v['check'] == '1'){
                $msg[$k]['check'] = '抽检';
            }else if($v['check'] == '2') {
                $msg[$k]['check'] = '不抽检';
            }

            if($v['chresult'] == '0'){
                $msg[$k]['chresult'] = '暂未知';
            }elseif($v['chresult'] == '1'){
                $msg[$k]['chresult'] = '通过';
            }else if($v['chresult'] == '2') {
                $msg[$k]['chresult'] = '不通过';
            }
        }
//        echo '<pre>';
//        print_r($msg);
//        die;
        $dao = input('daochu');
        if($dao){
            $str = "任务编号,任务名称,抽检状态,抽检结果,当前ta,审核时间\n";
            foreach($msg as $k => $v){
                $str .= $v['orderid'].','.$v['tasktitle'].','.$v['check'].','.$v['chresult'].',';
                $str .= $v['ta'].','.$v['chectime']."\n";
            }
            $r = rand('1000','9999');
            $str = iconv('utf-8','gb2312//ignore',$str);
            $filename = date('Ymd').$r.'.csv';
            export_csv($filename,$str);
            die;
        }
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function casua(){//抽检状态
        $data['id'] = input('id');
        $data['check'] = input('check');
        if($data['check'] == 1){
            $log['class'] = '抽检状态为抽检';
        }else{
            $log['class'] = '抽检状态为不抽检';
        }
        $log['uid'] = session('id');
        $log['tid'] = $data['id'];
        $log['logtime'] = time();
        $log['remark'] = '';
        $this->log->add($log);
        $this->order->edit($data);
        $this->redirect('orexam','id='.$data['id']);
    }

    public function orlog(){//任务日志
        $id = input('id');
        $msg['id'] = $id;
        $log = $this->log->getall("tid = $id");
        foreach ($log as $k=>$v){
            $log[$k]['uid'] = $this->admin->getonly($v['uid']);
        }
        $this->assign('msg',$msg);
        $this->assign('log',$log);
        return $this->fetch();
    }

    public function fullper(){//全职管理
        $msg = $this->ta->getall("*",'class = 1');
        $biao = $this->task->getone(10);
        $biao['day'] = date('t',time()) - date('d',time());
        $one = strtotime(date('Y-m-01', strtotime('-1 month')));
        $last = strtotime(date('Y-m-t 23:59:59', strtotime('-1 month')));
//        echo $one.'<br />'.$last;die;
        foreach ($msg as $k => $v){
            $msg[$k]['cha'] = $biao['lastid'] - $v['monji'];
            $msg[$k]['otpop'] = $v['phpop'] + $v['epop'];
            $per = $this->per->getall("ta = '$v[id]' and time > '$one' and time < '$last'");
            $msg[$k]['lastji'] = 0;
            foreach ($per as $p){
                $msg[$k]['lastji'] += $p['jidian'];
            }
        }
//        echo '<pre>';
//        print_r($msg);die;
        $this->assign('biao',$biao);
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function partper(){//兼职管理
        $msg = $this->ta->getall('*','class = 2');
        $this->assign('msg',$msg);
        return $this->fetch();
    }

    public function tadel(){//全职TA绩效详情
        $id = input('id');
        $per = $this->per->getall("ta = $id");
        foreach ($per as $k=>$v){
            $per[$k]['ta'] = $this->ta->getonly($v['ta']);
        }
        $this->assign('per',$per);
        $this->assign('id',$id);
        return $this->fetch();
    }

    public function parta(){//兼职TA绩效详情
        $id = input('id');
        $per = $this->per->getall("ta = $id");
        foreach ($per as $k=>$v){
            $per[$k]['ta'] = $this->ta->getonly($v['ta']);
        }
        $this->assign('per',$per);
        $this->assign('id',$id);
        return $this->fetch();
    }

    public function jidao(){//绩点导出
        $de = input('post.');
        $time1 = strtotime($de['time1']);
        $time2 = strtotime($de['time2']);
        if($time2 <= $time1){
            $this->error('请选择正确的时间段！');
        }
        $msg = $this->per->getall("ta = '$de[id]' and time > $time1 and time < $time2");

        $str = "TA人员,任务/课程编号,操作时间,绩效点加减\n";
        foreach($msg as $k => $v){
            $str .= $this->ta->getonly($v['ta']);
            $str .=  ','.$v['tid'].",";
            $str .= date('Y-m-d H:i:s',$v['time']);
            $str .= ','.$v['jidian']."\n";
        }
        $r = rand('1000','9999');
        $str = iconv('utf-8','gb2312//ignore',$str);
        $filename = date('Ymd').$r.'.csv';
        export_csv($filename,$str);
        die;
    }

    public function chdao(){//拆课表导出
        $id = input('id');
        $msg = $this->chai->getall("cid = '$id'");

        $str = "ID,课程ID,TA人员,任务编号,任务名称,比重,开始日期,结束时间\n";
        foreach($msg as $k => $v){
            $str .= $v['id'].','.$v['cid'].',';
            $str .= $this->ta->getonly($v['ta']);
            $str .= ','.$v['taskid'].",".$v['tasktitle'].','.$v['percent'].',';
            $str .= $v['startdate'].','.$v['enddate'].','."\n";
        }
        $str = iconv('utf-8','gb2312//ignore',$str);
        $r = rand('1000','9999');
        $filename = date('md').$r.'.csv';
        export_csv($filename,$str);
        die;
    }

    public function xuedao(){//学期奖导出
        $id = input('id');
        $msg = $this->term->getall("cid = '$id'");
//        echo '<pre>';
//        print_r($msg);die;
        $str = "ID,课程ID,TA人员,时间节点,等级,备注,绩点数\n";
        foreach($msg as $k => $v){
            $str .= $v['id'].','.$v['cid'].',';
            $str .= $this->ta->getonly($v['ta']);
            $str .= ','.$v['date'].",".$v['level'].','.$v['remark'].',';
            $str .= $v['jidian']."\n";
        }
        $str = iconv('utf-8','gb2312//ignore',$str);
        $r = rand('1000','9999');
        $filename = date('md').$r.'.csv';
        export_csv($filename,$str);
        die;
    }
}