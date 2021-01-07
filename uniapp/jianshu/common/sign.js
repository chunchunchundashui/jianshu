var md5 = require('./md5.js');
module.exports = {
	sign : function(apiServer){
		// 环境判断非uni环境不支持
		if(!uni){return '...';}
		console.log('开始签名');
		// 连接服务器获取一个临时的accessToken
		uni.request({
			url: apiServer+'AccessToken/getToken',
			method: 'GET',
			success: res => {
				console.log(res);
				if(res.data.msg != 'ok'){return ;}
				var data = res.data.data;
				console.log('data:'+data);
				// 对 accessToken 进行md5加密
				var accessToken = md5.hex_md5(data.token + data.time);
				console.log('accessToken:'+accessToken);
				// 签名 = md5(accessToekn + time) + '-' + 'accessToekn';
				var sign = accessToken + '-' + data.token;
				console.log('sign:'+sign);
				//console.log(sign);
				// 记录在本地
				uni.setStorage({ 
					key:"sign",
					data:sign
				}); 
				console.log('签名完成');
			},
			fail:function(e){ 
				console.log(JSON.stringify(e));
			}
		});
	}
}