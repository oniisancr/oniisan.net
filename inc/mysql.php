<?php
	class mysqlconn{
	public $database;
	public $server_username;
	public $server_userpassword;
	public $id;
	function	link(){

		$server_username="root";
		$server_userpassword="3158.cn";
		$database="oniisan";
		if($this->id=mysqli_connect('localhost',$server_username,$server_userpassword,$database)){
			
		}
		else {
		 	echo '连接服务失败！！';
		 	exit;
		}
	}
	
	function exec($query){
		//echo"$query<br>";
		if($result=mysqli_query($this->id,$query)){
			
			return $result;
		}else {
		 	echo "sql语句执行失败！";
		 	exit;
		}
		}
	}
?>