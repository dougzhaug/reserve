<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Service\WechatOpenServiceController;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class LoginController extends BaseController
{
    //
    public function login(Request $request)
    {
        if(!$request->code || !$request->appid){
            throw new \Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException('数据异常');
        }

        $openPlatform = app('wechat.open_platform');
        $app = $openPlatform->officialAccount($request->appid);
        $user = $app->oauth->user();
        $userModel = User::where('openid',$user->getId())->first();
        if(!$userModel){
            $create = $user->getOriginal();
            $create['privilege'] = json_encode($create['privilege']);
            $userModel = User::create($create);
        }
        $token = auth('api')->login($userModel);

        return $token;

//        $agent_id = 102;// Hashids::decode($request->agent)[0] ?? 0;   //需要前端传递
//
//        if(!$agent_id){
//            return '<script>alert("数据异常")</script>';
//        }
//
//        $redirect = url('authorized/callback').$request->uri?:'';
//
//        $mp = Agent::find($agent_id)->wechatMp;
//
//        $openPlatform = app('wechat.open_platform');
//        $app = $openPlatform->officialAccount($mp['authorizer_appid']);
//        $response = $app->oauth->scopes(['snsapi_userinfo'])->redirect($redirect);
//        return $response;
    }

    public function getOpenAuthorizeUrl()
    {
        $mp = $this->agent->wechatMp;

        $openService = new WechatOpenServiceController();
        $url = $openService->setAppId($mp['authorizer_appid'])->setRedirectUri('http://234ksd.loveliyuan.com')->setScope('snsapi_userinfo')
                ->makeWebAuthorizationUrl();
        return $url;
    }

    public function callback(Request $request)
    {
        $openPlatform = app('wechat.open_platform');
        $app = $openPlatform->officialAccount($request->appid);
        $user = $app->oauth->user();
        $userModel = User::where('openid',$user->getId())->first();
        if(!$userModel){
            $create = $user->getOriginal();
            $create['privilege'] = json_encode($create['privilege']);
            $userModel = User::create($create);
        }
        $token = auth('api')->login($userModel);
//        dd($token);die;
        return $token;
    }
}
