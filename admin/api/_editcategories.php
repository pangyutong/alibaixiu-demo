<?php 

	require_once '../../config.php';
	require_once './_function.php';

	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {
		//检测请求参数是否为空
		if (isset($_POST['id']) && $_POST['id'] !== '' && isset($_POST['name']) && $_POST['name'] !== '' && isset($_POST['slug']) && $_POST['slug'] !== '' && isset($_POST['classname']) && $_POST['classname'] !== '') {

			//进行数据的修改
			$con = db_connect();

			$id = $_POST['id'];
			$name = $_POST['name'];
			$slug = $_POST['slug'];
			$classname = $_POST['classname'];

			$sql = "update categories set name='$name',slug='$slug',classname='$classname' where id=$id;";
			$result = db_execute($con, $sql);

			//根据$result的结果进行响应
			echo $result ? 'success' : 'error';

		}	 else {
			echo 'error';
		}

	} else {
		echo 'error';
	}

 ?>