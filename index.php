<!DOCTYPE html>
<html>
  <head>
    <title><%= title %></title>
    <link rel='stylesheet' href='/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
  		<!-- <h1><%= title%></h1>-->
  	</header>

  	<div class="navbg">
      <div class="navbg2">
    		<div class="nav_"><a class="nav_a" title="主页" href="/">主页</a></div>
        <div class="nav_"><a class="nav_a" title="搜索" href="/">搜索</a></div>
        <div class="nav_"><a class="nav_a" title="最热" href="/">热点</a></div>

        <% if(user) { %>
        <div class="nav_"><a class="nav_a" title="发表" href="/post">发表</a></div>
        <% } %>

      </div>
      <% if(user) { %>
      <div class="l"><a title="登出" href="/logout">登出</a></div>
      <% } else { %>
  		<div class="l"><a title="登录" href="/login">登录</a></div>
  		<div class="l"><a title="注册" href="/reg">注册</a></div>
      <% } %>
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
      echo '作者：<a href="#">'.$row['author'].'</a>|' ;  
      echo '日期：'. $row['updatetime'];
    echo '</p>';
    echo '<p>'.$row['content'].'</p>';
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