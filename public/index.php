<?php

$to = "qiuhao8888@sina.com"; //收件人  
$subject = "Test"; //主题  
$message = "This is a test mail!"; //正文  
mail($to,$subject,$message); 


require_once 'conn.php';
require_once "email.class.php";
require_once "sendmail.php";

$name=$_POST["name"];
error_log('name:'.$name, 3, 'info.log');

if ($name != "") {
	$tel=$_POST["tel"];
	$school=$_POST["school"];
	$age=$_POST["age"];
	
error_log('tel:'.$tel."\r\n", 3, 'info.log');
error_log('school:'.$school."\r\n", 3, 'info.log');
error_log('age:'.$age."\r\n", 3, 'info.log');

	//写入数据
	$query = "INSERT INTO studentlist (
	name,
	tel,
	school,
	age,
	modifytime
	) VALUES (
	'$name',
	'$tel',
	'$school',
	'$age',
	now()
	)";
	@mysql_query($query) or die('新增错误：'.mysql_error());

	error_log('query:'.$query."\r\n", 3, 'info.log');

	$idnow = mysql_insert_id(); 
	error_log('idnow:'.$idnow."\r\n", 3, 'info.log');
	  
	if ($idnow == 0) {  
	
    //******************** 配置信息 ********************************
	$smtpserver = "smtp.126.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "qiuhao8888@sina.com";//SMTP服务器的用户邮箱
	$smtpemailto = $_POST['toemail'];//发送给谁
	$smtpuser = "qiuhao8888";//SMTP服务器的用户帐号
	$smtppass = "Qh147258";//SMTP服务器的用户密码
	$mailtitle = $_POST['title'];//邮件主题
	$mailcontent = "<h1>".$_POST['content']."</h1>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	
		exit(json_encode(1)); //返回1表示注册失败  
	} else {    
		exit(json_encode(0)); //返回0表示注册成功  
	}  
	
	


}
?>

