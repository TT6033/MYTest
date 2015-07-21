<?php # mysql_connect.php

$db_name="misdb";	//数据库名字
$host_address='localhost';//主机地址
$user_name='root';//登陆数据库用户名
$password='TT';//登陆密码


$con = mysql_connect($host_address, $user_name,$password );
if (!$con)
 {
 echo ('Could not connect: ' . mysql_error());
 die();
 }
 else 
 {
 	echo "success to connect!";
 }
mysql_select_db($db_name, $con);
mysql_query("SET NAMES UTF8");


?>
