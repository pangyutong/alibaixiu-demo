<?php 
  
    //2 查询导航的相关信息
    // 进行分类数据获取时，去除了未分类的内容
    $sql = "select * from categories where id!=1;";
    $result = mysqli_query($con, $sql);
    while ($result_arr = mysqli_fetch_assoc($result)) {
      $arr[] = $result_arr;
    }

 ?>
<div class="header">
  <h1 class="logo"><a href="index.html"><img src="/static/assets/img/logo.png" alt=""></a></h1>
  <ul class="nav">
   <!--  
    静态结构：
   <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
   <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
   <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
   <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> 
   -->

    <!-- 遍历$arr，进行结构生成即可 -->
  <?php foreach ($arr as $values): ?>
    <li>
      <a href="/list.php?id=<?php echo $values['id']; ?>">
        <i class="fa <?php echo $values['classname']; ?>"></i>
        <?php echo $values['name']; ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
  <div class="search">
    <form>
      <input type="text" class="keys" placeholder="输入关键字">
      <input type="submit" class="btn" value="搜索">
    </form>
  </div>
  <div class="slink">
    <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
  </div>
</div>