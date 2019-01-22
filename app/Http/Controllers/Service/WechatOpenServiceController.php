<?php
/**
 * 微信开放平台
 */

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatOpenServiceController extends ServiceController
{
    protected $app_id;                      //公众号appid
    protected $redirect_uri;                //网页授权回调地址
    protected $scope;                       //授权作用域
    protected $component_app_id;            //开发平台第三方app_id

    public function getAppId()
    {
        return $this->app_id;
    }

    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
        return $this;
    }

    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = urlencode($redirect_uri);
        return $this;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    public function getComponentAppId()
    {
        return $this->component_app_id = config('wechat.open_platform.default.app_id');
    }

    public function makeWebAuthorizationUrl($state='')
    {
        return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='. $this->app_id .'&redirect_uri='. $this->redirect_uri .'&response_type=code&scope='. $this->scope .'&state='. $state .'&component_appid='. $this->getComponentAppId() .'#wechat_redirect';
    }
}
