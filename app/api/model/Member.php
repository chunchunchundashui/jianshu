<?php


namespace app\api\model;


use app\common\controller\Json;
use app\Request;
use think\Model;

class Member extends Model
{
    public function login(Request $request)
    {
        $data = input();
        $userInfo = Member::where('openid', $data['openId'])->find();
        if (empty($userInfo)) { //  用户的openid不存在就注册
            $userInfo['openid'] = $data['openId'];
            $userInfo['uname'] = $data['nickname'];
            $userInfo['face'] = $data['avatarUrl'];
            $userInfo['random'] = uniqid(); //  随机串唯一的
            $userInfo['regtime'] = time();
            $members = Member::create($userInfo);
            $userInfo['id'] = $members->id;
        }
        if (empty($userInfo['id'])) {
            return Json::fail('注册失败');
        }else {
            return Json::success($userInfo);
        }
    }
}