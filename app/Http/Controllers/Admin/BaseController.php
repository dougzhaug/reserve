<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Request $request)
    {
//        $this->middleware('auth:admin');
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
}
