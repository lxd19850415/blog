<?php

//开启一个会话
session_start();
$title=$_POST['title'];
$content=$_POST['content'];
$time=date("Y-m-d H:i:s");
$type=$_POST['type'];
if (isset($_SESSION['username'])){
	$name=$_SESSION['username'];
}
else
{
	$name='none';
}

// if (isset($_SESSION['username'])){
if (true){
	$myServer= 'localhost'; //主机 
	$myUser= 'root'; //用户名  
  	$myPass= 'root'; //密码  
	$myDB= 'blog'; //库名  

	$dsn = "mysql:host=localhost;dbname=".$myDB;

	$db = new PDO($dsn, $myUser, $myPass);

    $strsql2 = "INSERT INTO article (title, content, author,createtime,updatetime,type) VALUES ('$title', '$content', '$name','$time','$time','$type')";
	$db->query("SET NAMES utf8");
	$count = $db->exec($strsql2);


    if($count >0 ){
    	echo  "发表成功，正在跳转...";
    	header("refresh:0;url=index.php");//跳转页面，注意路径
    	exit;
    }
    else{
    	echo "<script language=javascript>alert('服务器异常！');history.back();</script>";
    }
  
}else {
	echo  "登录过期，请重新登录...";
	header("refresh:0;url=login_form.php");//跳转页面，注意路径
}

?>