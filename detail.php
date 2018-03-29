<?php 
  
  require_once './config.php';


  //1 接收GET的参数
  // 检测，如果没有GET的参数，返回首页
  if (!isset($_GET['id'])) {
      header('Location:./index.php');
  }

  //2 进行数据库连接操作
  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

  //3 保存id参数，进行数据库查询操作
  $id = $_GET['id'];

  $sql2 = "select posts.id,posts.title,posts.content,posts.created,posts.views,posts.likes,users.slug,categories.name
     from posts
    inner join users on posts.user_id=users.id
    inner join categories on posts.category_id=categories.id
    where posts.id=$id;";

  $result2 = mysqli_query($con, $sql2);
  
  $result_arr2 = mysqli_fetch_assoc($result2);
  
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
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $result_arr2['name']; ?></a></dd>
            <dd><?php echo $result_arr2['title']; ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $result_arr2['title']; ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $result_arr2['slug']; ?> 发布于 <?php echo $result_arr2['created']; ?></span>
          <span>分类: <a href="javascript:;"><?php echo $result_arr2['name']; ?></a></span>
          <span>阅读: (<?php echo $result_arr2['views']; ?>)</span>
          <span>点赞: (<?php echo $result_arr2['likes']; ?>)</span>
        </div>
        <div class="content-detail"> 
          <?php echo $result_arr2['content']; ?>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="/static/uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="/static/uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="/static/uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="/static/uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
