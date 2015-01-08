<?php
error_reporting(0);

$name=$_POST['name'];
$passowrd=md5($_POST['password']);

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
  	$rs = $db->query($strsql);

  	$row = $rs->fetch();

  	if($rows){
  		$_SESSION['username'] = $name;
   		header("refresh:0;url=index.php");//跳转页面，注意路径
   		exit;
 	}
 	echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
}else {
 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
}

?>