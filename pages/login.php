<?php
	@session_start();
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');
	include "../inc/mysql.php";
	$mysql=new mysqlconn();
	$mysql->link();						
	$name=@$_POST['nickname'];
	$psw=@$_POST['psw1'];
	if($name!=null){	
		$select1="select * from userinfo where user_name='$name' and user_password='$psw'";
		$res1=$mysql->exec($select1);
		if(mysqli_num_rows($res1)==0){
		echo '用户名或密码错误<br/>';
		header("refresh:3;url=login.html");
			print('<br>三秒后自动返回');
		}
		else{
			$_SESSION['user_name']=$name;
			echo '登录成功';
			header("refresh:3;url=../index.php");
			print('<br>三秒后将自动跳转到首页');
		}
		mysqli_free_result($res1);
	}
?>
<br/>
<a href="../index.php">点击回到首页</a>