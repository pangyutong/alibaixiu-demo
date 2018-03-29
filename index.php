<?php 
  //引入config.php

  //由于config中为配置文件，不可缺失，所以使用require的方式

  //内部设置时使用的是常量，常量不能重复定义与修改，推荐使用require_once 
  //require_once 作用于require相同，但是文件只会被引入一次，不会出现重复引入的问题
  require_once './config.php';

  //1 进行数据库连接操作
  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);



  //3 查询最新发布的数据
  $sql2 = "select posts.id,posts.title,posts.content,posts.created,posts.views,posts.likes,users.slug,categories.name
     from posts
    inner join users on posts.user_id=users.id
    inner join categories on posts.category_id=categories.id
    where category_id!=1
    order by created desc
    limit 5;";

  $result2 = mysqli_query($con, $sql2);

  while ($result_arr2 = mysqli_fetch_assoc($result2)) {
    $arr2[] = $result_arr2;
  }
  //print_r($arr2);
  

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
  
    <!-- 提取为公共区域，并引入 -->
    <?php include './public/_header.php'; ?>

    <?php include './public/_aside.php'; ?>
    
    <div class="content">
      <div class="swipe">
        <ul class="swipe-wrapper">
          <li>
            <a href="#">
              <img src="/static/uploads/slide_1.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="/static/uploads/slide_2.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="/static/uploads/slide_1.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="#">
              <img src="/static/uploads/slide_2.jpg">
              <span>XIU主题演示</span>
            </a>
          </li>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul>
          <li class="large">
            <a href="javascript:;">
              <img src="/static/uploads/hots_1.jpg" alt="">
              <span>XIU主题演示</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="/static/uploads/hots_2.jpg" alt="">
              <span>星球大战：原力觉醒视频演示 电影票68</span>
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
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>2</i>
            <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span class="">阅读 (18206)</span>
          </li>
          <li>
            <i>3</i>
            <a href="javascript:;">实在太邪恶！照亮妹纸绝对领域与私处</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>4</i>
            <a href="javascript:;">没有任何防护措施的摄影师在水下拍到了这些画面</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>5</i>
            <a href="javascript:;">废灯泡的14种玩法 妹子见了都会心动</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
        </ol>
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
      <div class="panel new">
        <h3>最新发布</h3>
        <!-- 
          //静态结构
          <div class="entry">
            <div class="head">
              <span class="sort">会生活</span>
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
              <span class="sort">会生活</span>
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
              <span class="sort">会生活</span>
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
        -->

        <!-- 最新发布功能： -->
        <!-- 遍历$arr2进行结构创建即可 -->
        <?php foreach ($arr2 as $values): ?>
          <div class="entry">
            <div class="head">
              <!-- 分类名称 -->
              <span class="sort"><?php echo $values['name']; ?></span>
              <!-- 文章标题 -->
              <a href="/detail.php?id=<?php echo $values['id']; ?>"><?php echo $values['title']; ?></a>
            </div>
            <div class="main">
              <!-- 用户名称以及文章创建时间 -->
              <p class="info"><?php echo $values['slug']; ?> 发表于 <?php echo $values['created']; ?></p>
              <!-- 文章内容 -->
              <p class="brief"><?php echo $values['content']; ?></p>
              <p class="extra">
                <!-- 阅读次数 -->
                <span class="reading">阅读(<?php echo $values['views']; ?>)</span>
                <span class="comment">评论(0)</span>
                <a href="javascript:;" class="like">
                  <i class="fa fa-thumbs-up"></i>
                  <!-- 赞数 -->
                  <span>赞(<?php echo $values['likes']; ?>)</span>
                </a>
                <a href="javascript:;" class="tags">
                  <!-- 分类名称 -->
                  分类：<span><?php echo $values['name']; ?></span>
                </a>
              </p>
              <a href="javascript:;" class="thumb">
                <img src="/static/uploads/hots_2.jpg" alt="">
              </a>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>
