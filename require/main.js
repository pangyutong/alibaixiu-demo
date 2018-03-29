//require() 为requirejs提供的全局函数
//  参数1为数组，用于声明依赖的文件
//  参数2为函数，用于结构依赖的功能与要执行的功能

require(["b", "c"], function (b, c) {

	console.log("我是当前页面的主体功能");
	console.log(b, c);

});