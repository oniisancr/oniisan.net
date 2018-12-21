<?php
	@session_start();
	date_default_timezone_set('Asia/Shanghai');
	if(@$_GET['logout'] == 1){
		unset($_SESSION['user_name']);
		header("refresh:0;url=index.php");
	}
?>
<html >
<head>
	<meta charset="UTF-8">
	<title>欧尼桑ε٩(๑> ₃ <)۶з</title>
	<link href="css\main.css" type="text/css" rel="stylesheet"/>
	<link href="css\font-awesome.css" type="text/css" rel="stylesheet"/>
	<link  href="css\style.css" type="text/css" rel="stylesheet">
	<script src="js\main.js" type="text/javascript"></script>
	
</head>
<body>
	<audio controls loop title="Tenderly Jazz Piano - Overjoyed.mp3">
    <source src="musics/Overjoyed.mp3">
	</audio>
	<div id="background" class="wall"></div>
	<div id="midground" class="wall"></div>
	<div id="foreground" class="wall"></div>
	<div id="top" class="wall"></div>
	
		<div class="menuDiv">
				<a href="index.php"><img src="images/wenzi-logo.png" alt="首页" title="首页"  class="logo"/></a>
				<ul>
					<li>
						<form action="pages/search.php" method="post">
	  						<input type="text" placeholder="请输入书名、作者..." name="searchkey" required>
	 							<button type="submit" hidden="true"></button>
						</form>
					</li>
					<li><a href=" ">首页</a></li>
					<li><a href="pages/noveltype.php?type=0">男频</a></li>
					<li><a href="pages/noveltype.php?type=1 ">女频</a></li>
					<li><a href=" ">排行榜</a>
						<ul>
							<li><a href="pages/rank.php?type=1">下书网排行</a></li>
							<li><a href="pages/rank.php?type=2">起点中文网</a></li>
							<li><a href="pages/rank.php?type=3">热搜排行</a></li>
						</ul>
						</li>
					</ul>
				
						
						<?php
						echo	"		<div id='headfuncdiv'>";
						$name=@$_SESSION['user_name'];
						if($name==""){
						echo "<li><a href='pages/login.html'name='login'>登录</a></li>";
						echo "<li><a href='pages/register.html' name='register'>注册</a></li>";
						}
						else {
					 		echo "<li><a href='' >$name</a>";
					 		$msg="'此功能暂未上线'";	
					 		
					 			echo	"	 <ul >";		
					 			echo	"		<li><a href='pages/profile.php'>个人信息</a></li>";
					 			echo	"		<li><a href='' id='fav' style='color:#a3a380;' onclick='notexit()'>我的收藏</a></li>";
					 			echo	"		</ul>";
					 		echo	"</li>";
					 	echo "<li><a href='index.php?logout=1'>注销</a></li>";
						}
						
						echo	"</div>";
						?>


		</div>

		<div class="search-input">
			<form action="pages/search.php" method="post">
	  		<input type="text" placeholder="请输入书名、作者..." name="searchkey" required>
	 			<button type="submit"></button>
			</form>
			<div class="emoji">
				<img src="../images/sunsmile.png"  />
				<p style="color:#e9f01d;opacity:0.7;">荡漾书海,另觅一世界</p>
			</div>
			
		</div>
		
		
	<footer>
		<p>Powered by <a href="mailto:oniisan@163.com" title="点击发送邮件给管理员">oniisan studio </a></p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>