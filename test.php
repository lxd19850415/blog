<!DOCTYPE html>
<html>
  <head>
    <title>测试</title>
    <link rel='stylesheet' href='/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
  		<!-- <h1><%= title%></h1>-->
  	</header>


<?php   
  $myServer= 'localhost'; //主机  
  $myUser= 'root'; //用户名  
  $myPass= 'root'; //密码  
  $myDB= 'blog'; //MSSQL库名  

  $dsn = "mysql:host=localhost;dbname=".$myDB;
  $db = new PDO($dsn, $myUser, $myPass);
     // 从表中提取信息的sql语句
    $strsql="SELECT * FROM article";
    echo $strsql;

  $rs = $db->query("SELECT * FROM article");
while($row = $rs->fetch()){
    print_r($row['id'].$row['title'].$row['content'].$row['createtime'].$row['updatetime']);
}

?>  




  </body>
</html>