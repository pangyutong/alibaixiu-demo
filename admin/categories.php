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
  <title>Categories &laquo; Admin</title>
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
        <h1>分类目录</h1>
      </div>
      
      <div class="row">
        <div class="col-md-4">
          <form id="form">

            <h2>添加新分类目录</h2>
            <!-- 有错误信息时展示 -->
            <div id="alert" class="alert alert-danger" style="display:none">
              请完整填写表单!
            </div>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <input id="hidden" type="hidden" name="id">
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            </div>
            <div class="form-group">
              <label for="classname">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
            </div>
            <div class="form-group">
              <span id="btn" class="btn btn-primary">添加</span>
              <span id="editBtn" class="btn btn-primary" style="display:none">编辑完成</span>
              <span id="cancelEdit" class="btn btn-primary" style="display:none">取消编辑</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <span id="delSome" class="btn btn-danger btn-sm" style="display: none">批量删除</span>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox" id="selectAll"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody id="tbody">
             <!-- 静态结构 -->
             <!--  <tr>
               <td class="text-center"><input type="checkbox"></td>
               <td>未分类</td>
               <td>uncategorized</td>
               <td class="text-center">
                 <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                 <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
               </td>
             </tr>
             <tr>
               <td class="text-center"><input type="checkbox"></td>
               <td>未分类</td>
               <td>uncategorized</td>
               <td class="text-center">
                 <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                 <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
               </td>
             </tr>
             <tr>
               <td class="text-center"><input type="checkbox"></td>
               <td>未分类</td>
               <td>uncategorized</td>
               <td class="text-center">
                 <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                 <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
               </td>
             </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <?php $current_page = 'categories'; ?>
  <?php include './public/_aside.php'; ?>
  

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>


  <script>
    $(function () {
      //元素获取
      var $tbody = $("#tbody");
      var $form = $("#form");
      var $btn = $("#btn");
      var $name = $("#name");
      var $slug = $("#slug");
      var $classname = $("#classname");
      var $alert = $("#alert");

      //1 页面加载时想服务端请求分类部分的数据
      $.ajax({
        type : "GET",
        url : "/admin/api/_getcategories.php",
        success : function (data) {
          //检测data的值，如果code的值为0，说明没有得到数据
          if (data.code === "0") {
            alert("不好意思，哥们，你没有权限！");
            return;
          }

          //根据result属性的值进行结构创建
          var result = data.result;

          //遍历
          var str = "";
          $.each(result, function (i, ele) {
            str += '<tr data-id="' + ele.id + '">\
               <td class="text-center"><input type="checkbox"></td>\
               <td>' + ele.name + '</td>\
               <td>' + ele.slug + '</td>\
               <td>' + ele.classname + '</td>\
               <td class="text-center">\
                 <span class="btn btn-info btn-xs btn-edit-cate">编辑</span>\
                 <span class="btn btn-danger btn-xs btn-del-cate">删除</span>\
               </td>\
             </tr>';
          });

          //将结构创建并添加到指定位置
          $(str).appendTo($tbody);
        }
      });

      //2 点击提交按钮，新增分类信息
      $btn.on("click", function () {
        //2.1 检测表单是否填写完整
        var nameVal = $name.val();
        var slugVal = $slug.val();
        var classnameVal = $classname.val();

        if (nameVal === "" || $slug.val() === "" || $classname.val() === "" ) {
          //让错误提示框显示
          $alert.show();
          return;
        }

        //2.2 将数据发送给服务端
        $.ajax({
          type : "POST",
          url : "/admin/api/_addcategories.php",
          data : $form.serialize(),
          success : function (data) {
           // console.log(data);

            //判断data的值，如果为成功，进行结构插入，否则进行错误提示
            if (data !== 'error') {

              //2.3 将新创建的元素添加到页面中显示
              var str = '<tr data-id=' + data + '>\
               <td class="text-center"><input type="checkbox"></td>\
               <td>' + nameVal + '</td>\
               <td>' + slugVal + '</td>\
               <td>' + classnameVal + '</td>\
               <td class="text-center">\
                 <span class="btn btn-info btn-xs btn-edit-cate">编辑</span>\
                 <span class="btn btn-danger btn-xs btn-del-cate">删除</span>\
               </td>\
             </tr>';

             $(str).appendTo($tbody);

             //2.4 最后清除输入框中的内容
             $name.val("");
             $slug.val("");
             $classname.val("");

            }
          }
        });
      });

      //3 给删除按钮添加事件
      // 通过设置事件委托，给tbody中所有的删除按钮设置事件
      $tbody.on("click", ".btn-del-cate", function () {

        //获取当前行数据的id标识
        var $tr = $(this).parents("tr");
        var id = $tr.data("id");

        //将数据发送给服务端，服务端进行删除处理即可
        $.ajax({
          type : "GET",
          url : "/admin/api/_delcategories.php",
          data : {id : id},
          success : function (data) {
            //如果data的值为"success",说明删除成功，进行结构移除即可
            if (data === "success") {
              $tr.remove();
            }
          }
        });

      });


      //4 批量删除功能
      // 元素获取：
      var $selectAll = $("#selectAll");//全选按钮
      var checkedArr = [];//用于保存选中的tr的data-id标识

      //4.1 tbody中的checkbox选中效果（手动全选）
      $tbody.on("change", "input",function () {
        //获取当前tbody中所有input
        var $ipts = $("#tbody input");

        //方式1 ：
       /* //每次事件触发时，检测所有的input的状态，如果有任何一个input没有选中，就取消$selectAll的选中
        var flag = true;
        $.each($ipts, function (i, ele) {
          //找到没有选中的元素，设置flag值为false
          if ($(ele).prop("checked") === false){
            flag = false;
          }
        });
        //根据flag的值检测是否可以选中全选按钮
        $selectAll.prop("checked", flag);
        //这种方式的缺点：每次触发事件时，均需要进行多次DOM操作*/


        //方式2：
        var id = $(this).parents("tr").data("id");
        //每次点击某个input时，将本行的data-id属性值保存在数组中
        //检测，当前是否为选中状态，分别执行数据添加与移除操作
        if ($(this).prop("checked")) {
          //说明选中，添加
          checkedArr.push(id);
        } else {
          //说明未选中，删除对应的数据
          //先找到当前id在checkedArr中的索引位置，进行删除操作 
          checkedArr.splice(checkedArr.indexOf(id), 1);
        }

        //操作后检测，checkedArr与input总数的关系，如果相同，说明可以全选
        $selectAll.prop("checked", checkedArr.length === $ipts.length);

        //显示与隐藏批量删除按钮(checkedArr长度不为0即可显示)
        checkedArr.length < 2 ? $delSome.fadeOut() : $delSome.fadeIn();


        // (可选方式) ：通过mark类名标识，可以与前面的if else合并，此处为了分步骤就不合并了。
        //点击后，给当前input设置或移除类名mark，这个mark的作用仅仅是用于表示需要删除的tr
        /*if ($(this).prop("checked")) {
          $(this).parents("tr").addClass("mark");
        } else {
          $(this).parents("tr").removeClass("mark");
        }*/

        //好处：1 DOM操作减少了   2 获取到了需要删除的数据的id值，方便了删除操作
      });

      //4.2 全选按钮操作
      $selectAll.on("change", function () {
        var $ipts = $("#tbody input");
        //根据当前复选框状态，设置所有tbody中复选框的状态
        $ipts.prop("checked", $(this).prop("checked"));

        //处理checkedArr中的数据，先进行清除，再添加，为了避免出现重复的问题
        checkedArr = [];

        //将数据进行放入操作，直接调用每个input的事件即可
        $ipts.trigger("change");
      });

      //4.3 批量删除按钮操作
      var $delSome = $("#delSome");

      $delSome.on("click", function () {

        // - 可以直接使用单个删除功能的php操作文件_delCategories.php
        // - 服务端修改：将数据库删除语句的where条件更改为 where id in (1,2,3,4) 的形式即可
        // - 服务端修改：将db_execute()函数的 `受影响行数` 检测条件修改为 `不等于0`
        // - 前端设置：将checkedArr转换为字符串后发送给服务端处理即可
        //   - 结构删除
        $.ajax({
          type : "GET",
          url : "/admin/api/_delcategories.php",
          data : {id:checkedArr.toString()},
          success : function (data) {
            //根据data的内容，进行处理
            if (data === "success") {
              //删除当前tbody中选中的input
              $("#tbody input:checked").parents("tr").remove();

              //对应使用mark类名标记的方式时使用。
              //$(".mark").remove();
            }
          }
        })

      });


      //5 编辑功能
      //为了操作简便，我们可以再设置一个新的编辑按钮，默认隐藏
      //触发编辑功能时，将其显示即可


      var $editBtn = $("#editBtn");
      var $cancelEdit = $("#cancelEdit");
      var $hidden = $("#hidden");//隐藏域

      //通过事件委托，给tbody中的所有类名为btn-edit-cate的元素设置点击事件
      $tbody.on("click", ".btn-edit-cate", function () {
        //5.1 将当前元素所在tr中的数据书写到左侧的编辑表单中
        var $tr = $(this).parents("tr");
        var $tds = $tr.children();

        //保存值
        var nameVal = $tds.eq(1).text();
        var slugVal = $tds.eq(2).text();
        var classnameVal = $tds.eq(3).text();

        //设置到输入框中
        $name.val(nameVal);
        $slug.val(slugVal);
        $classname.val(classnameVal);

        //修改编辑表单的标题h2
        $form.children("h2").text("编辑分类目录");
        //将新增按钮隐藏
        $btn.hide();

        //显示编辑完成和取消编辑按钮
        $editBtn.show();
        $cancelEdit.show();

        // --- 设置完隐藏域后，需要保存当前tr的数据的id值
        $hidden.val($tr.data("id"));
      });

      //5.2 点击取消编辑后，将内容还原为新增状态
      $cancelEdit.on("click", function () {
        //清空输入框内容
        $name.val("");
        $slug.val("");
        $classname.val("");
        //还原表单相关文字内容
        $form.children("h2").text("添加新分类目录");
        $btn.show();
        //隐藏编辑完成和取消编辑按钮
        $editBtn.hide();
        $cancelEdit.hide();
      });

      //5.3 给编辑完成按钮添加事件 
      $editBtn.on("click", function () {
        // - 设置了一个隐藏域元素用于保存要编辑的数据的id
        // - 添加一个新的编辑完成按钮
        // - 修改：在右侧列表中的编辑按钮点击事件中进行显示隐藏的设置
        // - 修改：点击取消编辑按钮时，进行显示隐藏的设置
        // - 点击编辑完成按钮时，发送请求，并在服务端做出相应处理
        $.ajax({
          type : "POST",
          url : "/admin/api/_editcategories.php",
          data : $form.serialize(),
          success : function (data) {
            //如果响应体内容为success，将编辑后的数据替换掉右侧列表中的原始数据即可
            if (data === "success") {
              //保存需要使用的表单元素值
              var idVal = $hidden.val();
              var nameVal = $name.val();
              var slugVal = $slug.val();
              var classnameVal = $classname.val();

              //根据idVal的值，到右侧查找到对应的tr
              //jQuery属性选择器
              var $tr = $tbody.children("[data-id="+idVal+"]");
              
              //进行内部的数据修改
              var $tds = $tr.children();
              $tds.eq(1).text(nameVal);
              $tds.eq(2).text(slugVal);
              $tds.eq(3).text(classnameVal);

              //将左侧的表单结构还原为新增的形式即可(与取消编辑功能代码相同)
              $name.val("");
              $slug.val("");
              $classname.val("");
              $form.children("h2").text("添加新分类目录");
              $btn.show();
              $editBtn.hide();
              $cancelEdit.hide();
            }

          }
        });

      });


    });



  </script>

</body>
</html>
