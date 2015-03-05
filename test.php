
<?php
$myServer= 'localhost'; //主机
$myUser= 'root'; //用户名
  $myPass= 'lxd123654'; //密码
  $myDB= 'blog'; //MSSQL库名

$strsql="SELECT * FROM article";
echo $strsql;
$con = mysql_connect($myServer,$myUser,$myPass) or die("数据库链接失败！");;
//echo '11111111';
//var_dump($con);
if(!$con)
{
    echo '数据库连接错误：'.mysql_error();
}
else{

    echo '数据库连接成功';
}

mysql_select_db($myDB,$con);
mysql_query("set names utf8");
$query = mysql_query($strsql);
var_dump($query);
$data =mysql_fetch_row($query);
var_dump($data);
echo $data[0]['id'].'--'.$data[0]['title'].'--'.$data[0]['content'].'--'.$data[0]['createtime'].'--'.$data[0]['updatetime'].'--';

//echo phpinfo();
?>


