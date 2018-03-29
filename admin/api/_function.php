<?php 
	
	// 用于进行数据库连接的函数
	function db_connect () {
		$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		return $con;
	}

	// 用于进行数据库查询操作的函数
	function db_query ($con, $sql) {
		$result = mysqli_query($con, $sql);

		// 提前声明保存结果的数组，防止报错
		$arr = [];
		while ($result_arr = mysqli_fetch_assoc($result)) {
			$arr[] = $result_arr;
		}
		// 返回$arr
		return $arr;
	}

	//用于检测用户的登录状态以及当前页面路径的保存
	function login_test () {
		session_start();

	  if (!isset($_SESSION['is_login'])) {
	    //当访问本页面时，有可能没有登录
	    //希望登录后可以跳回到当前页面
	    //需要记录当前页面的路径
	    $_SESSION['current_path'] = $_SERVER['PHP_SELF'];

	    //没有登录，跳回登录页即可
	    header('Location:./login.php');
	  } 
	}

	//数据获取权限检测
	function access_test () {
	/*		//获取session中的数据
	session_start();

	//检测session中是否存在用户的信息
	if (!isset($_SESSION['user_info'])) {

		//说明没有用户信息

		// 响应的数据应当满足数据接口的形式
		// code属性表示数据是否允许获取，如果为0，表示不允许，如果为1，表示允许
		echo '{"code":"0","result":[]}';
	} else {

		//说明有当前用户的信息，进行查询
	
		$email = $_SESSION['user_info']['email'];
		$password = $_SESSION['user_info']['password'];

		
		//进行数据库查询操作
		$con = db_connect();

		//查询操作
		$sql = "select * from users where email='$email' and password='$password';";
		$result = db_query($con, $sql);

		//根据用户查询的结果进行检测

		if (count($result) === 0) {
			//说明用户的信息不正确
			echo '{"code":"0","result":[]}';

		} else {
			//说明用户的信息正确，进行分类数据获取，响应给客户端即可

			

		}
	}*/

	//修改后的代码：
	//当前函数的作用用于检测本次请求是否被允许获取数据，返回布尔值

	//1 开启session
	session_start();

	//2 检测session中是否存在用户的信息
	if (!isset($_SESSION['user_info'])) {
		return false;
	} 

	//3 说明有当前用户的信息，进行查询
	$email = $_SESSION['user_info']['email'];
	$password = $_SESSION['user_info']['password'];
	
	//进行数据库查询操作
	$con = db_connect();
	$sql = "select * from users where email='$email' and password='$password';";
	$result = db_query($con, $sql);

	//4 根据用户查询的结果进行检测
	return count($result) === 0 ? false : true;


}



	//执行增删改操作的函数
	function db_execute ($con, $sql) {
		$result = mysqli_query($con, $sql);

		//检测受影响行数
		/*if (mysqli_affected_rows($con) === 1) {
			return true;
		} else {
			return false;
		}
		*/
		return mysqli_affected_rows($con) !== 0 ? true : false;
	}

?>