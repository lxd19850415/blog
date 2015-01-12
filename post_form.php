<!DOCTYPE html>
<html>
  <head>
    <title>发表</title>
    <link rel='stylesheet' href='/blog/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
  		<!-- <h1><%= title%></h1>-->
  	</header>

  	<div class="navbg">
      <div class="navbg2">
        <div class="nav_"><a class="nav_a" title="主页" href="/blog/index.php">主页</a></div>
        <div class="nav_"><a class="nav_a" title="搜索" href="/">搜索</a></div>
        <div class="nav_"><a class="nav_a" title="最热" href="/">热点</a></div>

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

function checkPost(){ 
	var form1 = window.document.getElementById("formPost");//获取form1对象
	var title1 = window.document.getElementById("title_").value;//获取form1对象
	var postEdit1 = window.document.getElementById("postEdit_").value;//获取form1对象
	if ( isNull(title1 ) || isNull(postEdit1 ) )
	{
		alert("标题或内容不能为空！");
	} 
	else
	{
		form1.submit();
	}
}

</script>

<form method="post" action="post.php" id="formPost">

	<div class="loginAccountTitle">
		标题：
	</div>

	<input type="text" name="title" size="36" id="title_"  class="loginAccountEdit" width="200px" onmouseover="this.style.borderColor='black';this.style.backgroundColor='plum'" onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'" />
  
    <select name="type">
      <option value="0" selected="">请选择类型</option>
      <option value="1">计算机</option>
      <option value="2">生物</option>
      <option value="3">物理</option>
      <option value="4">化学</option>
      <option value="5">金融</option>
    </select>

  <div class="loginAccountTitle">
		正文：
	</div>
<div>
  <textarea name="content" class="postEdit" id="postEdit_" onmouseover="this.style.borderColor='black';this.style.backgroundColor='plum'" onmouseout="this.style.borderColor='black';this.style.backgroundColor='#ffffff'"></textarea>
</div>
	<input class="submitBtn" type="button" onClick="checkPost()" value="发表">
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