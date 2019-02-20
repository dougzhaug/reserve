<?php

namespace App\Http\Controllers\Agent;

use App\Models\Goods;
use Illuminate\Http\Request;

class MallsController extends AuthController
{
    //
    /**
     * 首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('agent.malls.index');
    }

    /**
     * 获取售卖商品信息
     *
     * @param Request $request
     * @return array
     */
    public function getGoods(Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = 20;
        $page_start = ($page-1) * $page_size;

        if($request->isMethod('post')){
            $builder = Goods::where('status',2)
                ->whereNotIn('id',array_column($request->user->goods->toArray(),'id'))
                ->select(['id','name','author','summary','images','category','price','created_at']);

            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }

            $data = $builder->offset($page_start)->take($page_size)->get();

            return [
                'errorCode' => 0,
                'data' => $data,
                'page' => $page+1,
            ];
        }
    }

    /**
     * 详情
     *
     * @param Goods $goods
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Goods $goods)
    {
        return view('agent.malls.show',['goods'=>$goods]);
    }

    /**
     * 已经购买的商品
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function purchased(Request $request)
    {
        if($request->isMethod('post')){
            $page = $request->page ?? 1;
            $page_size = 20;
            $page_start = ($page-1) * $page_size;

            $data = $request->user->goods()->offset($page_start)->take($page_size)->get();

            return [
                'errorCode' => 0,
                'data' => $data,
                'page' => $page+1,
            ];
        }

        return view('agent.malls.purchased',['goods'=>$request->user->goods]);
    }
}
