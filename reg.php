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
  	$strsql = "SELECT * FROM user WHERE account = '$name' ";
  	$db->query("SET NAMES utf8");
  	$rs = $db->query($strsql);
  	$row = $rs->fetch();

  	if($rows){
  		echo "<script language=javascript>alert('用户名已经存在');history.back();</script>";
  	}else {
  		$strsql2 = "SELECT * FROM user WHERE account = '$name' ";
  		$db->query("SET NAMES utf8");
  		$count = $db->exec($strsql);
 		 if($count >0 ){
 		 	$_SESSION['username'] = $name;
 		 	header("refresh:0;url=index.php");//跳转页面，注意路径
 		 	exit;
 		 }
 		 else{

  			echo "<script language=javascript>alert('服务器异常！');history.back();</script>";
 		 }
	}
}else {
	echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";

}

?>