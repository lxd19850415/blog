<!DOCTYPE html>
<html>
  <head>
    <title>朝闻道-登录</title>
    <link rel='stylesheet' href='/blog/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
  		<!-- <h1><%= title%></h1>-->
  		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	</header>

  	<div class="navbg">
      <div class="navbg2">
    		<div class="nav_"><a class="nav_a" title="主页" href="/blog/index.php">主页</a></div>
		  <div class="nav_"><a class="nav_a" title="搜索" href="/blog/search_form.php">搜索</a></div>
		  <div class="nav_"><a class="nav_a" title="分类" href="/blog/assort_post.php">分类</a></div>

      <?php 
          if(isset($_SESSION['username']))
          {
            echo "<div class='nav_'><a class='nav_a' title='发表' href='/blog/post_form.php'>发表</a></div>";
          }
        ?>

      </div>

      <?php 
        if(isset($_SESSION['username']))
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



<script type="text/javascript">

function isNull( str ){ 
	if ( str == "" )
	{
	 	return true; 
	}
	var regu = "^[ ]+$"; 
	var re = new RegExp(regu); 
	return re.test(str); 
}

function AntiSqlValid(str ) {
	var sUrl=str.toLowerCase();
	var sQuery=sUrl.substring(sUrl.indexOf("=")+1);

	var re = /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
	if (re.test(sQuery)) {
		alert("请您不要在参数中输入特殊字符和SQL关键字！"); //注意中文乱码
		return false;
	}
	return true;
}

function checkPost(){ 
	var form1 = window.document.getElementById("formLogin");//获取form1对象
	var name1 = window.document.getElementById("name_").value;//获取form1对象
	var password1 = window.document.getElementById("password_").value;//获取form1对象
	if ( isNull(name1 ) || isNull(password1 ) )
	{
		alert("用户名或密码不能为空！");
	} 
	else
	{
		if(AntiSqlValid(name1) && AntiSqlValid(password1))
		{
			form1.submit();
		}

	}
}

</script>

<form method="post" action="login.php" id="formLogin">
	<div class="loginAccountTitle">
		用户名：
	</div>
	<div class="aaa">
		<input type="text" name="name" id="name_" size="36"  class="loginAccountEdit" width="200px" onmouseover="this.style.borderColor='black';this.style.backgroundColor='plum'" onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'" />
	</div>
	<div class="loginAccountTitle">
		密码：
	</div>
	<div class="aaa">
		<input type="password" name="password" id="password_"   class="loginAccountEdit" size="36" width="200px" onmouseover="this.style.borderColor='black';this.style.backgroundColor='plum'" onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"  />
	</div>
	<div>
		<input class="submitBtn" type="button" onClick="checkPost()" value="登录">
	</div>
</form>

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