<template>
	<view class="big">
		<view class="trade">
			<view class="texts" :class="curr==0?'active':''" data-index="0" @tap="setCurr">
				推荐
			</view>
			<view class="texts" :class="curr==1?'active':''" data-index="1" @tap="setCurr">
				热榜
			</view>
		</view>
		<swiper style="height: 100vh;" :current="curr" @change="setCurr">
			<swiper-item>
				<scroll-view>
					<view class="model-back">
						<view class="model-back-title">
							<span>编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?</span>
						</view>
						<view class="model-back-user-info">
							<image src="../../static/logo.png" alt="">
								<view class="model-back-name-introduce">
									<name>名称名称名称名称</name>
									<span>创业青年</span>
								</view>
						</view>
						<view class="model-back-content">
							谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流.谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流。
						</view>
						<view class="model-back-agree-comment">
							<span class="agree">263 赞同</span>
							<span class="dian"> • </span>
							<span class="comment">566 评价</span>
						</view>
					</view>
				</scroll-view>
				<scroll-view>
					<view class="model-back">
						<view class="model-back-title">
							<span>编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?</span>
						</view>
						<view class="model-back-user-info">
							<image src="../../static/logo.png" alt="">
								<view class="model-back-name-introduce">
									<name>名称名称名称名称</name>
									<span>创业青年</span>
								</view>
						</view>
						<view class="model-back-content">
							谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流.谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流。
						</view>
						<view class="model-back-agree-comment">
							<span class="agree">263 赞同</span>
							<span class="dian"> • </span>
							<span class="comment">566 评价</span>
						</view>
					</view>
				</scroll-view>
				<scroll-view>
					<view class="model-back">
						<view class="model-back-title">
							<span>编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?编程学习需要天赋吗?</span>
						</view>
						<view class="model-back-user-info">
							<image src="../../static/logo.png" alt="">
								<view class="model-back-name-introduce">
									<name>名称名称名称名称</name>
									<span>创业青年</span>
								</view>
						</view>
						<view class="model-back-content">
							谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流.谢邀.一个工作11年的码农,与输入昔闻洞庭水，今上岳阳楼。吴楚东南坼，乾坤日夜浮。亲朋无一字，老病有孤舟。戎马关山北，凭轩涕泗流。
						</view>
						<view class="model-back-agree-comment">
							<span class="agree">263 赞同</span>
							<span class="dian"> • </span>
							<span class="comment">566 评价</span>
						</view>
					</view>
				</scroll-view>
			</swiper-item>
			<swiper-item>
				<scroll-view>
					bbb
				</scroll-view>
			</swiper-item>		
		</swiper>
	</view>
</template>

<script>
	export default {
			data() {
				return {
					curr:0
				}
			},
			methods: {
				setCurr(e) {
				// console.log(e.detail.current)
				let thisCurr = e.detail.current || e.currentTarget.dataset.index || 0;
				// console.log(thisCurr)
				this.curr = thisCurr;
				}
			}
		}
</script>

<style lang="less">
	page {
		width: 100%;
		background-color: #F4F4F4;
	}
	.trade{
		width: 100%;
		color: #a6a6a6;
		overflow: auto;
		background-color: white;
	}
	.trade view{
		text-align: center;
		padding: 10rpx 0 22rpx 0;
		width: 50%;
		float: left;
	}
	.trade .texts.active{
		border-bottom: 8upx solid #0f6cd6;
		color: #010101;
	}
	.model-back {
		height: 100%;
		border-radius: 8rpx;
		margin: 22rpx 0 6rpx 0;
		padding: 18rpx 15rpx 14rpx 23rpx;
		background-color: white;
		box-shadow: 0 3rpx 6rpx rgba(0, 0, 0, 0.2);
		.model-back-title {
			font-size: 14px;
			font-weight: bold;
			letter-spacing: 2px;
		}
		.model-back-user-info {
			position: relative;
		}
		.model-back-name-introduce name{
			width: 100%;
		}
		.model-back-name-introduce{
			position: absolute;
			top: 15rpx;
			left: 59rpx;
			font-size: 13px;
		}
		.model-back-name-introduce span {
			margin-left: 10rpx;
			color: #c9c9c9;
		}
		.model-back-user-info image{
			width: 45rpx;
			height: 45rpx;
			border-radius: 50%;
			margin: 10rpx 10rpx 10rpx 0;
		}
		.model-back-content {
			font-size: 14px;
			// width: 540rpx;
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 3;
			-webkit-box-orient: vertical;
		}
		.model-back-agree-comment {
			padding: 10rpx 0 10rpx 0;
			.agree, .comment{
				font-size: 14px;
				color: #c9c9c9;
			}
			.dian {
				font-size: 12px;
				padding: 0 10rpx 0 10rpx;
				color: #c9c9c9;
			}
		}
	}
</style>
