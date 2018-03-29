<?php 

	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {
		//可以操作数据
		//1 获取POST参数
		if (isset($_POST['name']) && $_POST['name'] !== '' && isset($_POST['slug']) && $_POST['slug'] !== '' && isset($_POST['classname']) && $_POST['classname'] !== '') {
			// 有用户名参数了，进行参数保存
			$name = $_POST['name'];
			$slug = $_POST['slug'];
			$classname = $_POST['classname'];

			//2 检测当前新增的分类是否存在
			// 一个是name另一个是slug，均不允许重复
			$con = db_connect();
			$sql = "select * from categories where slug='$slug' or name='$name';";
			$result = db_query($con, $sql);

			//检测$result，如果有内容，说明不能新增
			if (count($result) === 0) {
				//3 新增操作
			
				$sql2 = "insert into categories values (null,'$slug','$name','$classname');";

				//根据结果检测是否执行成功
				$bool2 = db_execute($con, $sql2);

				//如果执行成功，获取本条数据的id
				$sql3 = "select id from categories where slug='$slug';";
				$result3 = db_query($con, $sql3);

				//响应获取到的id值
				echo count($result3) !== 0 ? $result3[0]['id'] : 'error';

			} else {
				echo 'error';
			}


			
		} 
	}
 ?>