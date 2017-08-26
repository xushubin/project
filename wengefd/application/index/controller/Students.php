<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/5
 * Time: 14:05
 */

namespace app\index\controller;


class Students extends Home
{
    public function __construct()
    {
        parent::__construct();
        if(!session('?name')){
            $this->error('请先登录','/?login');
        }
    }

    public function inde(){
        $id = session('id');
        $data = $this->task->getpage8("sid = $id and teid != 0");
        $msg = $data->items();
        $page = $data->render();

        if(empty($msg)){
            $this->assign('none','0');
        }else{
            $this->assign('none','1');
            foreach ($msg as $k=>$v){
                $msg[$k]['sid'] = $this->stud->getonly($v['sid']);
                $msg[$k]['taskstatus'] = $this->stat->getonly($v['taskstatus']);
                if($v['taskstatus'] == 2){
                    $msg[$k]['href'] = url('pay','id='.$v['id']);
                }else if($v['taskstatus'] >= 5 && $v['taskstatus'] <= 24){
                    $msg[$k]['href'] = url('acce','id='.$v['id']);
                }else if($v['taskstatus'] == 25){
                    $msg[$k]['href'] = url('appraise','id='.$v['id'].'&teid='.$v['teid']);
                }else{
                    $msg[$k]['href'] ="javascript:;";
                }
                $un = unserialize($v['attafile']);
                if(is_array($un)){
                    $msg[$k]['attafile'] = $un;
                }else{
                    $msg[$k]['attafile'] = array();
                }

            }
        }

//        print_r($msg);
        $this->assign('msg',$msg);
        $this->assign('page',$page);
        $this->assign('title','任务列表');
        return $this->fetch();
    }

    public function pay(){
        $id = input('id');
        $msg = $this->task->getone("id = $id");
        $pay = $this->pay->getone("tid = $id");
        $msg['teid'] = $this->tea->getonly($msg['teid'],'name');
        $msg['sid'] = $this->stud->getonly($msg['sid']);
        $this->assign('title','付款');
        $this->assign('msg',$msg);
        $this->assign('pay',$pay);
        return $this->fetch();
    }

    public function payment(){
        $id = input('id');
        $pay = input('pay');
        $tid = input('tid');
        $mon = $this->task->joins('teacher ta','t.teid = ta.id',"t.id = $tid",'ta.allmoney,ta.id,ta.monthmon,ta.lasttime');
        $add = $this->pay->getonly($id,'total');
        $ta['allmoney'] = $mon['allmoney']+$add;
        $ta['id'] = $mon['id'];
        $n1 = date('n',$mon['lasttime']);
        $n2 = date('n',time());
        if($n1 == $n2){
            $ta['monthmon'] = $mon['monthmon']+$add;
        }else{
            $ta['monthmon'] = $add;
        }
        $ta['lasttime'] = time();
        $data['taskstatus'] = 4;
        $data['id'] = $tid;
        $payment['id'] = $id;
        $payment['paystatus'] = 1;
        $payment['payth'] = $pay;
        $this->task->edit($data);
        $this->tea->edit($ta);
        $this->pay->edit($payment);
        $this->success('付款成功！',url('inde'));
    }

    public function acce(){
        $id = input('id');
        $teav = $this->task->getone("id = $id");
        $stud = $this->stud->getone("id = '$teav[sid]'");
        $un = unserialize($teav['attafile']);
        if(is_array($un)){
            $teav['attafile'] = $un;
        }else{
            $teav['attafile'] = array();
        }
        $msg = $this->sch->getall("tid = $id");
        if(empty($msg)){
            $this->assign('flag','0');
            $teav['number'] = 0;
        }else{
            $c = count($msg);
            $ms = $msg;
            for ($i=1;$i<=$c;$i++){
                $msg[$i] = $ms[$i-1];
            }
            unset($msg[0]);
            $this->assign('flag','1');
            $num = end($msg);
            $teav['number'] = $num['number']+1;
            $this->assign('msg',$msg);
        }
        $ts = $this->task->getonly($id,'taskstatus');
        if($ts%2 == 0){
            $this->assign('ts','0');
        }else{
            $this->assign('ts','1');
        }
//        echo '<pre>';
//        print_r($teav);
        $this->assign('teav',$teav);
        $this->assign('stud',$stud);
        $this->assign('title','任务进度');
        return $this->fetch();
    }

    public function teacherlist(){//老师列表
        $where = "is_ok = 1";
        $data = $this->tea->getpa1($where);
        $page = $data->render();
        $msg = $data->items();
        $this->assign('msg',$msg);
        $this->assign('page',$page);
        $this->assign('title','老师列表');
        return $this->fetch();
    }

    public function seach(){
        $post = input('post.');
        $id = input('id');

        $files = request()->file('files');
        if($files) {
            foreach ($files as $file) {
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    $post['attafile'][] = $info->getSaveName();
                }
            }
            $post['attafile'] = serialize($post['attafile']);
        }
        $name = session('name');
        $name = substr($name,9);

        if($post['course'] == 1) {
            $post['title'] = $name . $post['tutoty'] . '语文辅导';
        }elseif ($post['course'] == 2) {
            $post['title'] = $name . $post['tutoty'] . '数学辅导';
        }else{
            $post['title'] = $name.$post['tutoty'].'英语辅导';
        }
        $post['sid'] = session('id');
        $post['teid'] = $id;
        $post['taskstatus'] = 1;
        $pr = $this->tea->getone("id = $id");
        $msg = unserialize($pr['tutotype']);
        foreach ($msg as $v){
            if($v[0] == $post['tutoty']){
                $post['price'] = $v[1];
                //$pr['price'] = $v[1];
            }
        }
        $this->task->add($post);
        $this->success('辅导需求已提交给老师，请耐心等待老师确认订单！',url('inde'));
        //$msg = $this->task->join("teacher ta","t.teid = ta.id","t.teid = $id and t.taskstatus = 27","t.id,t.title,t.sid,t.pj,ta.name,ta.avatar");
//        if(count($msg) == 0){
//            $this->assign('fl','0');
//        }else{
//            $this->assign('fl','1');
//        }
//        $this->assign('msg',$msg);
//        $this->assign('title','沟通页面');
//        $this->assign('teav',$pr);
//        $this->assign('tit',$post['title']);
//        $this->assign('teid',$id);
//        return $this->fetch();

    }

    public function process(){
        $po = input('post.');
        $file = request()->file('files');
        //echo '<pre>';
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
            $po['file'] = $info->getSaveName();
        }else{
            $this->error('文件上传失败');
        }
        $po['time'] = date('Y-m-d',time());
        $this->sch->add($po);
        $this->task->setinc($po['tid']);
        $this->success('文件上传成功',url('user/redirec'));
    }

    public function satisfied(){//学生满意答案
        $id = input('id');//sch表id
        $tid = input('tid');//任务id
        $data['taskstatus'] = 25;
        $data['time'] = time();
        $data['id'] = $tid;
        $this->task->edit($data);
        $te = $this->task->getone("id = $tid");
        $this->tea->setinc($te['teid']);
        $msg = $this->task->count("teid = '$te[teid]' and sid = '$te[sid]' and taskstatus > 24");
        if($msg == 1){
            $this->tea->setnum($te['teid']);
        }
        $ch['check'] = 1;
        $ch['id'] = $id;
        $this->sch->edit($ch);
        $this->success('订单处理成功',url('user/redirec'));
    }

    public function edit(){
        $po = input('post.');
        $num = $this->sch->getonly($po['id']);
        $ed = $this->task->getonly($po['tid'],'editnum');
        if($num == $ed){
            $da['taskstatus'] = 26;
            $da['id'] = $po['tid'];
            $this->task->edit($da);
        }else{
            $this->task->setinc($po['tid']);
        }
        $po['check'] = 2;
        $this->sch->edit($po);
        $this->success('修改意见提交成功',url('user/redirec'));
    }

    public function appraise(){
        $id = input('id');
        $teid = input('teid');
        $this->assign('id',$id);
        $v = $this->tea->getone("id = $teid");
        $this->assign('teid',$teid);
        $this->assign('v',$v);
        $this->assign('title','订单评价');
        return $this->fetch();
    }

    public function appra(){
        $po = input('post.');
        $po['taskstatus'] = 27;
        $po['time'] = time();
        $this->task->edit($po);
        $msg = $this->tea->getone("id = '$po[teid]'",'levscor,tiscor');
        $msg['levscor'] = ($msg['levscor']+$po['levscor'])/2;
        $msg['tiscor'] = ($msg['tiscor']+$po['timscor'])/2;
        $msg['id'] = $po['teid'];
        $this->tea->edit($msg);
        $this->success('评价提交成功',url('user/redirec'));
    }
}