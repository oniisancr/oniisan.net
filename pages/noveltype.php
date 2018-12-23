<?php

	session_start();
	date_default_timezone_set('Asia/Shanghai');
	header("Content-Type: text/html; charset=utf-8");
	require '../inc/phpQuery.php';
	require '../inc/QueryList.php';
	include  '../inc/curlOperation.php';
	use QL\QueryList; 
	$rank=new curlx();
	for ($i = 0; $i < 18; $i++) {
	 	  $a[$i]='black';
	 	  $b[$i]='black';
	 	  $c[$i]='black';
	 	  $d[$i]='black';
	}
	$anum=0;
	$bnum=0;
	$cnum=0;
	$dnum=0;
	if(@$_GET['type']!=NULL)
	{
		$_SESSION['type']=$_GET['type'];
		$_SESSION['a']=0;
		$_SESSION['b']=0;
		$_SESSION['c']=0;
		$_SESSION['d']=0;
	}
	$type=$_SESSION['type'];
	
	if(@$_GET['nowPage']==NULL)
	{
		$nowPage=1;
	}
	else{

		$nowPage=$_GET['nowPage'];
	}
	if(@$_SESSION['a']==null){
		
		if(@$_GET['a'] != null)
		{
				$anum=$_GET['a'];
				$a[$anum]='red';
				$_SESSION['a']=$_GET['a'];
		}
		else {
			if($type==0)
			$a[0]='red';
			if($type==1)
			{
				$a[10]='red';
				$anum=10;
			}
		}
	}
	else{
		if(@$_GET['a'] != null)
		{
				$anum=$_GET['a'];
				$a[$anum]='red';
				$_SESSION['a']=$_GET['a'];
		}
		else {
			$anum=$_SESSION['a'];
		 $a[$anum]='red';
		}
			
	}	
	
	if(@$_SESSION['b']==null){
		
		if(@$_GET['b'] != null)
		{
				$bnum=$_GET['b'];
				$b[$bnum]='red';
				$_SESSION['b']=$_GET['b'];
		}
		else {
			$b[0]='red';
		}
	}
	else{
		if(@$_GET['b'] != null)
		{
				$bnum=$_GET['b'];
				$b[$bnum]='red';
				$_SESSION['b']=$_GET['b'];
		}
		else {
			$bnum=$_SESSION['b'];
		 $b[$bnum]='red';
		}	
	}
	if(@$_SESSION['c']==null){
		
		if(@$_GET['c'] != null)
		{
				$cnum=$_GET['c'];
				$c[$cnum]='red';
				$_SESSION['c']=$_GET['c'];
		}
		else {
			$c[0]='red';
		}
	}
	else{
		if(@$_GET['c'] != null)
		{
				$cnum=$_GET['c'];
				$c[$cnum]='red';
				$_SESSION['c']=$_GET['c'];
		}
		else {
			$cnum=$_SESSION['c'];
		 $c[$cnum]='red';
		}		
	}
	if(@$_SESSION['d']==null){
		
		if(@$_GET['d'] != null)
		{
				$dnum=$_GET['d'];
				$d[$dnum]='red';
				$_SESSION['d']=$_GET['d'];
		}
		else {
			$d[0]='red';
		}
	}
	else{
		if(@$_GET['d'] != null)
		{
				$dnum=$_GET['d'];
				$d[$dnum]='red';
				$_SESSION['d']=$_GET['d'];
		}
		else {
			$dnum=$_SESSION['d'];
		 $d[$dnum]='red';
		}	
	}
	if($anum==0)
	{
		$anum='nan';
	}
	if($anum==10 &&$type==1)
	{
		$anum='nv';
	}
		
	if($dnum==0)$dnum='allvisit';
	else if($dnum==1)$dnum='monthvisit';
	else if($dnum==2)$dnum='dayvisit';
	else if($dnum==3)$dnum='alldown';
	else if($dnum==4)$dnum='monthdown';
	else if($dnum==5)$dnum='marknum';
	else if($dnum==6)$dnum='lastupdate';
	else if($dnum==7)$dnum='postdate';

	$url="https://www.xiashu.la/type/".$anum."_".$bnum."_".$cnum."_".$dnum."_".$nowPage.".html";			//下书网排行
	//echo $url;
	
	$html=$rank->getFulUrl($url);
	$addStr=' target="_blank"';	//加入属性
	$html=preg_replace('/title="/',$addStr.'title=" ',$html);
	$rules = array(
    'res' => array('.item','html','-.pic  -.cont -.num)')
	);
	$data = QueryList::Query($html,$rules)->data;
	$rules2=array( 
			'res2' => array('#main>.footer>span','text')		//获取有多少页多少结果
	      );
	$data2 = QueryList::Query($html,$rules2)->data;
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
		
		<div class="typeDiv">
			<?php
			if($type==0)
			{
				echo '<ul>';
					echo '<li>男生分类:';		
					echo "<a href='noveltype.php?a=0' style='color:".$a[0].";'>全部</a>";
					echo "<a href='noveltype.php?a=1' style='color:".$a[1].";'>玄幻奇幻</a>";
					echo "<a href='noveltype.php?a=2' style='color:".$a[2].";'>仙侠武侠</a>";
					echo "<a href='noveltype.php?a=3' style='color:".$a[3].";'>都市生活</a>";
					echo "<a href='noveltype.php?a=4' style='color:".$a[4].";'>职场商场</a>";
					echo "<a href='noveltype.php?a=5' style='color:".$a[5].";'>历史传奇</a>";
					echo "<a href='noveltype.php?a=6' style='color:".$a[6].";'>军事谍战</a>";
					echo "<a href='noveltype.php?a=7' style='color:".$a[7].";'>科幻未来</a>";
					echo "<a href='noveltype.php?a=8' style='color:".$a[8].";'>游戏竞技</a>";
					echo "<a href='noveltype.php?a=9' style='color:".$a[9].";'>灵异悬疑</a>";
					echo "<a href='noveltype.php?a=10' style='color:".$a[10].";'>短篇小说</a>";
					echo '</li>';
					
			}else if($type==1){
				echo '<ul>';
					echo '<li>女生分类:';		
					echo "<a href='noveltype.php?a=10' style='color:".$a[10].";'>全部</a>";
					echo "<a href='noveltype.php?a=11' style='color:".$a[11].";'>现代言情</a>";
					echo "<a href='noveltype.php?a=12' style='color:".$a[12].";'>古代言情</a>";
					echo "<a href='noveltype.php?a=13' style='color:".$a[13].";'>仙侠幻情</a>";
					echo "<a href='noveltype.php?a=14' style='color:".$a[14].";'>穿越架空</a>";
					echo "<a href='noveltype.php?a=15' style='color:".$a[15].";'>总裁豪门</a>";
					echo "<a href='noveltype.php?a=16' style='color:".$a[16].";'>浪漫青春</a>";
					echo "<a href='noveltype.php?a=17' style='color:".$a[17].";'>审美同人</a>";

					echo '</li>';
			}
					
					echo '<li>作品字数：';
					echo "<a href='noveltype.php?b=0' style='color:".$b[0].";'>全部</a>";
					echo "<a href='noveltype.php?b=1' style='color:".$b[1].";'>500章以下</a>";
					echo "<a href='noveltype.php?b=2' style='color:".$b[2].";'>500-1000章</a>";
					echo "<a href='noveltype.php?b=3' style='color:".$b[3].";'>1000章以上</a>";
					echo '</li>';
					echo '<li>写作进度：';
					echo "<a href='noveltype.php?c=0' style='color:".$c[0].";'>不限</a>";
					echo "<a href='noveltype.php?c=1' style='color:".$c[1].";'>连载</a>";
					echo "<a href='noveltype.php?c=2' style='color:".$c[2].";'>完本</a>";
					echo '</li>';
					echo '<li>排序方式：';
					echo "<a href='noveltype.php?d=0' style='color:".$d[0].";'>总点击</a>";
					echo "<a href='noveltype.php?d=1' style='color:".$d[1].";'>月点击</a>";
					echo "<a href='noveltype.php?d=2' style='color:".$d[2].";'>日点击</a>";
					echo "<a href='noveltype.php?d=3' style='color:".$d[3].";'>总下载</a>";
					echo "<a href='noveltype.php?d=4' style='color:".$d[4].";'>月下载</a>";
					echo "<a href='noveltype.php?d=5' style='color:".$d[5].";'>总收藏</a>";
					echo "<a href='noveltype.php?d=6' style='color:".$d[6].";'>最近更新</a>";
					echo "<a href='noveltype.php?d=7' style='color:".$d[7].";'>最近入库</a>";
	
			
					?>
					
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		
		<div class="listDiv">
			<?php
			if(count($data)==0)
			{
				echo '无内容';
				
			}
			$rules2 = array(
				'titleid' => array('.title h3 a','href')
				);

			//echo "共有".count($data);

			//var_dump($data);
			//exit;
			for ($i = 0; $i < count($data); $i++) {
			 	  // code to execute 
				   echo $data[$i]['res'];
					$data2 = QueryList::Query($data[$i]['res'],$rules2)->data;
					//echo $data2[0]['titleid'];
					preg_match('/\d+/',$data2[0]['titleid'],$id);				//提取小说id
					$com="<a href ='novel.php?id=$id[0]' class='comment'>评论</a>";
				   echo "$com"."\n";

			}
			?>		
		<div class="clear"></div>
		<?php
		echo"<div class='nav'>";
				echo "<p>$pageinfo &nbsp &nbsp 当前第$nowPage 页</p>";
				if($nowPage>1){
					echo"<a href='noveltype.php?nowPage=";
					echo $nowPage-1;
					echo " 'class='click'>上一页</a>";		//上一页	
				}
				echo"&nbsp &nbsp&nbsp &nbsp";
					echo"<a href='noveltype.php?nowPage=";
					echo $nowPage+1;
					echo " 'class='click'>下一页</a>";		//下一页	
				echo"</div>";
		?>
		</div>
		
		
	<footer>
		<p>Powered by <a href="mailto:oniisan@163.com" title="点击发送邮件给管理员">oniisan studio </a></p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>
