<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //
    public $agent;
    public function __construct(Request $request)
    {
        $this->getAgent($request);
    }

    public function getAgent(Request $request)
    {
        $sld_arr = explode('.',$request->getHost());
        $agent_sld = array_shift($sld_arr);
        if(!$agent_sld) throw new \Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException('数据异常');

        $this->agent = Agent::where('sld',$agent_sld)->first();
        if(!$this->agent) throw new \Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException('数据异常');
    }
}
