<?php 

  //当前页面是被其他页面引入的公共区域
  //在真正的页面方式时，设置一个当前页面的标识，就可以在这个公共页面中访问到
  //echo $current_page;

 ?>
<div class="aside">
    <div class="profile">
      <img class="avatar" src="/static/uploads/avatar.jpg">
      <h3 class="name">张三</h3>
    </div>
    <ul class="nav">
      <!-- 首页的按钮 -->
      <li class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>

      <!-- 文章部分页面的按钮 -->
      <!-- 由于文章部分的li高亮可以由三个页面决定,提前设置一个数组，保存满足高亮的标识 -->
      <?php 
        $post_arr = array('posts', 'post-add', 'categories');
       ?>
       <!-- in_array()用于检测数组中是否含有指定的值，返回布尔值，参数1为值，参数2为数组 -->
      <li class="<?php echo in_array($current_page, $post_arr) ? 'active' : ''; ?>">
        <!-- a标签设置collapsed类名时表示未展开时的效果，没有类名表示展开时的效果 -->
        <a href="#menu-posts" class="<?php echo in_array($current_page, $post_arr) ? '' : 'collapsed'; ?>" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <!-- ul设置类名in，代表展开列表效果 -->
        <ul id="menu-posts" class="collapse <?php echo in_array($current_page, $post_arr) ? 'in' : ''; ?>">
          <li class="<?php echo $current_page === 'posts' ? 'active' : ''; ?>"><a href="posts.php">所有文章</a></li>
          <li class="<?php echo $current_page === 'post-add' ? 'active' : ''; ?>"><a href="post-add.php">写文章</a></li>
          <li class="<?php echo $current_page === 'categories' ? 'active' : ''; ?>"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      
      <!-- 评论的按钮 -->
      <li class="<?php echo $current_page === 'comments' ? 'active' : ''; ?>">
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <!-- 用户的按钮 -->
      <li class="<?php echo $current_page === 'users' ? 'active' : ''; ?>">
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>

      <!-- 设置功能 页面的按钮 -->
      <?php $settings_arr = array('nav-menus', 'slides', 'settings'); ?>
      <li class="<?php echo in_array($current_page, $settings_arr) ? 'active' : ''; ?>">
        <a href="#menu-settings" class="<?php echo in_array($current_page, $settings_arr) ? '' : 'collapsed'; ?>" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php echo in_array($current_page, $settings_arr) ? 'in' : ''; ?>">
          <li class="<?php echo $current_page === 'nav-menus' ? 'active' : ''; ?>"><a href="nav-menus.php">导航菜单</a></li>
          <li class="<?php echo $current_page === 'slides' ? 'active' : ''; ?>"><a href="slides.php">图片轮播</a></li>
          <li class="<?php echo $current_page === 'settings' ? 'active' : ''; ?>"><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>