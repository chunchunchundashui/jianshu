<template>
	<view>
		登陆界面
		<!-- 小程序登陆第二步 -->
		<!-- #ifdef MP-WEIXIN -->
			<button type="default" open-type="getUserInfo" @getuserinfo="getUserInfo">微信登陆</button>
		<!-- #endif -->
	</view>
</template>

<script>
	var _self, _options, openid, session_key;
	export default {
		data() {
			return {
				
			}
		},
		onLoad(options) {
			_self = this;
			_options = options;
			// 判断小程序登陆,  小程序登陆必须先获取code在用code从微信服务器上面获取用户的openid,  小程序登陆第一步
			// #ifdef MP-WEIXIN
				uni.login({
					success(res) {
						console.log(res)	// 获取res.code码,在获取openid
						uni.request({
							url: _self.apiServer+'member/getOpenId',
							data: {
								code: res.code,
							},
							success(infoRes) {
								openid = infoRes.data.data.openid;
								session_key = infoRes.data.data.session_key
							}
						})
					}
				})
			// #endif
			
			// 手机端微信登陆	,判断app登陆
			// #ifdef APP-PLUS
				uni.login({
				  provider: 'weixin',
				  success: function (loginRes) {
					console.log(loginRes.authResult);
					// 获取用户信息
					    uni.getUserInfo({
					      provider: 'weixin',
					      success: function (infoRes) {
					        uni.request({
					            url: _self.apiServer+'member/login', //封装地址
					            data: {
					                openId: infoRes.userInfo.openId,
									nickname: infoRes.userInfo.nickname,
									avatarUrl: infoRes.userInfo.avatarUrl,
					            },
								method: 'POST',
					            header: {
					                'content-type': 'application/x-www-form-urlencoded' //自定义请求头信息
					            },
					            success: (res) => {
									if (res.data.code == 'ok') {
										that.titleShow("登陆成功");
										uni.setStorageSync('SRAND', res.data.data.random);   //  随机字符
										uni.setStorageSync('SUID', res.data.data.id);		// 用户id
										uni.setStorageSync('SNAME', res.data.data.uname);	// 用户名称
										uni.setStorageSync('SFACE', res.data.data.face);	// 头像
										if (options.backtype == 1) {
											uni.redirectTo({
												url: options.backpage
											});
										}else {
											uni.switchTab({
												url: options.backpage
											});
										}
									}else {
										that.titleShow(res.data);
										// uni.showToast({
										// 	title: res.data
										// })
									}
					            }
					        });
					      }
					    });
				  },
				  fail() {
				  	uni.showToast({
				  		title: "微信授权失败",
						icon: "none"
				  	})
				  }
				});
			// #endif
		},
		
		methods: {
			// 小程序登陆第三步
			getUserInfo(userInfo) {
				var _user = userInfo.detail.userInfo;
				uni.request({
				    url: _self.apiServer+'member/login', //封装地址
				    data: {
				        openId: openid,
						nickname: _user.nickName,
						avatarUrl: _user.avatarUrl,
				    },
					method: 'POST',
				    header: {
				        'content-type': 'application/x-www-form-urlencoded' //自定义请求头信息
				    },
				    success: (res) => {
						if (res.data.msg == 'ok') {
							_self.titleShow("登陆成功");
							// uni.showToast({
							// 	title: "登陆成功"
							// })
							uni.setStorageSync('SRAND', res.data.data.random);   //  随机字符
							uni.setStorageSync('SUID', res.data.data.id);		// 用户id
							uni.setStorageSync('SNAME', res.data.data.uname);	// 用户名称
							uni.setStorageSync('SFACE', res.data.data.face);	// 头像
							if (_options.backtype == 1) {
								uni.redirectTo({
									url: _options.backpage
								});
							}else {
								uni.switchTab({
									url: _options.backpage
								});
							}
						}else {
							uni.showToast({
								title: res.data
							})
						}
				    }
				});
			}
		}
	}
</script>

<style>

</style>
