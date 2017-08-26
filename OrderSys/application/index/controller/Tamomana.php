<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:24
 */

namespace app\index\controller;


class Tamomana extends Backstage
{
    public function index(){
        $order = $this->order->getamsg();
        $d = input('d') == '' ? 5 :input('d');
        $now = date('Y-m-d');
        $da5 = date('Y-m-d',strtotime('+5 day'));
        $da15 = date('Y-m-d',strtotime('+15 day'));
        $da30 = date('Y-m-d',strtotime('+30 day'));
        foreach ($order as $k => $v){
            if($d == 5){
                $pay = $this->pay->getms("orderid = '$v[orderid]' AND lastdate BETWEEN '$now' AND '$da5' ");
            }else if($d == 15){
                $pay = $this->pay->getms("orderid = '$v[orderid]' AND lastdate BETWEEN '$now' AND '$da15' ");
            }else if($d == 30){
                $pay = $this->pay->getms("orderid = '$v[orderid]' AND lastdate BETWEEN '$now' AND '$da30' ");
            }else if($d == -1){
                $pay = $this->pay->getms("orderid = '$v[orderid]' AND lastdate < '$now'");
            }else{
                $pay = $this->pay->getms("orderid = '$v[orderid]' AND lastdate > '$now'");

            }
            if(empty($pay) && $d != 'all'){
                unset($order[$k]);
                continue;
            }
            $order[$k]['paymark'] = $pay['paymark'];
            $order[$k]['lastdate'] = $pay['lastdate'];
        }

        if($d == 'all'){
            $oth = "全部的尾款";
        }else if($d == '-1') {
            $oth = "逾期的尾款";
        }else{
            $oth = $d . "日內到期的尾款";
        }

        $this->assign('pay',$order);
        $this->assign('d',$d);
        $this->assign('oth',$oth);
        return $this->fetch();
    }

    public function paymentHistory(){
        $post = input('post.');
        $this->order->edit($post);
        $msg = $this->order->getid($post['id']);
        $pay = $this->pay->getone("orderid = '$msg[orderid]'");
        if(empty($pay)){
            $pay['payentry'] = 1;
            $pay['payid'] = $msg['orderid'].'1';
        }
        $this->assign('id',$post['id']);
        $this->assign('msg',$msg);
        $this->assign('pay',$pay);
        return $this->fetch();
    }

    public function payhis(){
        $id = input('id');
        $msg = $this->order->getid($id);
        $pay = $this->pay->geto("$msg[orderid]");

        foreach ($pay as $v){
            $msg['shitotal'] = $msg['shitotal'] - $v['paymoney'];
            $add[] = $v['payentry'];
        }

        $p['payentry'] = max($add)+1;
        $p['payid'] = $msg['orderid'].$p['payentry'];

        $this->assign('id',$id);
        $this->assign('msg',$msg);
        $this->assign('pay',$p);
        return $this->fetch('paymentHistory');
    }

    public function payment(){
        $post = input('post.');
        $files = request()->file('file');
        foreach($files as $k => $file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $post['payimg'.$k] = $info->getSaveName();
            }
        }
        if($post['lastdate'] == ''){
            $post['lastdate'] = date('Y-m-d');
        }
        $post['paytime'] = time();
        $post['remain'] = $post['shitotal']-$post['paymoney'];
        $msg['orderid'] = $post['orderid'];
        $msg['id'] = $post['id'];
        $msg['paystatus'] = $post['paystatus'];
        $msg['remain'] = $post['remain'];

        unset($post['id']);
        unset($post['shitotal']);
        unset($post['remain']);

        $this->order->edit($msg);
        $this->pay->add($post);
         $this->success('付款记录添加成功',url('taskcreate/index'));

    }
}
