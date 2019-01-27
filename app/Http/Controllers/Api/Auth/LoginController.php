<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Service\WechatOpenServiceController;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /**
     * 登录
     *
     * @param Request $request
     */
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
    }

    /**
     * 获取微信授权Url
     *
     * @param Request $request
     * @return string
     */
    public function getOpenAuthorizeUrl(Request $request)
    {
        return (new WechatOpenServiceController)
                ->setAppId($request->mp['authorizer_appid'])
                ->setRedirectUri('http://'.$request->mp['authorizer_appid'].'.mp.loveliyuan.com')
                ->setScope('snsapi_userinfo')
                ->makeWebAuthorizationUrl();
    }

    /**
     * 登出
     */
    public function logout()
    {
        return auth('api')->logout();
    }
}
