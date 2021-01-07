<?php


namespace app\api\controller;


use app\common\controller\Json;
use think\facade\Db;

class AccessToken
{
    /**
     * 生成唯一的token和时间 存入数据库
     * @return \think\response\Json
     */
    public function getToken()
    {
        $data = [
          'token' => uniqid(),
          'time' => time(),
        ];
        // 将生成的存入到数据库
        $insert = Db::name('accessToken')->insert($data);
        if ($insert) {
            return Json::success($data);
        }else {
            return Json::fail('生成失败');
        }
    }
}