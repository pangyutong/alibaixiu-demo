<?php 
	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {
		header('Content-type:application/json');

		//连接数据库查询数据
		$con = db_connect();

	 	$sql = "select * from users;";
	 	$result = db_query($con, $sql);

	 	echo '{"code":"1","result":' . json_encode($result) . '}';

	}

 ?>