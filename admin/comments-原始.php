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
  <title>Comments &laquo; Admin</title>
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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right" id="list">
        <!--   <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li> -->
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <!-- <tr class="danger">
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  
  <?php $current_page = 'comments'; ?>
  <?php include './public/_aside.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/static/assets/vendors/twbs-pagination/jquery.twbsPagination.js"></script>
  <script>NProgress.done()</script>

  <!-- 模板引擎
          作用：用于进行结构的动态创建

       使用方式：
          1 引入文件
          2 设置模板
          3 导入数据
          4 生成结构
   -->
  
  <script src="/static/assets/vendors/art-template/template-web.js"></script>
  <!-- art-template使用script标签作为模板的载体
        原因：script标签内部的内容只有设置type为text/javascript时，才会当做js执行，如果不是，就不会执行
   -->
  <script type="text/art-template">

    {{$data}}
  
    {{each $data value key}}
      
      我是索引 {{key}} , 我是值{{value}}

    {{/each}}


    {{if typeof $data === "object"}}
        这是一个对象
    {{else if typeof $data === "string"}}
        这是一个字符串
    {{else}}
        这不知道是什么
    {{/if}}


    <% for(var i = 0; i<10; i++) { %>
    
      我是内容！！！
    
    <% } %>

    <% for(var k in $data) { %>
    
      我是内容！！！
    
    <% } %>
  </script>


  <!-- 用于创建评论表格结构的模板 -->
  <script type="text/art-template" id="template">
    {{each $data value}}
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td>{{value.author}}</td>
      <td style="width:500px">{{value.content}}</td>
      <td>{{value.post_id}}</td>
      <td>{{value.created}}</td>
      <td>{{value.status}}</td>
      <td class="text-center">
        <a href="post-add.php" class="btn btn-warning btn-xs">驳回</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
    {{/each}}
  </script>
  <script>
    //发送ajax请求，进行数据获取
    var $tbody = $("#tbody");
    var $list = $("#list");
    /* 
    // 操作步骤：
    //1 使用模板引擎，必须给模板引擎设置id
    //2 调用art-template的方法template(模板id,数据对象)
    //3 将返回值设置给某个元素的html() 或innerHTML属性
    var str = template("template", {name:"jack", age:18, gender:"male"});
    $box.html(str);*/

    $.ajax({
      type : "GET",
      url : "/admin/api/_getcomments.php",
      success : function (data) {
        //检测，data.code的值，如果为1，进行结构创建
        if (data.code === "1") {
          //保存所有数据
          var result = data.result;

          //使用模板引擎进行结构的渲染
          var str = template("template", result);
          //进行创建
          $tbody.html(str);

          //保存数据总条数
          var count = data.count;
          //计算总页数
          var totalPage = Math.ceil(count / 20);

          //根据本次查询的总数据条数设置分页（用于计算总页数）
          $list.twbsPagination({
            //总页数
            totalPages : totalPage,
            //当前显示多少个页
            visiblePages : 5,
            //当某个分页按钮被点击时触发
            onPageClick : function (event, page) {
              //事件处理程序的形参2为当前页数

              //将page属性的值发送给服务端，服务端响应对应的数据即可
              $.ajax({
                type : "GET",
                url : "/admin/api/_getcomments.php",
                //将页号发送给服务端
                data : {page : page},
                success : function (data) {
                  var result = data.result;
                  //使用模板引擎进行结构的渲染
                  var str = template("template", result);
                  //进行创建
                  $tbody.html(str);
                }
              });

            }
          });
        }
      }
    });

   


   

  </script>




</body>
</html>
