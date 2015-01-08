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

    /*
    // 执行sql查询
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    // 获取查询结果
    //$row=mysql_fetch_row($result);
  echo '<table border="1" cellpadding="1" cellspacing="2">';
  while ($row=mysql_fetch_row($result))
  {
    echo "<tr></b>";
    for ($i=0; $i<mysql_num_fields($result); $i++ )
    {
      echo '<td bgcolor="#00FF00">';
      echo $row[$i];
      echo '</td>';
    }
    echo "</tr></b>";
  }
 echo "</table></b>";
 */
?>  




  </body>
</html>