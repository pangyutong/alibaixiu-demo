<?php 
  require_once '../config.php';
  require_once './api/_function.php';

  //检测，当前是否为登录成功的状态
  $users = login_test();
  

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include './public/_navbar.php'; ?>
   
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="form">
            <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <!-- 用于保存id值 -->
            <input type="hidden" name="id" id="hidden">
             <div class="form-group">
              <label for="avatar">上传头像</label>
              <input id="avatar" class="form-control" name="avatar" type="file">
            </div>
             <div class="form-group">
              <label for="status">状态</label>
             <select name="status" id="status" class="form-control input-bg">
               <option value="-1">未选择</option>
               <option value="activated">已激活</option>
             </select>
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <span class="btn btn-primary" id="btn">添加</span>
              <span class="btn btn-primary" style="display: none" id="edit">编辑</span>
              <span class="btn btn-primary" style="display: none" id="cancel">取消</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="/static/assets/img/default.png"></td>
                <td>i@zce.me</td>
                <td>zce</td>
                <td>汪磊</td>
                <td>激活</td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="/static/assets/img/default.png"></td>
                <td>i@zce.me</td>
                <td>zce</td>
                <td>汪磊</td>
                <td>激活</td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="/static/assets/img/default.png"></td>
                <td>i@zce.me</td>
                <td>zce</td>
                <td>汪磊</td>
                <td>激活</td>
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php $current_page = 'users'; ?>
  <?php include './public/_aside.php'; ?>
  

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  

  <script>
    // - 获取数据并展示：
    //    1 静态结构处理 (设置id等内容，将静态结构设置为字符串) 
    //    2 ajax请求服务端数据
    //    3 接收响应数据，渲染结构

    var $form = $("#form");
    var $tbody = $("#tbody");
    var $btn = $("#btn");
    var $email = $("#email");
    var $slug = $("#slug");
    var $nickname = $("#nickname");
    var $avatar = $("#avatar");
    var $password = $("#password");
    var $status = $("#status");
    var $hidden = $("#hidden");
    var $edit = $("#edit");
    var $cancel = $("#cancel");

    var statusObj = {
      activated : "已激活"
    };
    $.ajax({
      type : "GET",
      url : "/admin/api/_getusers.php",
      success : function (data) {
        //检测code属性的值，如果为1，进行结构创建
        if (data.code === "1") {
          var result = data.result;
          var str = "";
          $.each(result, function (i, ele) {
            str += '<tr data-id="' + ele.id + '">\
                    <td class="text-center"><input type="checkbox"></td>\
                    <td class="text-center"><img class="avatar" src="' + ele.avatar + '"></td>\
                    <td>' + ele.email + '</td>\
                    <td>' + ele.slug + '</td>\
                    <td>' + ele.nickname + '</td>\
                    <td>' + statusObj[ele.status] + '</td>\
                    <td class="text-center">\
                      <span class="btn btn-default btn-xs btn-edit-user">编辑</span>\
                      <span class="btn btn-danger btn-xs btn-del-user">删除</span>\
                    </td>\
                  </tr>';
          });
          //生成结构
          $tbody.html(str);
        }
      }
    });

    // - 删除功能
    //    1 结构处理：渲染结构时添加自定义属性，用于保存数据id
    //    2 发送ajax请求，服务端删除对应数据
    //    3 服务端操作成功，从页面删除结构即可
    $tbody.on("click", ".btn-del-user", function () {
      var $tr = $(this).parents("tr");
      var id = $tr.data("id");

      $.ajax({
        type : "GET",
        url : "/admin/api/_deluser.php",
        data : {id : id},
        success : function (data) {

          //如果data为success，删除对应的结构即可
          if (data === "success") {
            $tr.remove();
          }
        }
      });
    });

    // - 新增功能
    $btn.on("click", function () {
      var email = $email.val();
      var slug = $slug.val();
      var nickname = $nickname.val();
      var avatar = $avatar.val();
      var password = $password.val();
      var status = $status.val();

      //检测所有的表单元素内容是否为空等。。

      //将数据发送到服务端即可
      $.ajax({
        type : "POST",
        url : "/admin/api/_adduser.php",
        // data : $form.serialize(),
        data : new FormData($form[0]),
        contentType : false,
        processData : false,
        success : function (data) {
          //console.log(data);
          //检测，如果响应不为error，则创建右侧表格结构即可
          if (data !== "error") {
            var str = '<tr data-id="' + data[0].id + '">\
                      <td class="text-center"><input type="checkbox"></td>\
                      <td class="text-center"><img class="avatar" src="' + data[0].avatar + '"></td>\
                      <td>' + email + '</td>\
                      <td>' + slug + '</td>\
                      <td>' + nickname + '</td>\
                      <td>' + statusObj[status] + '</td>\
                      <td class="text-center">\
                        <span class="btn btn-default btn-xs btn-edit-user">编辑</span>\
                        <span class="btn btn-danger btn-xs btn-del-user">删除</span>\
                      </td>\
                    </tr>';
            //生成结构
            $tbody.append(str);

            //清空表单内容
            $email.val("");
            $slug.val("");
            $nickname.val("");
            $avatar.val("");
            $password.val("");
            $status.val("");
          }
        }
      })
    });

    // - 编辑功能
    $tbody.on("click", ".btn-edit-user", function () {
      //进行按钮的显示隐藏操作
      $btn.hide();
      $edit.show();
      $cancel.show();

      //获取当前行内的数据，写入到左侧的表单中
      var $tr = $(this).parents("tr");
      var $tds = $tr.children();

      var emailVal = $tds.eq(2).text();
      var slugVal = $tds.eq(3).text();
      var nicknameVal = $tds.eq(4).text();
      var statusVal = $tds.eq(5).text();
      var idVal = $tr.data("id");


      //写入
      $email.val(emailVal);
      $slug.val(slugVal);
      $nickname.val(nicknameVal);
      $hidden.val(idVal);

      //状态检测，如果状态值为已激活，设置activated勾选
      //$status.val(statusVal);

      if (statusVal === "已激活") {
        $status.children('[value="activated"]').prop("selected", true);
      }


    });

    // 点击编辑完成按钮
    $edit.on("click", function () {
      //1 检测表单是否填写完整
      //2 发送请求，将数据提交给服务端
      $.ajax({
        type : "POST",
        url : "/admin/api/_edituser.php",
        data : new FormData($form[0]),
        contentType : false,
        processData : false,
        success : function (data) {
          //检测，如果处理成功，将内容填写回表格即可
          if (data !== "error") {
            var email = $email.val();
            var slug = $slug.val();
            var nickname = $nickname.val();
            var avatar = $avatar.val();
            var password = $password.val();
            var status = $status.val();
            var id = $hidden.val();

            //找到表格中需要修改的位置
            if ($tbody.children("[data-id="+id+"]")) {
              var $tr = $tbody.children("[data-id="+ id +"]");

              var str = '<td class="text-center"><input type="checkbox"></td>\
                    <td class="text-center"><img class="avatar" src="' + data[0].avatar + '"></td>\
                    <td>' + email + '</td>\
                    <td>' + slug + '</td>\
                    <td>' + nickname + '</td>\
                    <td>' + statusObj[status] + '</td>\
                    <td class="text-center">\
                      <span class="btn btn-default btn-xs btn-edit-user">编辑</span>\
                      <span class="btn btn-danger btn-xs btn-del-user">删除</span>\
                    </td>';
              $tr.html(str);
             
            }

          }
        }
      })

    });

  </script>
</body>
</html>
