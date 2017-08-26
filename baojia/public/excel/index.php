<?php

if(!empty($_POST)){
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    header("Content-type: text/html; charset=utf-8");
    // echo '<pre>';
    //print_r($_FILES);
    $arr = explode('.',$_FILES['file']['name']);
    if($arr['1'] != 'xls'){
        echo '只能上传xls文件，请返回重新上传!';
    }
    $ran = rand(10000,99999).'.xls';
    move_uploaded_file($_FILES["file"]["tmp_name"], $ran);

    require_once 'excel.php';
    $data = new Spreadsheet_Excel_Reader($ran);

    $db_connect=mysqli_connect('localhost','root','123456') or die("Unable to connect to the MySQL!");
    mysqli_select_db($db_connect,'baojia');

    //$sql1 = "select * from profess where id = 5";
    //$re = mysqli_query($db_connect,$sql1);
    //$row = mysqli_fetch_row($re);

        $msg = $data->msg();
        foreach ($msg as $v){
            $profe = substr( $v['1'], 0, 1 );
            $sql = "INSERT INTO `profess` (`numid`, `profe`, `subject`, `key`, `price`) VALUES ($v[1],$profe,'$v[2]','$v[3]',$v[4]);";
            //echo $sql.'<br />';
            mysqli_query($db_connect, $sql);
        }
echo '数据添加成功，请前往<a href="/admin">后台</a>查看！';
   // echo '<pre>';
    //print_r($msg);
}else{
 ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">请选择xls文件上传:</label>
        <input type="file" name="file" id="file" />
<br />
<br />
        <input type="submit" name="submit" value="上传" />
    </form>




 <?php
}

?>
