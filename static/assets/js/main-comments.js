// 当依赖的模块处于其他目录下时，可以使用requirejs的配置进行直接设置
require.config({
	// 默认的路径
	baseUrl : "/static/assets/vendors",
	// 用于指定模块路径
	paths : {
		// 注意，不用设置后缀名
		"jquery" : "jquery/jquery",//jquery模块
		"art-template" : "art-template/template-web",//模板模块
		// jQuery的插件并不遵守requirejs所采用的模块规范，所以需要进行单独设置
		"twbs-pagination" : "twbs-pagination/jquery.twbsPagination",
		"bootstrap" : "bootstrap/js/bootstrap"
	},
	shim : {
		//指明模块名称，以及暴露的值,并且声明依赖关系
		"twbs-pagination" : {
			//声明当前模块的依赖关系
			deps : ["jquery"],
			// 声明暴露的值
			exports : "$.fn.twbsPagination"
		}
	}
});

require(["jquery", "art-template", "twbs-pagination", "bootstrap"], function ($, template) {

		// ------- 评论页面的js主题功能代码 -------
	 //发送ajax请求，进行数据获取
    var $tbody = $("#tbody");
    var $list = $("#list");

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


});