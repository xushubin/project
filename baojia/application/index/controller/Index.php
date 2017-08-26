<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    protected $clas;
    protected $product;
    protected $from;
    protected $profess;
    protected $ductpri;
    protected $baojia;

    public function __construct()
    {
        parent::__construct();
        $this->clas = new \app\index\model\Clas();
        $this->product = new \app\index\model\Product();
        $this->from = new \app\index\model\From();
        $this->profess = new \app\index\model\Profess();
        $this->ductpri = new \app\index\model\Ductpri();
        $this->baojia = new \app\index\model\Baojia();
    }

    public function index(){
        $id = input('id');
        $profess = [];
        $baojia['clas'] = 0;
        $bj = 0;
        if($id != ''){
            //echo $id;
            $baojia = $this->baojia->getone($id);
            $profess = $this->profess->getmsg($baojia['clas']);
            $bj = $baojia['profess'];
        }
        $msg = $this->clas->getmsg();
        $this->assign('msg',$msg);
        $this->assign('id',$id);
        $this->assign('clas',$baojia['clas']);
        $this->assign('profess',$profess);
        $this->assign('baojia',$bj);
        return $this->fetch();
    }

    public function addone(){
        $post = input('post.');
        $id = input('id');
        $baojia = [
            'product'=>'',
            'from'=>'',
            'dead'=>'',
            'dtime'=>'',
            'grade'=>'2',
            'task'=>'',
            'percent'=>''
        ];
        //echo $id.'<br />';
        if($id == ''){
            $id = $this->baojia->add($post);
        }else{
            $this->baojia->edit($post);
            $baojia = $this->baojia->getone($id);
        }
        //print_r($baojia);
        //die;
        $msg = $this->profess->getkey($post['profess']);
        $msg1 = $this->from->getmsg();
        $msg2 = $this->product->getmsg();
       // print_r($msg);
        //echo $id;
        $this->assign('id',$id);
        $this->assign('baojia',$baojia);
        $this->assign('msg',$msg);
        $this->assign('msg1',$msg1);
        $this->assign('msg2',$msg2);
        return $this->fetch();
    }

    public function addtwo(){
        $post = input('post.');
//        echo '<pre>';
//         print_r($post);die;
        $this->baojia->edit($post);
        $baojia = $this->baojia->getone($post['id']);

        $assess = unserialize($baojia['assess']);
        $cou = count($assess);
        for($i=1;$i<=$cou;$i++){
            $ass[$i] = $assess['assess'.$i];
        }

        $duct = $this->ductpri->getmsg();
        $this->assign('duct',$duct);
        $this->assign('assess',$ass);

        $this->assign('id',$post['id']);
        return $this->fetch();
    }

    public function addthree(){
        $post = input('post.');
        $id = $post['id'];
        array_pop($post);
        $se = serialize($post);
        $data['id'] = $id;
        $data['assess'] = $se;
        $this->baojia->edit($data);

        $this->assign('id',$id);
        //echo '<pre>';
       // print_r($post);
        return $this->fetch();
    }

    public function show(){
        $post = input('post.');
        //echo '<pre>';
        //print_r($post);
        $bj= $this->baojia->getone($post['id']);
        //print_r($bj);
        $time = strtotime($bj['dtime']);

        $m =gettime($bj['dead'],$time);
        //echo '时间基数'.$m.'<br />';
        $fesskey =  $this->profess->getkey($bj['profess']);
       // echo '课程基数'.$fesskey['key'].'<br />';
        $ductkey = $this->product->getkey($bj['product']);
        //echo '产品类型基数'.$ductkey['key'].'<br />';
        $fromkey = $this->from->getkey($bj['from']);
        //echo '形式基数'.$fromkey['key'].'<br />';
        if($bj['grade'] == 1){
            $gradekey = 1.5;
        }else{
            $gradekey = 1;
        }
       // echo '成绩要求基数'.$gradekey.'<br />';
        $key = $fesskey['key']*$ductkey['key']*$fromkey['key']*$gradekey;
        //echo '基数积'.$key.'<br />';
        $assess = unserialize($bj['assess']);
        $total = 0;
        $msg =  $this->ductpri->getmsg();
        //print_r($assess);
        foreach ($msg as $v){
            $k = 'assess'.$v['id'];
            if($assess[$k] != 0){
                $mag[$v['id']]['name'] = $v['name'];
                $price = $key*$v['key'];
                $mag[$v['id']]['price'] = number_format($price,2);
                $mag[$v['id']]['num'] = $assess[$k];
                $t = $mag[$v['id']]['price']*$mag[$v['id']]['num'];
                $mag[$v['id']]['total'] = number_format($t,2);;
                $total += $mag[$v['id']]['total'];
            }
        }
       // print_r($mag);
        $jiaji = $total*$m;//加急费用
        $jiaji = number_format($jiaji,2);
        $youhui = ($post['privi']+$post['privi2']+$post['privi3']+$post['privi4']).'.00';//优惠
        $zongjia = $total+$jiaji-$youhui;//总价
        if($bj['task'] != '' && $bj['percent'] != ''){
            $totalper = (($bj['percent']/100)*$fesskey['price']).'.00';
            $zongper = $totalper+$jiaji-$youhui;
            $zongper = number_format($zongper,2);
            $this->assign('totalper',$totalper);
            $this->assign('zongper',$zongper);
            $this->assign('no','1');
        }else{
            $this->assign('no','0');
        }

        $this->assign('pro',$fesskey);
        $this->assign('mag',$mag);
        $this->assign('jiaji',$jiaji);
        $this->assign('youhui',$youhui);
        $zongjia = number_format($zongjia,2);
        $this->assign('zongjia',$zongjia);
        $this->assign('name',$bj['task']);

        return $this->fetch();
    }

    public function index1()
    {
        $msg1 = $this->clas->getmsg();
        $msg2 = $this->ductpri->getmsg();
        $msg4 = $this->from->getmsg();
        $msg5 = $this->product->getmsg();
        $this->assign('msg1',$msg1);
        $this->assign('msg2',$msg2);
        $this->assign('msg4',$msg4);
        $this->assign('msg5',$msg5);
        return $this->fetch();
    }

    public function showbjd(){
        $post = input('post.');
//        echo '<pre>';
//        print_r($post);
        $time = strtotime($post['dtime']);
        $m =gettime($post['dead'],$time);

        $fesskey =  $this->profess->getkey($post['profess']);
        //echo '课程基数'.$fesskey['key'].'<br />';

        $ductkey = $this->product->getkey($post['product']);
       // echo '产品类型基数'.$ductkey['key'].'<br />';

        $fromkey = $this->from->getkey($post['from']);
       // echo '形式基数'.$fromkey['key'].'<br />';
        //echo '时间基数'.$m.'<br />';
        if($post['grade'] == 1){
            $gradekey = 1.5;
        }else{
            $gradekey = 1;
        }
        //echo '成绩要求基数'.$gradekey.'<br />';
        $key = $fesskey['key']*$ductkey['key']*$fromkey['key']*$gradekey;
        //echo '基数积'.$key.'<br />';

        $msg =  $this->ductpri->getmsg();
        //print_r($msg);
        $total = 0;
        foreach ($msg as $v){
            $k = 'assess'.$v['id'];
            if($post[$k] != 0){
                $mag[$v['id']]['name'] = $v['name'];
                $price = $key*$v['key'];
                $mag[$v['id']]['price'] = number_format($price,2);
                $mag[$v['id']]['num'] = $post[$k];
                $mag[$v['id']]['total'] = $mag[$v['id']]['price']*$mag[$v['id']]['num'];
                $total += $mag[$v['id']]['total'];
            }
        }
        $jiaji = $total*$m;//加急费用

        $jiaji = number_format($jiaji,2);

        $youhui = $post['privi']+$post['privi2']+$post['privi3']+$post['privi4'];//优惠
        $zongjia = $total+$jiaji-$youhui;//总价
        print_r($fesskey);
        if($post['task'] != '' && $post['percent'] != ''){
            $totalper = ($post['percent']/100)*$fesskey['price'];
            $zongper = $totalper+$jiaji-$youhui;
            $this->assign('totalper',$totalper);
            $this->assign('zongper',$zongper);
            $this->assign('no','1');
        }else{
            $this->assign('no','0');
        }
        $this->assign('pro',$fesskey);
        $this->assign('mag',$mag);
        $this->assign('jiaji',$jiaji);
        $this->assign('youhui',$youhui);
        $this->assign('zongjia',$zongjia);
        $this->assign('name',$post['task']);

        return $this->fetch();

    }

    public function getpro(){
        $pid = input('pid');
        $pro = new \app\index\model\Profess();
        $msg = $pro->getmsg($pid);
        //echo '<pre>';
       // print_r($msg);
        $rr = '';
        foreach($msg as $v){
            $rr .= "<option value=".$v['id'].">".$v['subject']."</option>";
        }
        echo $rr;
    }

    public function tiao(){
        $bj= $this->baojia->getone(26);
        //print_r($bj);
        //$time = strtotime($bj['dtime']);

       // $m =gettime($bj['dead'],$time);
        //echo '时间基数'.$m.'<br />';
        $fesskey =  $this->profess->getkey($bj['profess']);
        // echo '课程基数'.$fesskey['key'].'<br />';
        $ductkey = $this->product->getkey($bj['product']);
        //echo '产品类型基数'.$ductkey['key'].'<br />';
        $fromkey = $this->from->getkey($bj['from']);
        //echo '形式基数'.$fromkey['key'].'<br />';
        if($bj['grade'] == 1){
            $gradekey = 1.5;
        }else{
            $gradekey = 1;
        }
        // echo '成绩要求基数'.$gradekey.'<br />';
        $key = $fesskey['key']*$ductkey['key']*$fromkey['key']*$gradekey;
        //echo '基数积'.$key.'<br />'; 课程基数*产品类型基数*形式基数*成绩要求基数
        $assess = unserialize($bj['assess']);
        $total = 0;
        $msg =  $this->ductpri->getmsg();
        //print_r($assess);
        foreach ($msg as $v){
            $k = 'assess'.$v['id'];
            if($assess[$k] != 0){
                $mag[$v['id']]['name'] = $v['name'];
                $price = $key*$v['key'];
                $mag[$v['id']]['price'] = number_format($price,2);
                $mag[$v['id']]['num'] = $assess[$k];
                $t = $mag[$v['id']]['price']*$mag[$v['id']]['num'];
                $mag[$v['id']]['total'] = number_format($t,2);;
                $total += $mag[$v['id']]['total'];
            }
        }

        // print_r($mag);
        //$jiaji = $total*$m;//加急费用
        //$jiaji = number_format($jiaji,2);

        $this->assign('pro',$fesskey);
        $this->assign('mag',$mag);
        $zongjia = number_format($total,2);
        $this->assign('zongjia',$zongjia);
        $m = time();
        //echo date('Y-m-d H:i',$m).'<br />';
        for($a = 1;$a<=5;$a++){
            $i = $a-1;
            //大于36
            $t = $m+(24-$i)*3600;
            if($a == 5){
                $t = $m+36*3600;
            }
            $data['36'][$a]['t'] = $t;
            //echo $t.'<br />';
            //echo date('Y-m-d H:i',$t).'<br />';
            $data['36'][$a]['m'] = gettime($a,$t);

            //24  36
            $t = $m+(12-$i)*3600;
            if($a == 5){
                $t = $m+24*3600;
            }
            $data['24'][$a]['t'] = $t;
           // echo $t.'<br />';
            //echo date('Y-m-d H:i',$t).'<br />';
            $data['24'][$a]['m'] = gettime($a,$t);

            //12  24
            $t = $m+(0-$i)*3600;
            if($a == 5){
                $t = $m+12*3600;
            }
            $data['12'][$a]['t'] = $t;
            // echo $t.'<br />';
            //echo date('Y-m-d H:i',$t).'<br />';
            $data['12'][$a]['m'] = gettime($a,$t);

            //6  12
            $t = $m+(-6-$i)*3600;
            if($a == 5){
                $t = $m+6*3600;
            }
            $data['6'][$a]['t'] = $t;
            // echo $t.'<br />';
            //echo date('Y-m-d H:i',$t).'<br />';
            $data['6'][$a]['m'] = gettime($a,$t);

            //0  6
            $t = $m+(-12-$i)*3600;
            if($a == 5){
                $t = $m;
            }
            $data['0'][$a]['t'] = $t;
            // echo $t.'<br />';
            //echo date('Y-m-d H:i',$t).'<br />';
            $data['0'][$a]['m'] = gettime($a,$t);
        }
        date_default_timezone_set('Asia/Shanghai');

//echo '<pre>';
//print_r($data);
        $this->assign('data',$data);
        return $this->fetch();
    }
}
