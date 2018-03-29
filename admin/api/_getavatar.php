<?php 
	require '../../config.php';
	require './_function.php';

	//根据用户传递的邮箱，查询头像地址
	$con = db_connect();
	$email = $_POST['email'];

	$sql = "select avatar from users where email='$email';";
	$result = db_query($con, $sql);

	
	//检测$result的值，如果没有查询到结果，响应no，否则响应头像地址
	if (count($result) === 0) {
		echo 'no';
	} else {
		echo $result[0]['avatar'];
	}
 ?>