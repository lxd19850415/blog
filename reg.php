<?php

//开启一个会话
session_start();
$name=$_POST['name'];
$passowrd=md5($_POST['password']);
$email=$_POST['email'];

echo  "注册中...";
if ($name && $passowrd){

  $myServer= 'localhost'; //主机 
	$myUser= 'root'; //用户名  
  $myPass= 'root'; //密码  
	$myDB= 'blog'; //库名  

	$dsn = "mysql:host=localhost;dbname=".$myDB;

	$db = new PDO($dsn, $myUser, $myPass);

	$strsql = "SELECT * FROM user WHERE account = '$name'";
	$db->query("SET NAMES utf8");
  $rs = $db->prepare($strsql);

  $rs->execute();
  $num = $rs->rowCount();

	if($num){
    echo "<script language=javascript>alert('用户名已经存在');history.back();</script>";
  }else {
    $strsql2 = "INSERT INTO user (account, password, email) VALUES ('$name', '$passowrd', '$email')";

		$db->query("SET NAMES utf8");
		$count = $db->exec($strsql2);
    
    if($count >0 ){
      $_SESSION['username'] = $name;
      setcookie(session_name(),session_id(),time()+60,"/");
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