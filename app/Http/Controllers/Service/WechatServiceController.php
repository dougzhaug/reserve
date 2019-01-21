<?php
/**
 * 微信公众号
 */
namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatServiceController extends ServiceController
{
    //
    protected $app_id;                      //公众号appid
    protected $redirect_uri;                //网页授权回调地址
    protected $scope;                       //授权作用域

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

    public function makeWebAuthorizationUrl($state='')
    {
        return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='. $this->app_id .'&redirect_uri='. $this->redirect_uri .'&response_type=code&scope='. $this->scope .'&state='. $state .'#wechat_redirect';
    }
}
