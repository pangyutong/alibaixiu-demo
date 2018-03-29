<?php 
  require_once './config.php';
  //1 进行数据库连接操作
  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="/static/assets/css/style.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>

    <!-- 引入公共区域 -->
    <?php include './public/_header.php'; ?>

    <?php include './public/_aside.php'; ?>


    <div class="content">
      <div class="panel new" id="content-box">
        <!-- 分类额标题 -->
        <h3>会生活</h3>

        <!-- 静态结构 -->
        <!--     
        <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <div class="entry">
          <div class="head">
            <a href="javascript:;">星球大战：原力觉醒视频演示 电影票68</a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 2015-06-29</p>
            <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>
            <p class="extra">
              <span class="reading">阅读(3406)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(167)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>  -->

        <div class="loadmore">
          <span>点击加载更多</span>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script>
    $(function () {
      //当页面加载时，发送ajax请求，向服务端请求列表数据

      //1 进行id参数的获取
      //使用location.search属性，结构是以?开头的一个字符串
      //经过处理后，结果为一个字符串，是需要发送给服务端的id参数
      var getParams = location.search.slice(1).split("=")[1];

      //2 向某个php页面发送请求，用于进行数据获取
      //这个php文件就可以称为数据接口
      //从0和1开始均可，只不过在服务端处理时，一个不需要减1，一个需要减1
      //var count = 1;

      // $.ajax({
      //   type : "GET",
      //   url : "/api/_listdata.php",
      //   // 将id传递到服务端
      //   // 将请求的次数传递到服务端
      //   data : {id : getParams, count : count},
      //   success : function (data) {
      //     //data是一个数组，内部的每个对象表示一个文章所需要的结构
      //     $.each(data, function (i, ele) {
      //       //使用jq选择器时，如果字符串内容中使用了\，可以先使用字符串保存后，再将变量放入即可
      //       var str = '<div class="entry">\
      //           <div class="head"> \
      //             <a href="javascript:;">' + ele.title + '</a>\
      //           </div>\
      //           <div class="main">\
      //             <p class="info">admin 发表于 2015-06-29</p>\
      //             <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>\
      //             <p class="extra">\
      //               <span class="reading">阅读(3406)</span>\
      //               <span class="comment">评论(0)</span>\
      //               <a href="javascript:;" class="like">\
      //                 <i class="fa fa-thumbs-up"></i>\
      //                 <span>赞(167)</span>\
      //               </a>\
      //               <a href="javascript:;" class="tags">\
      //                 分类：<span>星球大战</span>\
      //               </a>\
      //             </p>\
      //             <a href="javascript:;" class="thumb">\
      //               <img src="/static/uploads/hots_2.jpg" alt="">\
      //             </a>\
      //           </div>\
      //         </div>';
      //       //将结构添加到页面中即可
      //       //添加到加载更多的盒子前面
      //       $(str).insertBefore(".loadmore");
      //     });
      //   }
      // });


      //3 设置加载更多按钮的点击事件
      var $btn = $(".loadmore span");

      $btn.on("click", function () {
        //设置count++，获取新的部分数据即可
        count++;

        //发送请求
        $.ajax({
          type : "GET",
          url : "/api/_listdata.php",
          // 将id传递到服务端，将请求的次数传递到服务端
          data : {id : getParams, count : count},
          success : function (data) {
            //提前对数据data做检测
            //如果data的元素个数<10，说明没有后续的数据了，可以删除按钮的结构
            if (data.length < 10) {
              $btn.remove();
            }
            //data是一个数组，内部的每个对象表示一个文章所需要的结构
            $.each(data, function (i, ele) {
              //使用jq选择器时，如果字符串内容中使用了\，可以先使用字符串保存后，再将变量放入即可
              var str = '<div class="entry">\
                  <div class="head"> \
                    <a href="javascript:;">' + ele.title + '</a>\
                  </div>\
                  <div class="main">\
                    <p class="info">admin 发表于 2015-06-29</p>\
                    <p class="brief">星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯，星球大战:原力觉醒：《星球大战:原力觉醒》中国首映盛典红毯</p>\
                    <p class="extra">\
                      <span class="reading">阅读(3406)</span>\
                      <span class="comment">评论(0)</span>\
                      <a href="javascript:;" class="like">\
                        <i class="fa fa-thumbs-up"></i>\
                        <span>赞(167)</span>\
                      </a>\
                      <a href="javascript:;" class="tags">\
                        分类：<span>星球大战</span>\
                      </a>\
                    </p>\
                    <a href="javascript:;" class="thumb">\
                      <img src="/static/uploads/hots_2.jpg" alt="">\
                    </a>\
                  </div>\
                </div>';

              //将结构添加到页面中即可
              //添加到加载更多的盒子前面
              $(str).insertBefore(".loadmore");
            });
          }
        });
      });

      //4 可以将页面加载时的第一次数据获取操作通过$btn的点击事件触发来完成

      //在全局中设置count为0，第一次事件触发后，count自增为1，发送时也为1，与以前相同
      var count = 0;
      $btn.trigger("click");

    
    });

  </script>
</body>
</html>
