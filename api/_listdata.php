<?php 
	// 本php文件是一个数据接口，用于获取列表页的数据
	
	//1 接收GET参数id和count
	$id = $_GET['id'];
	//	根据count计算出数据库查询语句需要的数据
	$count = ($_GET['count'] - 1) * 10;

	//2 根据id查询对应数据
	// 2.1 引入config.php
	require_once '../config.php';

	// 2.2 连接数据库
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// 2.3 查询数据库
  //在进行数据库查询时，由于需要多次请求不同数据，客户端还需要传递另一个“次数”参数
	$sql = "select posts.id,posts.title,posts.content,posts.created,posts.views,posts.likes,users.slug,categories.name
     from posts
    inner join users on posts.user_id=users.id
    inner join categories on posts.category_id=categories.id
    where category_id=$id
    order by created desc
    limit $count,10;";

  // 2.4 查询数据与拉取
   $result = mysqli_query($con, $sql);

   //提前进行数组的声明，可以防止数据全部查询完毕后，出现报错
   $arr = [];
   while ($result_arr = mysqli_fetch_assoc($result)) {
   	$arr[] = $result_arr;
   }

   // 2.5 转换为JSON字符串后响应给客户端即可
   header('Content-type:application/json');
   echo json_encode($arr);




 ?>