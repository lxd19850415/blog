<!DOCTYPE html>
<html>
  <head>
    <title>朝闻道-主页</title>
    <link rel='stylesheet' href='/blog/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
  		<!-- <h1><%= title%></h1>-->
  	</header>

  	<div class="navbg">
      <div class="navbg2">
    		<div class="nav_"><a class="nav_a" title="主页" href="/blog/index.php">主页</a></div>
        <div class="nav_"><a class="nav_a" title="搜索" href="/blog/search_form.php">搜索</a></div>
        <div class="nav_"><a class="nav_a" title="分类" href="/blog/assort_post.php">分类</a></div>
        <?php 
          if(isset($_COOKIE[session_name()]))
          {
            echo "<div class='nav_'><a class='nav_a' title='发表' href='/blog/post_form.php'>发表</a></div>";
          }
        ?>

      </div>

      <?php 
        if(isset($_COOKIE[session_name()]))
        {
          echo " <div class='l'><a title='登出' href='/blog/logout.php'>登出</a></div>";
        }
        else
        {
          echo " <div class='l'><a title='登录' href='/blog/login_form.php'>登录</a></div>";
          echo " <div class='l'><a title='注册' href='/blog/reg_form.php'>注册</a></div>";
        }
      ?>

  	</div>

    <div class="center">
  	<article>



<?php   
  $myServer= 'localhost'; //主机  
  $myUser= 'root'; //用户名  
  $myPass= 'root'; //密码  
  $myDB= 'blog'; //库名  

  $dsn = "mysql:host=localhost;dbname=".$myDB;
  $db = new PDO($dsn, $myUser, $myPass);
  // 从表中提取信息的sql语句
  $strsql="SELECT * FROM article";
  $db->query("SET NAMES utf8");
  $rs = $db->query($strsql);
  while($row = $rs->fetch()){
    echo '<p><h2><a href="#">'.$row['title'].'</a></h2></p>';
    echo '<p class="info">';
      echo '作者：<a href="#">'.$row['author'].'</a> |' ;  
      echo ' 日期：'. $row['updatetime'].' | ' ;
      echo ' 类型：'. convertType($row['type']) ;
    echo '</p>';
    echo '<p>'.$row['content'].'</p>';
    echo '<hr>';
  }

function convertType($type)
{
  if($type=='0')
  {
    return '其他';
  } 
  else if($type=='1'){
    return '计算机';
  }
  else if($type=='2'){
    return '生物';
  }
  else if($type=='3'){
    return '化学';
  }
}
?>

  	</article>
</div>

  	<div class="companybg">
	  	<div class="company">
		  	<span class="copy S_txt2">Copyright © 20015-2018 ZHAOWENDAO 上海朝闻道网络技术有限公司</span>
		  	<span>
			  	<a class="S_txt2" href="http://weibo.com/aj/static/jww.html?_wv=6">沪网文[2011]0398-130号</a>
			  	<a class="S_txt2" href="http://www.miibeian.gov.cn" target="_blank">沪ICP备12002058号</a>
			  	<a class="S_txt2" href="http://weibo.com/aj/static/license.html?_wv=6">增值电信业务经营许可证B2-20140447</a>
		 	  	<select node-type="changeLanguage">
					<option value="zh-cn" selected="">中文(简体)</option>
					<option value="zh-tw">中文(台灣)</option>
					<option value="zh-hk">中文(香港)</option>
					<option value="en">English</option>
				</select>
	        </span>
	    </div>
  </div>
  </body>
</html>