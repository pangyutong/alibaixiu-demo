<?php 

  require_once '../config.php';
  require_once './api/_function.php';

  //检测，当前是否为登录成功的状态
  login_test();
  

 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form id="form" class="row" action="/admin/api/_addpost.php" method="POST">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <option value="1">未分类</option>
              <option value="2">潮生活</option>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <span class="btn btn-primary" id="btn">保存</span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <textarea name="" id="content2" cols="30" rows="10"></textarea>

  <?php $current_page = 'post-add'; ?>
  <?php include './public/_aside.php'; ?>
  

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>


  <!-- 使用ckeditor需要引入两个主要的文件 -->
  <script src="/static/assets/vendors/ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" href="/static/assets/vendors/ckeditor/contents.css">
  
  <script>
    //富文本(有格式的文本)编辑器 - 插件

    CKEDITOR.replace("content");
    // CKEDITOR.replace("content2");

    //将富文本编辑器的内容提交给服务端的两种方式:
    //1 表单提交方式
    //  无脑提交

    //2 ajax提交方式
    var $form = $("#form");
    var $btn = $("#btn");
    var $textarea = $("#textarea");
    
    //当我们使用表单获取文本域内容时，文本域是空的，所以没有内容

    //需要进行处理后再使用：
    // - CKEDITOR.instances属性中保存了所有实例
    // - 调用富文本编辑器实例方法updateElement()，可以将内容添加到文本域中
    //      CKEDITOR.instances.content.updateElement();

    $btn.on("click", function () {
       //遍历所有实例，进行内容设置：
       for (var k in CKEDITOR.instances) {
         CKEDITOR.instances[k].updateElement();
       }
       $.ajax({
        type : "POST",
        url : "/admin/api/_addpost.php",
        data : $form.serialize(),
        success : function (data) {
          console.log(data);
        }
      });
    });








  </script>
</body>
</html>
