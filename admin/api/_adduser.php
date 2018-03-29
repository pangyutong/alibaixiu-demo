<?php 
	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {
		//检测参数是否完整


		$con = db_connect();
		//检测slug nickname email是否已经存在
		$slug = $_POST['slug'];
		$email = $_POST['email'];
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		// 保存了文件的数组
		$avatar = $_FILES['avatar'];
		$status = $_POST['status'];
		$sql = "select * from users where slug='$slug' or email='$email' or nickname='$nickname';";
		$result = db_query($con, $sql);


		//如果获取到任何一个元素，说明已经存在，响应'error'
		if (count($result) === 0) {
			//进行文件名处理以及文件的移动操作

			$random_name = uniqid() . $avatar['name'];

			move_uploaded_file($avatar['tmp_name'], '../../static/uploads/' . $random_name);

			//将数据插入到数据库中即可
			$sql2 = "insert into users values (null,'$slug','$email','$password','$nickname','/static/uploads/$random_name','','$status');";

			$result2 = db_execute($con, $sql2);

			//echo $result2 ? 'success' : 'error';

			//如果$result2为true，查询本次新增数据的id
			if ($result2) {
				$sql3 = "select id,avatar from users where slug='$slug';";
				$result3 = db_query($con, $sql3);

				header('Content-type:application/json');
				echo count($result3) !== 0 ? json_encode($result3) : 'error1';
			} else {
				echo 'error2';
			}


		} else {
			echo 'error3';
		}
	}
	?>