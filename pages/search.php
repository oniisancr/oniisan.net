<?php
	session_start();
	date_default_timezone_set('Asia/Shanghai');
	if(@$_GET['action'] == "logout"){
		unset($_SESSION['user_name']);
		header("index.php");
	}
	header("Content-Type: text/html; charset=utf-8");
	require '../inc/phpQuery.php';
	require '../inc/QueryList.php';
	include  '../inc/curlOperation.php';
	use QL\QueryList;

	if(@$_GET['searchkey']==null)
 	{
 		$keyword=@$_POST['searchkey'];
 		if($keyword==null){
 			echo '页面异常，请重试！';
 			exit;
 		}
 	}
 	else {
 	 	$keyword=$_GET['searchkey'];
 	}
	$searchtype='all';
	$rank=new curlx();
	$nowPage=1;
	
	if(@$_GET['nowPage']==NULL)
	{
		$nowPage=1;
	}
	else{

		$nowPage=$_GET['nowPage'];
	}
	
	$content=$rank->searchKeyWord($keyword,$nowPage);
	$content=$rank->addDomain($content);
	$addStr=' target="_blank"';	//加入属性
	$content=preg_replace('/title="/',$addStr.'title=" ',$content);
	
	
	//echo $content;
	
	$rules = array(
    'res' => array('#main','html','-.pic -.muludh -.cont -.num -.footer)')
	);
	$data = QueryList::Query($content,$rules)->data;
	$rules2=array( 
			'res2' => array('#main>.footer>span','text')		//获取有多少页多少结果
	      );
	$data2 = QueryList::Query($content,$rules2)->data;
	@$pageinfo=$data2[0]['res2'];
	
	
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
						echo	"<div id='headfuncdiv'>";
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
		<div class="listDiv">
			<?php
			if(count($data)==0)
			{
				echo '无内容';
				
			}
			for ($i = 0; $i < count($data); $i++) {
			 	  // code to execute 
			 	  echo $data[$i]['res']."\n";
			}
			
			?>		
		<div class="clear"></div>
		<?php
		echo"<div class='nav'>";
				echo "<p>$pageinfo &nbsp &nbsp 当前第$nowPage 页</p>";
				if($nowPage>1){
					echo"<a href='search.php?nowPage=";
					echo $nowPage-1;
					echo "&searchkey=";
					echo $keyword;
					echo " 'class='click'>上一页</a>";		//上一页	
				}
				echo"&nbsp &nbsp&nbsp &nbsp";
					echo"<a href='search.php?nowPage=";
					echo $nowPage+1;
					echo "&searchkey=";
					echo $keyword;
					echo " 'class='click'>下一页</a>";		//下一页	
				echo"</div>";
		
		?>
		</div>
	<footer>
		<p>Powered by oniisan studio </p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>
