<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json;charset=utf-8');

require_once('Connections/conn_db.php');

if(isset($_POST['cartid']) && isset($_POST['qty'])){
    $cartid=$_POST['cartid'];
    $qty=$_POST['qty'];
    $query=sprintf("UPDATE cart SET qty='%d' WHERE cart.cartid=%d", $qty,$cartid);
    $result=$link->query($query);
    if($result){
        $retcode=array("c"=>"1","m"=>'購物車數量更新囉!');
    }else{
        $retcode=array("c"=>"0","m"=>'抱歉！無法更新數量，請聯絡管理員');
    }
    echo json_encode($retcode,JSON_UNESCAPED_UNICODE);
}
return;

?>