<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../inc/PHPMailer/src/Exception.php';
	require '../inc/PHPMailer/src/PHPMailer.php';
	require '../inc/PHPMailer/src/SMTP.php';
	$email=@$_POST["email"];
	//$email='crsite@qq.com';
	if($email==null)
	{
		echo'失败';
		exit;
	}
	$mail = new PHPMailer(true); 
		try {
    //Server settings
    $mail->Charset='UTF-8';
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'oniisan@163.com';                 // SMTP username
    $mail->Password = '3158aa';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->setFrom('oniisan@163.com', 'oniisan studio');
    $mail->addAddress("$email");     // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'oniisan验证邮箱';
    $code=rand(100000,999999);
    $mail->Body = "亲爱的用户:<br/>您好!<br/>您申请绑定此邮箱到您的oniisan帐户，<b>验证码为： $code</b>。如非本人操作，请忽略此邮件。</b>";
    $mail->send();
    echo 'Message has been sent';
		} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
     @$_SESSION['code']=$code; //保存验证码
?>