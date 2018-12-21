<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');
	include "../inc/mysql.php";
	$mysql=new mysqlconn();
	$mysql->link();						
	$name=@$_POST['nickname'];
	$email=@$_POST['email'];
	$psw=@$_POST['psw2'];
	$code=@$_POST['code'];
	
	if($code!=@$_SESSION['code']){
		echo "验证码".$code;
		
		echo '无效验证码！请重新注册！';
		header("refresh:3;url=register.html");
			print('<br>三秒后将自动返回注册界面');
		exit;
	}
	if($name!=null){		//防止在注册成功界面刷新
		$select1="select * from userinfo where user_name='$name'";
		$res1=$mysql->exec($select1);
		if(mysqli_num_rows($res1)!=0){
		echo '用户名已经存在！请重新注册！';
		header("refresh:4;url=register.html");
			print('<br>四秒后将自动返回注册界面');
		exit;
		}
		$select2="select * from userinfo where user_email='$email'";
		$res2=$mysql->exec($select2);
		if(mysqli_num_rows($res2)!=0){
			echo '邮箱已经被使用！请重新注册！';
			header("refresh:3;url=register.html");
			print('<br>三秒后将自动返回注册界面');
			exit;
		}
		$date=date("Y-m-d H:i:s");
		
		$squery="insert into userinfo(user_name,user_password,user_email,register_date) values ('$name','$psw','$email','$date')";
		$mysql->exec($squery);
		echo "注册成功！请牢记您的用户名和密码，用以登录。<br> 用户名:$name 邮箱:$email";
		$_SESSION['user_name']=$name;
		mysqli_free_result($res1);
		mysqli_free_result($res2);
		header("refresh:10;url=../index.php");
		print('<br>正在加载，请稍等...<br>十秒后自动跳转到首页');
	}

	$_SESSION['code']=null;
?>
<br/>
<a href="../index.php">点击回到首页</a>