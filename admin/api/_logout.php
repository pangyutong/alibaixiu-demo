<?php 

	//退出时清除session中保存的所有信息即可
	session_start();

	session_destroy();

	//跳转回登录页面即可
	header('Location:/admin/login.php');


 ?>