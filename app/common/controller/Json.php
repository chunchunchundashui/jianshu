<?php


namespace app\common\controller;


class Json
{

    /**
     * @param $code 状态码
     * @param $msg  提示信息
     * @param array $data  返回数据
     * @return \think\response\Json
     */
    public static function json($code, $msg, $data = [])
    {
        return json([
            'status' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    /**
     * 成功返回
     * @param $data 返回数据
     * @param string $msg 提示信息
     * @return \think\response\Json
     */
    public static function success($data = [], $msg = 'ok')
    {
        return self::json(200, $msg, $data);
    }

    /**
     * 失败返回
     * @param $msg  提示信息
     * @param array $data  返回数据
     * @return \think\response\Json
     */
    public static function fail($msg, $data = [])
    {
        return self::json(400, $msg, $data);
    }

}
