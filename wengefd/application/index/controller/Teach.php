<?php
namespace app\index\controller;


class Teach extends Home
{
    public function __construct()
    {
        parent::__construct();
        if(!session('?name')){
            $this->error('请先登录','/?login');
        }
    }

    public function inde(){//老师任务列表
        $id = session('id');
        $data = $this->task->getpage8("teid = $id");
        $msg = $data->items();
        $page = $data->render();
        if(empty($msg)){
            $this->assign('none','0');
        }else {
            $this->assign('none', '1');
            foreach ($msg as $k => $v) {
                $msg[$k]['stid'] = $this->stud->getonly($v['sid']);
                $msg[$k]['taskstatus'] = $this->stat->getonly($v['taskstatus']);
                if ($v['taskstatus'] == 1) {
                    $msg[$k]['href'] = url('plorder', 'id=' . $v['id']);
                } else if ($v['taskstatus'] >= 4 && $v['taskstatus'] <= 24) {
                    $msg[$k]['href'] = url('students/acce', 'id=' . $v['id']);
                } else {
                    $msg[$k]['href'] = "javascript:;";
                }
                $un = unserialize($v['attafile']);
                if (is_array($un)) {
                    $msg[$k]['attafile'] = $un;
                } else {
                    $msg[$k]['attafile'] = array();
                }

            }
        }
        $this->assign('msg',$msg);
        $this->assign('page',$page);
        $this->assign('title','任务列表');
        return $this->fetch();
    }

    public function findteacher(){//找老师
        $id = input('teid');
        if($id == ''){
            $this->assign('id',0);
        }else{
            $msg = $this->tea->getone("id = $id",'course,tutoty');
            $course = explode(" ",trim($msg['course']));
            $tutoty = explode(" ",trim($msg['tutoty']));
            $tuto = array();
            foreach($course as $v){
                if($v == '1'){
                    $tuto['1'] = '语文';
                }elseif($v == '2'){
                    $tuto['2'] = '数学';
                }elseif($v == '3'){
                    $tuto['3'] = '英语';
                }
            }

            $this->assign('id',$id);
            $this->assign('tutoty',$tutoty);
            $this->assign('course',$tuto);
        }
        $this->assign('title','找老师');
        return $this->fetch();
    }

    public function seach(){//匹配老师
        $post = input('post.');
        $where = "is_ok = 1 and course LIKE '%$post[course]%' AND tutoty LIKE '%$post[tutoty]%'";
        $msg = $this->tea->getall($where);
        if(empty($msg)){
            $this->error('没有找到相匹配的老师，请重新查询');
        }
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
        $post['taskstatus'] = 1;

        foreach ($msg as $k => $v){
            $a = unserialize($v['tutotype']);
            foreach ($a as $i){
                if($i[0] == $post['tutoty']){
                    $msg[$k]['price'] = $i[1];
                    $price[] = $i[1];
                    $post['price'] = $i[1];
                }
            }
        }
        array_multisort($price,SORT_ASC,$msg);
        $tid = $this->task->add($post);
        $n = $post['tutoty'].$post['course'].$tid;
        cache($n, $msg, 3600);

        $this->assign('msg',$msg);
        $this->assign('post',$post);
        $this->assign('tid',$tid);
        $this->assign('cou',count($msg));
        $this->assign('s',1);
        $this->assign('title','推荐老师');
        return $this->fetch();
    }

    public function sort(){//老师排序
        $post['course'] = input('course');
        $s = input('s');
        $tid = input('tid');
        $post['tutoty'] = input('tutoty');
        $n = $post['tutoty'].$post['course'].$tid;
        $msg = cache($n);
        foreach ($msg as $k => $v){
            if($s == 1){
                $sort[] = $v['price'];
            }else{
                $sort[] = $v['levscor'];
            }
        }

        if($s == 1){
            array_multisort($sort,SORT_ASC,$msg);
        }else{
            array_multisort($sort,SORT_DESC,$msg);
        }

        $this->assign('msg',$msg);
        $this->assign('post',$post);
        $this->assign('tid',$tid);
        $this->assign('cou',count($msg));
        $this->assign('s',$s);
        $this->assign('title','推荐老师');
        return $this->fetch('seach');
    }

    public function commun(){//沟通页面
        $id = input('id');
        $teid = input('teid');
        $data['teid'] = $teid;
        $data['id'] = $id;
        $this->task->edit($data);
        $this->success('辅导需求已提交给老师，请耐心等待老师确认订单！',url('students/inde'));
//        $teav = $this->tea->getone("id = $teid");
//        $tas = $this->task->getone("id = $id");
//        $msg = $this->task->join("teacher ta","t.teid = ta.id","t.teid = $teid and t.taskstatus = 27","t.id,t.title,t.sid,t.pj,ta.name,ta.avatar");
//        if(count($msg) == 0){
//            $this->assign('fl','0');
//        }else{
//            $this->assign('fl','1');
//        }
//        $teav['price'] = $tas['price'];
//        $this->assign('title','推荐老师');
//        $this->assign('msg',$msg);
//        $this->assign('teav',$teav);
//        $this->assign('id',$id);
//        $this->assign('teid',$teid);
//        $this->assign('tit',$tas);
//        return $this->fetch();
    }

    public function plorder(){//老师确认订单
        $id = input('id');
        $teav = $this->task->getone("id = $id");
        $teid = $teav['teid'];
        $col = $this->tea->getonly($teid,'modifynum');
//        echo $col;
        $this->assign('teav',$teav);
        $this->assign('col',$col);
        $this->assign('title','确认订单');
        $this->assign('id',$id);
        return $this->fetch();
    }

    public function payment(){//老师确认订单处理页面
        $post = input('post.');
        $data['id'] = $post['tid'];
        $data['taskstatus'] = 2;
        $data['editnum'] = $post['editnum'];
        $this->task->edit($data);
        unset($post['editnum']);
        $this->pay->add($post);
        $this->success('确认订单提交成功！',url('inde'));
    }

    public function finance(){//财务管理
        $this->assign('title','财务管理');
        $id = session('id');
        $te = $this->tea->getone("id = $id",'id,name,allmoney,monthmon,tasknum,studnum,avatar');

        $we = $this->task->count("teid = $id and taskstatus < 25");
        $this->assign('te',$te);
        $this->assign('we',$we);
        $this->assign('we',$we);
        return $this->fetch();
    }
}
