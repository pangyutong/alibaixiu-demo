<?php 

	require_once '../../config.php';
	require_once './_function.php';

	//当服务端进行数据响应时，需要进行请求数据的用户的身份认证(确定是一个登录成功的用户，再进行数据的响应)

	//调用access_test()进行检测，根据结果进行处理

	//如果为true，进行数据响应操作即可
	$bool = access_test();



	//设置content-type为json
	header('Content-type:application/json');

	if ($bool) {
		//允许进行数据获取

		//获取分类信息数据，并按照固定的接口形式响应给客户端
		$con = db_connect();
		$sql = "select * from categories;";
		$result = db_query($con, $sql);

		//将数组转换为JSON字符串形式
		$json = json_encode($result);

		//根据对应的接口结构设置响应内容
		echo '{"code":"1","result":' . $json . '}';


	} else {
		//不允许进行数据获取
		echo '{"code":"0","result":[]}';
	}


 ?>