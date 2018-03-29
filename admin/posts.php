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
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">

    <?php include './public/_aside.php'; ?>
  
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form id="form" class="form-inline">

          <!-- 分类静态结构的位置 -->
          <select id="fenlei" name="fenlei" class="form-control input-sm">
            <option value="all">所有分类</option>
          </select>

          <!-- 状态与分类不同，不需要进行动态创建 -->
          <select id="status" name="status" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="published">已发布</option>
            <option value="drafted">草稿</option>
            <option value="trashed">已删除</option>
          </select>
          <span id="shaixuan" class="btn btn-default btn-sm">筛选</span>
        </form>
        <!-- 分页结构放置的位置 -->
        <ul id="fenye" class="pagination pagination-sm pull-right">
          <!-- <li><a href="#">上一页</a></li>
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
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody id="tbody">
         <!--  <tr>
           <td class="text-center"><input type="checkbox"></td>
           <td>随便一个名称</td>
           <td>小小</td>
           <td>潮科技</td>
           <td class="text-center">2016/10/07</td>
           <td class="text-center">已发布</td>
           <td class="text-center">
             <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
             <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
           </td>
         </tr>
         <tr>
           <td class="text-center"><input type="checkbox"></td>
           <td>随便一个名称</td>
           <td>小小</td>
           <td>潮科技</td>
           <td class="text-center">2016/10/07</td>
           <td class="text-center">已发布</td>
           <td class="text-center">
             <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
             <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
           </td>
         </tr>
         <tr>
           <td class="text-center"><input type="checkbox"></td>
           <td>随便一个名称</td>
           <td>小小</td>
           <td>潮科技</td>
           <td class="text-center">2016/10/07</td>
           <td class="text-center">已发布</td>
           <td class="text-center">
             <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
             <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
           </td>
         </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  <?php $current_page = 'posts'; ?>
  <?php include './public/_aside.php'; ?>
  

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>

  <script>
    //1 页面加载时，获取文章数据(前100条),并进行结构渲染

    // 基本步骤：
    // - 客户端：发送ajax请求
    // - 服务端：基本检测
    // - 服务端：数据获取与处理
    // - 客户端：接收响应数据，生成结构

    var $tbody = $("#tbody");
    var $fenlei = $("#fenlei");
    var $status = $("#status");
    var $shaixuan = $("#shaixuan");//筛选按钮
    var $form = $("#form");
    var $fenye = $("#fenye");//分页结构放置的位置ul

    

    // --------分页部分功能-------
    //分页需要当前数据总条数(到服务端进行获取，每次进行页面数据获取时都要响应当前的数据条数)
    var page;
    //分页需要每页显示的数据条数（自己想好即可）
    var size = 20;
    //分页需要知道当前显示的是哪一页数据(默认为1)
    var currentPage = 1;



    //1.1 发送ajax请求：获取展示的数据
    $.ajax({
      type : "GET",
      url : "/admin/api/_getposts.php",
      success : function (data) {
        //data为一个对象结构，具有三个属性，count code  result

        var count = data.count;
        //console.log(count);

        //1.2 遍历data，进行结构创建
        var result = data.result;
        //根据数据渲染结构
        renderData(result, $tbody);

        // --------- 初始化分页的结构 ---------
        // 根据数据总条数与每页显示的数据条数计算出总页数（计算结果向上取整）
        page = Math.ceil(count / size);

        // - 渲染分页结构
        renderFenye(currentPage, page, $fenye);

        // --------- 给每个分页按钮设置点击事件 ---------
        $fenye.on("click", ".item", function () {
          // 点击时，表示更换了新的一页进行显示，需要保存当前显示的页数
          //    - 基本想法：通过观察我们发现每个按钮中有数字，但是下一页是没有数字的
          //    - 最终设置方式：给每个li设置data-page属性，用于保存点击后要显示的页号
          //       - 点击后，将当前li的data-page属性保存在currentPage中
          
          currentPage = $(this).data("page");
          //下一步需要考虑，点击后重设分页按钮为几到几的内容

          // - 渲染分页结构
          renderFenye(currentPage, page, $fenye);

          // -------- 分页请求新的数据并进行结构创建 --------- 
          $.ajax({
            type : "GET",
            // 点击分页按钮时，需要考虑，如果当前进行过筛选，筛选参数也是必须的
            // 为了设置方便，可以直接将筛选参数拼接在url后，记得提前设置?
            url : "/admin/api/_getposts.php?" + $form.serialize(),
            //将当前页发送给服务端
            data : {page : currentPage},
            success : function (data) {
              //得到了新的数据，进行结构创建（与以前的方式完全相同）
               $tbody.empty();//清空内部所有内容

               var result = data.result;
               //根据数据渲染结构
               renderData(result, $tbody);
            }
          });

        });
      }
    });

    //2 删除功能
    $tbody.on("click", ".btn-del-post", function () {
      //将当前按钮所在行的id发送给服务端进行删除处理
      var tr = $(this).parents("tr");
      var id = $tr.data("id");

      $.ajax({
        type : "GET",
        url : "/admin/api/_delposts.php",
        data : {id:id},
        success : function (data) {
          //如果相应结果为success，进行结构删除处理
          if (data === "success") {
            $tr.remove();
          }
        }
      });
    });


    //3 筛选功能
    //3.1 获取分类数据，进行结构创建
    // 由于分类操作页面中有获取所有分类的页面 _getcategories.php,可以借助这个页面得到所有的分类信息
    $.ajax({
      type : "GET",
      url : "/admin/api/_getcategories.php",
      success : function (data) {
        //检测响应数据的code属性，如果为1，进行结构创建
        if (data.code === "1") {
          var str = "";
          var result = data.result;

          $.each(result, function (i, ele) {
            str += '<option value="' + ele.id + '">' + ele.name + '</option>';
          });
          //添加到页面中
          $fenlei.append(str);
        }
      }
    });

    //3.2 点击筛选按钮
    $shaixuan.on("click", function () {
      //发送ajax请求
      $.ajax({
        type : "GET",
        //通过观察我们发现，筛选功能实际上是基于基本的获取功能的，只是添加了一些筛选条件而已
        url : "/admin/api/_getposts.php",
        // 含有分类和状态两种筛选参数
        data : $form.serialize(),
        success : function (data) {
          $tbody.empty();//清空内部所有内容
          var str = "";
          var result = data.result;
          var count = data.count;
          
          //根据获取的数据创建结构
          renderData(result, $tbody);

            //将分页的结构进行重置:
            // - 重置当前页数
            currentPage = 1;
            // - 初始化总页数
            page = Math.ceil(count / size);

            // - 渲染分页结构
            renderFenye(currentPage, page, $fenye);
        }
      });

    });

    //封装函数
    //1 用于创建表格结构的函数
    function renderData(data, element) {
      //设置对象，用于记录状态的中英文对应结构
      var statusObj = {
        published : "已发布",
        drafted : "草稿",
        trashed : "已删除"
      };

      var str = "";
      $.each(data, function (i, ele) {
       str += '<tr data-id=' + ele.id + '>\
          <td class="text-center"><input type="checkbox"></td>\
          <td>' + ele.title + '</td>\
          <td>' + ele.slug + '</td>\
          <td>' + ele.name + '</td>\
          <td class="text-center">' + ele.created + '</td>\
          <td class="text-center">' + statusObj[ele.status] + '</td>\
          <td class="text-center">\
            <span class="btn btn-default btn-xs ">编辑</span>\
            <span class="btn btn-danger btn-xs btn-del-post">删除</span>\
          </td>\
        </tr>';
       });
       $(str).appendTo(element);
    }

    //2 用于创建分页按钮结构的函数
    function renderFenye (currentPage, page, element) {
      //起始页号为currentPage - 2,但是不能小于1，如果小于1，设置为1即可
      var begin = currentPage - 2;
      if (begin < 1) {
        begin = 1;
      }

      //修改了begin的值后，可能导致begin到end的总数不够5个，可以根据begin的值设置end的值
      var end = begin + 4;
      //修改了end后，end可能会超出右侧的最大值(总页数)，设置为总页数即可
      if (end > page) {
        end = page;
      }
      
      // -------- 创建新的分页按钮结构 --------
      //结构处理分为三个部分
      var str = "";

      //如果当前页号大于1，才设置上一页按钮的结构
      if (currentPage > 1) {
        str += '<li data-page="' + (currentPage - 1) + '" class="item"><a href="javascript:;">上一页</a></li>';
      }

      //设置为begin到end之间的值
      for (var i = begin; i <= end; i++) {
        //如果i与currentPage相等，设置active类名即可
        str += '<li data-page="' + i + '" class="item ' + (i === currentPage ? "active" : "") + '"><a href="javascript:;">' + i + '</a></li>';
      }
       //如果当前页号小于总页数，才设置下一页按钮的结构
      if (currentPage < page) {
        str += '<li data-page="' + (currentPage + 1) + '" class="item"><a href="javascript:;">下一页</a></li>';
      }
      //创建结构
      element.html(str);
    }



  </script>
</body>
</html>
