<?php 

	require_once '../../config.php';
	require_once './_function.php';
	//进行数据操作前先检测是否允许操作数据
	$bool = access_test();

	header('Content-type:application/json');
	if ($bool) {
		//获取posts表中的数据
		$con = db_connect();

		//由于下面有两种筛选条件，如果直接拼接，可能会出现where重复或and重复等问题
		//提前将$where 的初始值设置为 'where 1=1' , 可以让后面的新条件均已and开头
		// 注意，每个and前面要设置空格，防止语句连接在一起
		$where = 'where 1=1';
		//判断，本次请求是否含有fenlei这个参数
		if (isset($_GET['fenlei']) && $_GET['fenlei'] !== 'all') {
			//设置条件，并添加到$sql中
			$fenlei = $_GET['fenlei'];
			$where .= " and posts.category_id=$fenlei";
		}

		// 判断，如果含有status参数，设置对应的筛选条件即可
		if (isset($_GET['status']) && $_GET['status'] !== 'all') {
			$status = $_GET['status'];
			$where .= " and posts.status='$status'";
		}


		//检测是否含有分页参数page，如果有，设置limit的值即可
		$limit = 0;
		if (isset($_GET['page'])) {
			//根据当前页号，计算limit的参数1
			//limit (n-1)*20,20
			$page = $_GET['page'];
			$limit = ($page - 1) * 20;
		}


		//数据获取：
		$sql = "select posts.title,posts.created,posts.id,posts.status,users.slug,categories.name 
			from posts 
			inner join users on posts.user_id=users.id
			inner join categories on posts.category_id=categories.id
			$where
			limit $limit,20;";
		$result = db_query($con, $sql);

		$json = json_encode($result);


		//为了制作分页效果，还需要响应本次数据库查询操作的总数据条数
		$sql1 = "select count(1) as num
			from posts 
			inner join users on posts.user_id=users.id
			inner join categories on posts.category_id=categories.id
			$where";
		$result1 = db_query($con, $sql1);

		// print_r($result1);
		//本次查询的数据总条数
		// echo $result1[0]['num'];

		//本次查询的数据结果
		// echo $json;

		//两个数据均要进行响应，所以需要进行接口化的处理(注意字符串拼接等问题，要看准位置！)
		echo '{"code":"1","result":' . $json . ',"count":' . $result1[0]['num'] . '}';
	}

 ?>