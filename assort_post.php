<!DOCTYPE html>
<html>
  <head>
    <title>朝闻道-登录</title>
    <link rel='stylesheet' href='/blog/stylesheets/style.css' />
  </head>
  <body>
   
  	<header>
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

</script>
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<div class="frame_1">
			<div class="frame_1_1">
				<div class="min"><a href="/blog/assort.php?type=1"><img src="images/index1.jpg"></a></div>
				<div class="min"><a href="/blog/assort.php?type=2"><img src="images/index2.jpg"></a></div>
				<div class="max"><a href="/blog/assort.php?type=3"><img src="images/index3.jpg"></a></div>
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index4.jpg"></a></div>
			</div>
			<div class="frame_1_1">
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index5.jpg"></a></div>
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index1.jpg"></a></div>
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index7.jpg"></a></div>
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index3.jpg">></a></div>
			</div>
			<div class="frame_1_1">
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index3.jpg"></a></div>
				<div class="min"></div>
				<div class="min"></div>
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index1.jpg"></a></div>
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index1.jpg"></a></div>
			</div>
			<div class="frame_1_1">
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index12.jpg"></a></div>
				<div class="max"><a href="/blog/assort.php?type=4"><img src="images/index13.jpg"></a></div>
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index14.jpg"></a></div>
				<div class="min"><a href="/blog/assort.php?type=4"><img src="images/index2.jpg"></a></div>
			</div>
		</div>


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