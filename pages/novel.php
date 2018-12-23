<?php

	session_start();
	date_default_timezone_set('Asia/Shanghai');
	header("Content-Type: text/html; charset=utf-8");
		
	require '../inc/phpQuery.php';
	require '../inc/QueryList.php';
    include  '../inc/curlOperation.php';
    include '../inc/mysql.php';
    use QL\QueryList; 
    $mysql=new mysqlconn();
    $mysql->link();
    
    if(isset($_POST['submit'])){        //处理新的评论
		if(@$_SESSION['user_name']==null){
		    echo '请先登录！';
		    header("refresh:3;url=login.html");
			print('<br>三秒后自动转到');
		    exit;
		}
		else {
			$content=$_POST["content"];
			if(strlen($content)>80||strlen($content)<5){
				echo '评论字数限制！评论失败！';
				header("refresh:3;url=article.php");
				print('<br>三秒后将自动返回');
				exit;
			}
			
			$date5=date("Y-m-d H:i:s");
			$name=@$_SESSION['user_name'];			//评论者
		
		 	$novel_id=$_SESSION['novel_id'];
			$squery2="insert into comment(comment_user, novel_id,comment_date,  comment_content) values ('$name',$novel_id,'$date5','$content')";		
			$mysql->exec($squery2);
			echo '评论成功！！';
			unset($_POST['submit']);
			header("refresh:1;url=novel.php?id=$novel_id");
		//	print('<br>三秒后将自动返回');
			exit;
		}
	}




	$rank=new curlx();
    if(@$_GET['id'] == null&& !is_numeric(@$_GET['id']))
    {
        echo "抱歉，小说id非法";
        exit;
    }
    else{
        $noveid=$_GET['id'] ;
        $_SESSION['novel_id']=$noveid;
        $url="https://www.xiashu.la/$noveid/";
    }
    //echo $url;
	$html=$rank->getFulUrl($url);
	$addStr=' target="_blank"';									//加入属性
	$html=preg_replace('/title="/',$addStr.'title=" ',$html);

    //echo $html;
	
	//$html=preg_replace('/(<\/p>){1}(.*?)(<\/div>){1}/',"$com",$html);

	$rules = array(
    //采集class为toplistbox这个元素里面的纯文本内容
    'info' => array('#info','html','-.tag -.option -h3 -a')
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
			else{
                echo $data[0]['info'];
                echo " <div class='commentDiv'>";
		        echo "<p><br>最新评论:</p>";
				 
				$squery="select * from comment where novel_id='$noveid' order by  comment_date DESC";
				$res=$mysql->exec($squery);
				if(mysqli_num_rows($res)!=0)
				{
					while($row=mysqli_fetch_assoc($res)){		//输出所有评论
						$listDate=$row['comment_date'];
						$listComment=$row['comment_content'];
						$commentUser=$row['comment_user'];
						echo "<p class='commentList'> $commentUser: $listComment 时间： $listDate </p>";	
					}
					
				}
				else {
						
				 	echo "<p class='commentList'>&nbsp &nbsp &nbsp &nbsp暂无评论</p>";
				}
				
			}
			?>
            <div class="submitComment">
			<form action="novel.php" method="post">
			评论：<textarea rows="3" cols="80" class="commentContent" name="content" placeholder="请在此处写下你的评论,5-70字！" required></textarea>
			<input type="submit" size="30" value="提交"  class="submit2"  name="submit"/>
		</form>
	</div>
			<div class="clear"></div>
		</div>
	<footer>
		<p>Powered by <a href="mailto:oniisan@163.com" title="点击发送邮件给管理员">oniisan studio </a></p>
		<p>本站所提供作品均来自互联网，仅作交流学习使用，如有侵权，请联系修改。</p>
	</footer>
</body>
</html>