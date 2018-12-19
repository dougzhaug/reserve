<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    /*
    |--------------------------------------------------------------------------
    | Third Party User Update Expires
    |--------------------------------------------------------------------------
    */
    'sns_user_update_expires' => env('SNS_USER_UPDATE_EXPIRES',86400),
    /*
    |--------------------------------------------------------------------------
    | Third Party User Login Password
    |--------------------------------------------------------------------------
    */
    'sns_user_login_password' => env('SNS_USER_LOGIN_PASSWORD','d1e2f3a4u5l6t'),

    /*
    |--------------------------------------------------------------------------
    | Third Party Login Services
    |--------------------------------------------------------------------------
    */
    'weixinweb' => [
        'client_id' => env('WEIXINWEB_KEY'),
        'client_secret' => env('WEIXINWEB_SECRET'),
        'redirect' => env('WEIXINWEB_REDIRECT_URI')
    ],
];
