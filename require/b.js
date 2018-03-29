// var b = (function (window, document, a, undefined) {
// 	return a + 200;
// })(window, document, a);

//用于b模块依赖与模块a，需要在b模块中声明对a的依赖
define(["a"], function (a) {
	return a + 200;
});