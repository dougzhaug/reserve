<?php

namespace App\Http\Controllers\Company;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public $error;
    public function __construct(Request $request)
    {
        $this->autoLoad();
    }

    /**
     * 自动加载
     */
    public function autoLoad()
    {
        $autoLoadFunction = [
            'layout'
        ];

        foreach ($autoLoadFunction as $key=>$method){

            $methodName = "load".ucwords($method);

            if(method_exists($this,$methodName)){
                $this->$methodName();
            }
        }
    }

    /**
     * 加载布局页面
     *
     * @param bool $layoutName
     */
    protected function loadLayout($layoutName=false)
    {
        $layoutName = $layoutName ? : 'min';

        $layout = 'layouts.admin.' . $layoutName;

        View::share('layout',$layout);
    }

    /**
     * @param $msg
     * @param int $code
     */
    public function setError($msg,$code=0)
    {
        $this->error = [
            'errcode' => $code,
            'errmsg' => $msg
        ];
    }

    /**
     * 验证器
     *
     * @param $data
     * @param $rule
     * @return mixed
     */
    protected function validator($data,$rule)
    {
        return Validator::make($data, $rule)->validate();
    }
}
