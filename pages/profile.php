<?php
	session_start();
	date_default_timezone_set('Asia/Shanghai');
	header("Content-Type: text/html; charset=utf-8");
	include "../inc/mysql.php";
	if(@$_GET['action'] == "logout"){
		unset($_SESSION['user_name']);
		header("index.php");
	}
	$mysql=new mysqlconn();
	$mysql->link();			
	$name=@$_SESSION['user_name'];
	if($name==null){
		echo '状态错误！请重新尝试！';
		exit;
	}
	
	$select="select * from userinfo where user_name='$name'";
	$userinfo=$mysql->exec($select);
	if(mysqli_num_rows($userinfo)==0){
		echo '没有该用户数据！请联系管理员更正！';
	}
	else {
	 	$row=mysqli_fetch_assoc($userinfo);	
	 	$id=$row['user_id'];
	 	$email=$row['user_email'];
	 	$date=$row['register_date'];
	 	$role=$row['user_role'];
	}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>欧尼桑ε٩(๑> ₃ <)۶з</title>
	<script src="..\js\main.js" type="text/javascript"></script>
	<link href="..\css\main.css" type="text/css" rel="stylesheet"/>
	<link href="..\css\font-awesome.css" type="text/css" rel="stylesheet"/>
	<link href="..\css\profile.css" type="text/css" rel="stylesheet"/>
</head>
<body>
		<div class="menuDiv">
				<a href="../index.php"><img src="../images/wenzi-logo.png" alt="首页" title="首页"  class="logo"/></a>
				<ul>
					<li>
						<form  action="search.php" method="post">
	  						<input type="text" placeholder="请输入书名、作者..." name="searchkey" required>
	 							<button type="submit" hidden="true"></button>
						</form>
					</li>
					<li><a href="../index.php">首页</a></li>
					<li><a href="noveltype.php?type=0">男频</a></li>
					<li><a href="noveltype.php?type=1">女频</a></li>
					<li><a href=" ">排行榜</a>
						<ul>
							<li><a href="rank.php?type=1">下书网排行</a></li>
							<li><a href="rank.php?type=2">起点中文网</a></li>
							<li><a href="rank.php?type=3">热搜排行</a></li>
						</ul>
						</li>
					</ul>
						<?php
						echo	"		<div id='headfuncdiv'>";
						$name=@$_SESSION['user_name'];
						if($name==""){
						echo "<li><a href='pages/login.html'name='login'>登录</a></li>";
						echo "<li><a href='pages/register.html' name='register' >注册</a></li>";
						}
						else {
					 		echo "<li><a href='' >$name</a>";
					 	
					 			echo	"	 <ul >";		
					 				echo	"		<li><a href='profile.php'>个人信息</a></li>";
					 			echo	"		<li><a href='' id='fav' style='color:#a3a380;' onclick='notexit()'>我的收藏</a></li>";
					 			echo	"		</ul>";
					 		echo	"</li>";
					 	echo "<li><a href='..\index.php?logout=1' >注销</a></li>";
						}
						
						echo	"</div>";
						?>

		</div>
		
			<table>
				<caption style="font-size:18px;margin-bottom:20px;">我的信息</caption>
				<?php
				
				echo "<tr><td>昵称</td><td>$name</td><td>邮箱</td><td>$email</td></tr><tr><td>注册时间</td><td>$date</td><td>用户</td>";
				if($role==1)
				echo"<td>普通用户</td></tr>";
				if($role==0)
				echo"<td>管理员</td></tr>";
				?>
				
			</table>
		
		<div class="clear"></div>
	</div>

	<footer>
		<p>Powered by oniisan studio </p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>