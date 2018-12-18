<?php

namespace App\Http\Controllers\Agent\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class WechatWebController extends Controller
{
    //
    /**
     * Redirect the user to the WeiXinWeb authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::with('weixinweb')->redirect();
    }

    /**
     * Obtain the user information from WeiXinWeb.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('weixinweb')->user();

        dd($user);die;
        // $user->token;
    }

    /**
     * autoLogin
     *
     * @param $user
     */
    protected function autoLogin($user)
    {

    }

}
