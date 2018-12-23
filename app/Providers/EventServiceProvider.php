<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            //第三方登录
            'SocialiteProviders\\WeixinWeb\\WeixinWebExtendSocialite@handle',   //微信
            'SocialiteProviders\QQ\QqExtendSocialite@handle',                   //QQ
            'SocialiteProviders\Weibo\WeiboExtendSocialite@handle',             //微博
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
