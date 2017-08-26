<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21
 * Time: 14:36
 */

namespace app\index\controller;
use rongyun\ServerAPI;

class Talk extends Home
{
    public function inde(){//聊天页面
        $cid = input('id');
        $hid = session('id');
        $class = session('class');
        if($class == 1){//学生
            $chlist = $this->task->join("teacher ta","t.teid = ta.id","t.sid = $hid","ta.id,ta.name");
        }else{//老师
            $chlist = $this->task->join("student ta","t.sid = ta.id","t.teid = $hid","ta.id,ta.name");
        }
        foreach ($chlist as $v) {
            $v = join(",",$v);
            $temp[] = $v;
        }
        $temp = array_unique($temp);
        foreach ($temp as $k => $v) {
            $temp[$k] = explode(",",$v);
        }
        $this->assign('title','沟通交流页面');
        $this->assign('temp',$temp);
        $this->assign('id',$cid);
        return $this->fetch();
    }

    public function index(){//聊天页面·真
        $this->assign('url',$_SERVER['HTTP_HOST']);
        $chatid = input('id');
        $appKey = config('APP_KEY');
        $appSecret = config('APP_SECRET');
        $rongYun = new ServerAPI( $appKey, $appSecret );
        $class = session('class');
        $id = session('id');
        if($class == 1){//学生
            $user = $this->stud->getone("id = $id");
            $chat = $this->tea->getone("id = $chatid","id,name,avatar");
            $chlist = $this->task->join("teacher ta","t.teid = ta.id","t.sid = $id","ta.id,ta.name");
        }else{//老师
            $user = $this->tea->getone("id = $id","id,name,avatar");
            $chat = $this->stud->getone("id = $chatid");
            $chlist = $this->task->join("student ta","t.sid = ta.id","t.teid = $id","ta.id,ta.name");
        }
        foreach ($chlist as $v) {
            $v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
            $temp[] = $v;
        }
        $temp = array_unique($temp);
        foreach ($temp as $k => $v) {
            $temp[$k] = explode(",",$v); //再将拆开的数组重新组装
        }
        $token = $rongYun->getToken($user['id'], $user['name'], $user['avatar']);
        $token = json_decode( $token, true )['token'];
        $this->assign([
            'token' => $token,
            'chat' => $chat,
            'temp' => $temp
        ]);
        return $this->fetch();
    }

    public function userinfo(){//获取用户信息
        $id = input('id');
        $sid = session('id');
        $class = session('class');
        if($id == $sid){
            if($class == 1){
                $return = $this->stud->getone("id = $id","id,name,avatar");
            }else{
                $return = $this->tea->getone("id = $id","id,name,avatar");
            }
        }else{
            if($class == 1){
                $return = $this->tea->getone("id = $id","id,name,avatar");
            }else{
                $return = $this->stud->getone("id = $id","id,name,avatar");
            }
        }
        return json( $return );
    }


    public function record(){//记录聊天记录
        $data['text'] = input('msg');
        $data['receiveid'] = input('id');
        $data['sendid'] = session('id');
        if($data['sendid'] > 10000){//当前用户学生
            $data['receivename'] = $this->tea->getonly($data['receiveid'],'name');
            $data['sendname'] = $this->stud->getonly($data['sendid']);
        }else{
            $data['receivename'] = $this->stud->getonly($data['receiveid']);
            $data['sendname'] = $this->tea->getonly($data['sendid'],'name');
        }
        $this->record->add($data);
    }

    public function histro(){//显示历史记录
        $sid = input('id');
        $rid = session('id');
        if($sid == ''){
            echo '请选择需要查看历史聊天记录的人员！';
            die;
        }
        if($rid > 10000){//当前用户学生
            $data['sendname'] = $this->stud->getonly($rid);
            $data['receivename'] = $this->tea->getonly($sid,'name');
        }else{
            $data['sendname'] = $this->tea->getonly($rid,'name');
            $data['receivename'] = $this->stud->getonly($sid);
        }
        $msg = $this->record->getall("(sendid = '$sid' and receiveid = '$rid') or (sendid = '$rid' and receiveid = '$sid')");
        $this->assign('count',count($msg));
        $this->assign('msg',$msg);
        $this->assign('data',$data);
        return $this->fetch();
    }
}