<?php 
	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {

		//获取comments表中的前20条数据
		$con = db_connect();

		//数据获取

		//检测，如果含有page参数，计算后设置在sql语句中即可
		$limit = 0;
		if (isset($_GET['page'])) {
			$limit = ($_GET['page'] - 1) * 20;
		}

		$sql = "select * from comments limit $limit,20;";
		$result = db_query($con, $sql);


		//数据条数获取
		$sql2 = "select count(1) as num from comments;";
		$result2 = db_query($con, $sql2);


		header('Content-type:application/json');
		echo count($result) !== 0 ? '{"code":"1","result":' . json_encode($result) . ',"count":' . $result2[0]['num'] . '}' : 'error';

	}
 ?>