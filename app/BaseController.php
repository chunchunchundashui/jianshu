<?php
declare (strict_types = 1);

namespace app;

use app\common\controller\Json;
use think\App;
use think\exception\ValidateException;
use think\facade\Db;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 签名校验
     * @return string[]
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function checkSign()
    {
        $sign = input('post.sign', '');
        if (!$sign) {
            return ['code' => 'error', 'data' => '没有检测到签名信息'];
        }
        $sign = explode('-', $sign);    // 签名格式 5208aa63102959e0610b9606d76130da-5ff708083cc3f
        if (count($sign) != 2) {
            return ['code' => 'error', 'data' => '签名异常'];
        }
        $token = Db::name('access_token')->where('token', $sign[1])->find();
        if (!$token) {
            return ['code' => 'error', 'data' => '签名异常,数据库中不存在该token'];
        }
        $signMd5 = md5($token['token'].$token['time']);
        if ($signMd5 != $sign[0]) {
            return ['code' => 'error', 'data' => '比对错误'];
        }
        // 签名成功删除生成的token
        Db::name('access_token')->where('token', $sign[1])->delete();
        return ['code' => 'ok', 'data' => '签名完成'];
    }
    //签名校验结束

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

}
