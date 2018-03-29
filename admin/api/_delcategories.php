<?php 

	require_once '../../config.php';
	require_once './_function.php';

	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {

		//获取用户传递的id参数
		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			//进行删除操作
			$con = db_connect();

			$sql = "delete from categories where id in ($id);";
			$bool2 = db_execute($con, $sql);

			//根据$bool的值检测是否处理成功
			echo $bool2 ? 'success' : 'error';
		}

	}
 ?>