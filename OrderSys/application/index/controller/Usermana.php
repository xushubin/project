<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:24
 */

namespace app\index\controller;


class Usermana extends Backstage
{
    /**
     * @return mixed
     */
    public function index(){
        $userid = input('userid') ;
        if($userid == ''){
            $this->assign('flag','0');
            $this->assign('or','0');
            $this->assign('fu','0');
        }else{
            $this->assign('flag','1');
            $order = $this->order->getmsg($userid);
            $pay = $this->pay->getmsg($userid);
            if(empty($order)){
                $this->assign('or','0');
                $this->assign('orcou','0');
            }else{
                $orcou = count($order);
                $this->assign('or','1');
                $this->assign('orcou',$orcou);
                $this->assign('order',$order);
            }
            if(empty($pay)){
                $this->assign('fu','0');
                $this->assign('fucou','0');
            }else{
                $fucou = count($order);
                $this->assign('fucou',$fucou);
                $this->assign('pay',$pay);
                $this->assign('fu','1');
            }
        }
        $this->assign('userid',$userid);
        return $this->fetch();
    }

    public function createuser(){
        $data['qqid'] = input('qqid') ;
        $data['qqid'] = $data['qqid'] == '无' ? '' : $data['qqid'] ;
        $data['wechatid'] = input('wechatid');
        $data['wechatid'] = $data['wechatid'] == '无' ? '' : $data['wechatid'] ;
        //echo '<pre>';
        //print_r($data);
        $this->assign('data',$data);
        return $this->fetch();
    }

}