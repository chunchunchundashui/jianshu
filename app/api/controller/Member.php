<?php
namespace app\api\controller;

use app\BaseController;
use app\common\controller\Json;
use app\Request;

class Member extends BaseController
{
    /**
     * app微信登陆,  小程序登陆,  验证签名
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function login(Request $request)
    {
        $params = getParams($request, [
            'openId', 'nickname', 'avatarUrl', 'sign'
        ], 'post');
        //登陆前签名验证
        $checkRes = $this->checkSign();
        if ($checkRes['code'] == 'error') {
            return json($checkRes);
        }
        //登陆前签名验证结束
        $userInfo = \app\api\model\Member::where('openid', $params['openId'])->find();
        if (empty($userInfo)) { //  用户的openid不存在就注册
            $userInfo['openid'] = $params['openId'];
            $userInfo['uname'] = $params['nickname'];
            $userInfo['face'] = $params['avatarUrl'];
            $userInfo['random'] = uniqid(); //  随机串唯一的
            $userInfo['regtime'] = time();
            $members = \app\api\model\Member::create($userInfo);
            $userInfo['id'] = $members->id;
        }
        if (empty($userInfo['id'])) {
            return Json::fail('注册失败');
        }else {
            return Json::success($userInfo);
        }
    }

    /**
     * 像微信服务端发送请求获取openid
     * @return \think\response\Json
     */
    public function getOpenId()
    {
        $appid = "wxc7926f1289e89eda";
        $secret = "834f309d29691150f179b65fdb42f9a1";
        $js_code = input('code');
        $grant_type = "authorization_code";
        $data = [
            'appid' => $appid,
            'secret' => $secret,
            'js_code' => $js_code,
            'grant_type' => $grant_type
        ];
        $url = "https://api.weixin.qq.com/sns/jscode2session";
        try {
            $res = httpCurl($url, $data);
            $arr = json_decode($res);
            return Json::success($arr);
        } catch (\Exception $e) {
            return Json::fail($e->getMessage());
        }
    }
}
