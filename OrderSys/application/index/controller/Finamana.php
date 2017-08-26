<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/18
 * Time: 17:24
 */

namespace app\index\controller;


class Finamana extends Backstage
{
    public function index(){
        $data = $this->order->getpage();
        $msg = $data->items();
        $page = $data->render();
        foreach($msg as $k => $v){
            $diff = ($v['zontotal'] - $v['shitotal'])/$v['zontotal'] ;
            if($diff == 0){
                $msg[$k]['diff'] = $diff;
            }else{
                $diff = $diff*100;
                $msg[$k]['diff'] = number_format($diff,2).'%';
            }
        }

        if(input('daochu') == 1){
            $str = "任务编号,用户编号,成交时间,销售人员,任务标题,报价组,产品数量,付款状态,";
            $str .= "附加价格,附加备注,折扣价格,折扣备注,实付总价,差异,任务许可\n";
            foreach($msg as $k => $v){
                $str .= $v['orderid'].",".$v['userid'].",";
                $str .= date('Y-m-d H:i:s',$v['ordertime']);
                $str .= ",".$v['saleper'].",".$v['tasktitle'].",".$v['quotgr'].",".$v['ductnum'].",".$v['paystatus'].",";
                $str .= $v['addmoney'].",".$v['addmark'].",";
                $str .= $v['discount'].",".$v['discomar'].",".$v['shitotal'].",".$v['diff'].",".$v['misslic']."\n";
            }
            $str = iconv('utf-8','gb2312//ignore',$str);
            $filename = date('Ymd').'.csv';
            export_csv($filename,$str);
            die;
        }
        $this->assign('msg',$msg);
        $this->assign('page',$page);
        return $this->fetch();
    }

    public function payrcod(){
        $pay = $this->pay->getall();
        $this->assign('pay',$pay);
        return $this->fetch();
    }

    public function customize(){
        $post = input('post.');
        $msg = array();
        if(request()->isPost()){
            $str1 = strtotime($post['time1']);
            $str2 = strtotime($post['time2']);
            $msg = $this->order->getsel("ordertime BETWEEN '$str1' AND '$str2' and zontotal !=0 ");
            foreach($msg as $k => $v){
                $diff = ($v['zontotal'] - $v['shitotal'])/$v['zontotal'] ;
                if($diff == 0){
                    $msg[$k]['diff'] = $diff;
                }else{
                    $diff = $diff*100;
                    $msg[$k]['diff'] = number_format($diff,2).'%';
                }
            }
            $this->assign('flag',1);
            $this->assign('time1',$str1);
            $this->assign('time2',$str2);

        }else{
            $this->assign('flag',0);
        }

        $this->assign('msg',$msg);
//        $this->assign('post',$post);
        return $this->fetch();
    }

    public function last(){
        $yester1 = date('Y-m-d 18:0:0',strtotime('-1day'));
        $shi1 = strtotime($yester1);//昨天下午六点
        if(date('H') >= 18){
            $yester2 = date('Y-m-d 18:0:0');
            $shi2 = strtotime($yester2);//今天天下午六点
        }else{
            $shi2 = time();
        }
        $order = $this->order->getsel("ordertime BETWEEN '$shi1' AND '$shi2' and zontotal !=0 ");
        foreach($order as $k => $v){

            $diff = ($v['zontotal'] - $v['shitotal'])/$v['zontotal'] ;
            if($diff == 0){
                $order[$k]['diff'] = $diff;
            }else{
                $diff = $diff*100;
                $order[$k]['diff'] = number_format($diff,2).'%';
            }
        }
        $this->assign('msg',$order);
        return $this->fetch();
    }

    public function tailstatus(){
        $id = input('id');
        //echo '<pre>';
        $or = $this->order->getone("id = $id");
        $pay = $this->pay->getone("orderid = '$or[orderid]'");

        $this->assign('pay',$pay);
        $this->assign('or',$or);
        return $this->fetch();
    }

    public function daopay(){
        $msg = $this->pay->getall();
        $str = "交易编号,付款类型,任务编号,用户编号,支付账户,支付金额,支付时间,交易备注\n";
        foreach ($msg as $k => $v){
            $str .= $v['payid'].",".$v['paytype'].",".$v['orderid'].",".$v['userid'].",".$v['payacc'].",".$v['paymoney'].",";
            $str .= date('Y-m-d H:i:s',$v['paytime']);
            $str .= ",".$v['paymark']."\n";
        }
        $str = iconv('utf-8','gb2312',$str);
        $filename = date('Ymd').'.csv';
        export_csv($filename,$str);
    }

    public function chang(){
        $post = input('post.');
        print_r($post);
        $this->order->edit($post);
        //echo 1;
    }
}