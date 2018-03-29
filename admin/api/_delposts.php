<?php 

	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();

	if ($bool) {

		//获取id参数，进行数据删除
		$id = $_GET['id'];

		$con = db_connect();
		$sql = "delete from posts where id=$id;";
		$result = db_execute($con, $sql);

		//响应处理结果
		echo $result ? 'success' : 'error';
	}

 ?>