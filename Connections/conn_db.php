<?php
// 本機使用
// PDO SQL連線指令
$dsn="mysql:host=localhost;dbname=expstore;charset=utf8";
$user="sales";
$password="123456qq";
$link=new PDO($dsn,$user,$password);
date_default_timezone_set("Asia/Taipei");

//awardspace
// $dsn="mysql:host=fdb1034.awardspace.net;dbname=4703706_expstore;charset=utf8";
// $user="4703706_expstore";
// $password="tryBestyousee2";
// $link=new PDO($dsn,$user,$password);
// date_default_timezone_set("Asia/Taipei");

// byet Host
// $dsn="mysql:host=sql305.byethost22.com;dbname=b22_40355502_expstore;charset=utf8";
// $user="b22_40355502";
// $password="Hifree21@";
// $link=new PDO($dsn,$user,$password);
// date_default_timezone_set("Asia/Taipei");
?>