<?php

	session_start();
	date_default_timezone_set('Asia/Shanghai');
	header("Content-Type: text/html; charset=utf-8");
		
	require '../inc/phpQuery.php';
	require '../inc/QueryList.php';
	include  '../inc/curlOperation.php';
	use QL\QueryList; 
	$rank=new curlx();
	if(@$_GET['type'] == 1)
		$url="https://www.xiashu.la/top_xiashu_1.html";			//下书网排行
	else if ($_GET['type'] == 2) {
	 	$url="https://www.xiashu.la/top_qidian_1.html";			//起点网排行
	}
	else if ($_GET['type'] == 3) {
	 	$url="https://www.xiashu.la/top_resou_1.html";			//热搜排行
	}
	else {
	 		$url="https://www.xiashu.la/top_xiashu_1.html";		//默认为下书网排行
	}
	$html=$rank->getFulUrl($url);
	$addStr=' target="_blank"';	//加入属性
	$html=preg_replace('/title="/',$addStr.'title=" ',$html);
	$rules = array(
    //采集class为toplistbox这个元素里面的纯文本内容
    'toplist' => array('.toplistbox','html','-.pic -.yuedu'),

	);
	$data = QueryList::Query($html,$rules)->data;

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>欧尼桑ε٩(๑> ₃ <)۶з</title>
	<script src="..\js\main.js" type="text/javascript"></script>
	<link href="..\css\main.css" type="text/css" rel="stylesheet"/>
	<link href="..\css\font-awesome.css" type="text/css" rel="stylesheet"/>
	<link href="..\css\xiazaiwang.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	

		<div class="menuDiv">
				<a href="../index.php"><img src="../images/wenzi-logo.png" alt="首页" title="首页"  class="logo"/></a>
				<ul>
					<li>
						<form action="search.php" method="post">
	  						<input type="text" placeholder="请输入书名、作者..." name="searchkey">
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
						echo "<li><a href='login.html'name='login'>登录</a></li>";
						echo "<li><a href='register.html' name='register' >注册</a></li>";
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
		
		<div class="listDiv">
			<?php
			if(count($data)==0)
			{
				echo '无内容';
				
			}
			for ($i = 0; $i < count($data); $i++) {
			 	  // code to execute 
			 	  echo $data[$i]['toplist']."\n";
			}
			?>
			<div class="clear"></div>
		</div>
	<footer>
		<p>Powered by <a href="mailto:oniisan@163.com" title="点击发送邮件给管理员">oniisan studio </a></p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>