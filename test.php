<!DOCTYPE html>
<html>
<head>
    <title>测试</title>
    <link rel='stylesheet' href='/stylesheets/style.css' />
  </head>
  <body>

  	<header>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	</header>


<?php
    $myServer= 'localhost'; //主机
    $myUser= 'root'; //用户名
  $myPass= 'root'; //密码
  $myDB= 'blog'; //MSSQL库名

  $dsn = "mysql:host=".$myServer.";dbname=".$myDB;
$strsql="SELECT * FROM article";

//  $db = new PDO($dsn, $myUser, $myPass);


try {
    $db = new PDO($dsn, $myUser, $myPass);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "<br/>";
    die();
}

echo $strsql;
     // 从表中提取信息的sql语句
    $db->query("set names utf8");


    $rs = $db->query($strsql);
    while($row = $rs->fetch()){
        print_r($row['id'].$row['title'].$row['content'].$row['createtime'].$row['updatetime']);
    }

?>




  </body>
</html>