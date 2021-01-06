<?php
namespace app\api\controller;

use app\BaseController;
use app\common\controller\Json;
use app\Request;

class Member extends BaseController
{
    public function login(Request $request)
    {
        $params = getParams($request, [
            'openId', 'nickname', 'avatarUrl'
        ], 'post');
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
