<?php

//开启一个会话
session_start();
$name=$_POST['name'];
$passowrd=md5($_POST['password']);

echo  "登录中...<br/>";

if ($name && $passowrd){
	$myServer= 'localhost'; //主机  
	$myUser= 'root'; //用户名  
	$myPass= 'root'; //密码  
	$myDB= 'blog'; //库名  

	$dsn = "mysql:host=localhost;dbname=".$myDB;
	$db = new PDO($dsn, $myUser, $myPass);
	// 从表中提取信息的sql语句
	$strsql = "SELECT * FROM user WHERE account = '$name' and password='$passowrd'";
	$db->query("SET NAMES utf8");
  $rs = $db->prepare($strsql);

  $rs->execute();
  $num = $rs->rowCount();

	if($num){
		$_SESSION['username'] = $name;
    setcookie(session_name(),session_id(),time()+60,"/");
 		header("refresh:0;url=index.php");//跳转页面，注意路径
 		exit;
 	}
 	echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
}else {
 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
}

?>