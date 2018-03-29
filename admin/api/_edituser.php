<?php 
	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();
	if ($bool) {
		//检测参数是否完整

		$con = db_connect();
		$slug = $_POST['slug'];
		$email = $_POST['email'];
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		// 保存了文件的数组
		$avatar = $_FILES['avatar'];
		$status = $_POST['status'];
		$id = $_POST['id'];

		//找到对应的数据，进行修改操作即可
		$random_name = uniqid() . $avatar['name'];

		move_uploaded_file($avatar['tmp_name'], '../../static/uploads/' . $random_name);

		$sql = "update users set slug='$slug', nickname='$nickname',email='$email',password='$password',avatar='/static/uploads/$random_name',status='$status' where id=$id;";

		$result = db_execute($con, $sql);

		// echo $result ? 'success' : 'error';

		//修改成功后，获取到保存后的文件位置
		if ($result) {
			$sql3 = "select avatar from users where slug='$slug';";
			$result3 = db_query($con, $sql3);

			header('Content-type:application/json');
			echo count($result3) !== 0 ? json_encode($result3) : 'error';
		} else {
			echo 'error';
		}

	}

 ?>