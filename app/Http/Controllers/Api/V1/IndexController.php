<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\AuthController;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends AuthController
{
    //
    public function index()
    {
        return ['V1'];
    }
    /**
     * 首页广告
     */
    public function ad(Request $request)
    {
//        return Auth::user()->ad(1)->get();
        return Agent::find(102)->ad(1)->get();
    }
    public function icon()
    {
        return [
            [
                'id' => '001',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ],
            [
                'id' => '002',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ],
            [
                'id' => '003',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ],
            [
                'id' => '004',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ],            [
                'id' => '005',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ],            [
                'id' => '006',
                'imgUrl' => 'http://img1.qunarzz.com/piao/fusion/1803/95/f3dd6c383aeb3b02.png',
                'desc' => '景点门票票票好票票票'
            ]
        ];
    }
    public function hot()
    {

    }
    public function week()
    {

    }
    public function new()
    {

    }
    public function waterfall()
    {

    }
}
