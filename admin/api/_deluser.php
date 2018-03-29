<?php 
	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {

		//接收用户传递的id参数
		$id = $_GET['id'];

		//连接数据库，删除对应数据
		$con = db_connect();

		$sql = "delete from users where id=$id;";
		$result = db_execute($con, $sql);

		echo $result ? 'success' : 'error';

	}



?>