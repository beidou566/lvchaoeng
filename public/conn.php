<?php
	error_reporting(0); 
	header('Content-Type:text/html;charset=utf-8');
	
	define('DB_HOST','127.0.0.1');
	define('DB_USER','root');
	define('DB_PWD','111111');
	define('DB_NAME','lvchaoeng');
	
	$conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD) or die(header("Location: help.php"));
	
	mysql_select_db(DB_NAME) or die(header("Location: help.php"));
	mysql_query('SET NAMES UTF8') or die('字符集设置错误'.mysql_error());
	date_default_timezone_set('PRC'); 
?>