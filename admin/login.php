<?php 

  //如果已经登录过了，就不允许访问login.php了
  session_start();

  if (isset($_SESSION['is_login'])) {
    header('Location:./index.php');
  }


 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <style>
    #alert {
      display: none;
    }
  </style>
</head>
<body>
  <div class="login">
    <form class="login-wrap" id="form">
      <img id="avatar" class="avatar" src="/static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" id="alert">
        <strong>错误！</strong> 用户名或密码错误！
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus name="email">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码" name="password">
      </div>
      <span class="btn btn-primary btn-block" id="btn">登 录</span>
    </form>
  </div>

  <!-- 引入文件 -->
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  
  <script>
    $(function () {

      //点击登录按钮时
      // 1 表单的内容基本验证
      // 2 将数据发送给服务端进行正确性检测
      // 3 如果用户名密码正确，跳转到首页即可

      var $email = $("#email");
      var $password = $("#password");
      var $btn = $("#btn");
      var $alert = $("#alert");
      var $form = $("#form");
      var $avatar = $("#avatar");

      //点击提交按钮
      $btn.on("click", function () {
        //1 内容校验
        if (!/^\w+@\w+\.\w+$/.test($email.val()) || $password.val().length < 6) {
          //说明输入框内容是不正确的，弹出错误提示框
          $alert.show();

          //同时设置return，阻止数据发送
          return;
        }

        //2 通过检测后，将数据发送到服务端进行数据校验
        $.ajax({
          type : "POST",
          url : "/admin/api/_login.php",
          data : $form.serialize(),
          success : function (data) {
            //响应的内容是yes或no，做出对应处理即可
            if (data !== "no") {
              //根据响应体的内容，判断要跳转的路径
              //跳转到首页
              location.href = data ? data : "/admin/index.php";
            } else {
              $alert.show();
            }
          }
        });
      });



      //当邮箱输入框获取焦点时，将错误提示框隐藏
      $email.on("focus", function () {
         $alert.hide();
      });

      //当邮箱输入框失去焦点时，获取当前用户的用户头像地址
      $email.on("blur", function () {
        //检测用户名是否符合规则
        var value = $email.val();
        if (!/^\w+@\w+\.\w+$/.test(value)) {
          $alert.show();
          return;
        }

        //请求当前用户的头像地址
        $.ajax({
          type : "POST",
          data : {email : value},
          url : "/admin/api/_getavatar.php",
          success : function (data) {
            //data可能为两种情况，"no" 或头像地址字符串
            if (data !== "no") {
              $avatar.fadeOut(function () {
                //渐出后执行操作
                $avatar.prop("src", data).fadeIn();

              });
            } else {
              //没有对应的用户头像信息，设置为默认的图片即可
              $avatar.fadeOut(function () {
                //渐出后执行操作
                $avatar.prop("src", "/static/assets/img/default.png").fadeIn();

              });
              
            }


          }
        });
      });
    });

  </script>

</body>
</html>

