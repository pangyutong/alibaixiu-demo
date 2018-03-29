<?php 

	require '../../config.php';
	require './_function.php';
	//进行登录校验

	//1 接收用户传递的参数
	if (!isset($_POST['email']) || $_POST['email'] === '') {
		return;
	}
	if (!isset($_POST['password']) || $_POST['password'] === '') {
		return;
	}

	$email = $_POST['email'];
	$password = $_POST['password'];
	//连接数据库
	$con = db_connect();
	$sql = "select * from users where email='$email' and password='$password';";
	$result = db_query($con, $sql);

	// 如果$result中含有一个元素，说明登录可以成功，否则失败
	if (count($result) === 0) {
		echo 'no';
	} else {
		// 使用session保存登录状态
		session_start();

		//保存登录成功的标识
		$_SESSION['is_login'] = 'yes';

		//保存当前用户的用户名和密码信息
		$_SESSION['user_info'] = array(
			'email' => $email,
			'password' => $password
		);

		//登录成功后，检测，是否存在current_path，如果有，响应给客户端即可
		echo isset($_SESSION['current_path']) ? $_SESSION['current_path'] : '';
		//echo 'yes';
	}

 ?>
