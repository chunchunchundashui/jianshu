import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false
// 封装检查是否登陆
Vue.prototype.checkLogin = function(backpage, backtype) {  // backpage   backtype 没有登陆跳转到登录界面,传递当前页面,登陆成功则返回当前页
	var SUID = uni.getStorageSync('SUID');		// 用户id
	var SRAND = uni.getStorageSync('SRAND');   //  随机字符
	var SNAME = uni.getStorageSync('SNAME');	// 用户名称
	var SFACE = uni.getStorageSync('SFACE');	// 用户头像
	if (SUID == '' || SRAND == '' || SNAME == '' || SFACE == '') {
		uni.navigateTo({
			url: '../login/login?backpage='+backpage+'&backtype='+backtype
		});
		return false;
	}
	return [SUID, SRAND, SNAME, SFACE];
}
// 封装结束

// 封装api请求地址
Vue.prototype.apiServer = "http://www.jianshu.net/api/";
// 封装api请求地址结束

// 封装消息弹窗
Vue.prototype.titleShow = function(title) {
	uni.showToast({
		title: title
	});
}
// 封装消息弹窗结束

App.mpType = 'app'

const app = new Vue({
    ...App
})
app.$mount()
