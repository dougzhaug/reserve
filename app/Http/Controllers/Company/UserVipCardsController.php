<?php

namespace App\Http\Controllers\Company;

use App\Models\Shop;
use App\Models\User;
use App\Models\UserVipCard;
use App\Models\VipCard;
use App\Models\VipCardShop;
use Illuminate\Http\Request;

class UserVipCardsController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $user_id = $request->user_id;   //这个用户是指users表用户

            $builder = User::find($user_id)->vipCards()->leftJoin('shops','vip_cards.shop_id','shops.id');

            if($request->role == 120 || $request->shop_id){

                $shop_id = $request->shop_id?:$request->user['shop_id'];

                $universal_vip_card_id = VipCardShop::where('shop_id',$shop_id)->pluck('vip_card_id');

                $builder->where('vip_cards.shop_id',$shop_id)->orwhere(function ($query) use($user_id,$universal_vip_card_id){
                    $query->where('vip_cards.universal', 1)
                        ->where('user_vip_card.user_id',$user_id)
                        ->whereIn('vip_cards.id', $universal_vip_card_id);
                });
            }

            $builder->select(['vip_cards.shop_id','vip_cards.name','vip_cards.type','vip_cards.universal','shops.name as shop_name','user_vip_card.id','user_vip_card.card_number','user_vip_card.balance','user_vip_card.expired_at','user_vip_card.status','user_vip_card.created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }
            if($request->status){
                $builder->where('user_vip_card.status',$request->status);
            }
            if($request->date_range){
                $builder->whereBetween('created_at',[$request->start_date,$request->end_date]);
            }
            /* where end */

            //获取总条数
            $total = $builder->count();

            /* order start */
            if($request->order){
                $builder->orderBy($request->columns[$request->order[0]['column']]['data'],$request->order[0]['dir']);
            }
            /* order end */

            $data = $builder->offset($request->start)->take($request->length)->get()->toArray();

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        $dropdowns = ['card_number'=>'卡号'];

        return view('company.user_vip_cards.index',[
            'dropdowns'=>$dropdowns,
            'shops'=>Shop::getShopSelect($request->shop_id,['company_id'=>$request->user['company_id']]),
        ]);
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')) {
            //获取会员卡信息
            $shop_id = $request->user['shop_id'];
            if ($request->role == 110) {
                $shop_id = $request->shop_id;
            }
            return VipCard::getVipCardToShopIdSelect($shop_id);
        }
        return view('company.user_vip_cards.create',[
            'shops'=>Shop::getShopSelect($request->shop_id,['company_id'=>$request->user['company_id']]),
        ]);
    }

    /**
     * 添加数据
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => ['required'],
            'vip_card' => ['required'],
            'balance' => ['required'],
        ]);

        $status = $request->status ? 1 : -1;

        try{
            $result = UserVipCard::build($request->user_id,$request->vip_card,$request->balance,$status);
            if($result){
                $shop_id = $request->shop ? : 0;
                return success('添加成功','user_vip_cards/' . $request->user_id . '/' . $shop_id);
            }else{
                return error('网络异常');
            }
        }catch (\Exception $e){
            return error($e->getMessage() ?: '网络异常');
        }
    }

    /**
     * 编辑
     *
     * @param UserVipCard $userVipCard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(UserVipCard $userVipCard)
    {
        return view('company.user_vip_cards.edit',[
            'user_vip_card'=>$userVipCard,
        ]);
    }

    /**
     * 编辑数据
     *
     * @param Request $request
     * @param UserVipCard $userVipCard
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request,UserVipCard $userVipCard)
    {
        $this->validate($request, [
            'balance' => ['required'],
        ]);

        $status = $request->status ? 1 : -1;

        $result = $userVipCard->update(['balance'=>$request->balance,'status'=>$status]);

        if($result){
            $shop_id = $request->role == 110 ? 0 : $userVipCard->vipCard['shop_id'];
            return success('编辑成功','user_vip_cards/' . $userVipCard->user_id . '/' . $shop_id);
        }else{
            return error('网络异常');
        }
    }

    /**
     * 获取会员卡详情信息
     *
     * @param Request $request
     * @return mixed
     */
    public function getVipCard(Request $request)
    {
        if($request->isMethod('post')) {
            $vip_card = VipCard::find($request->vip_card_id);
            $vip_card->shops = $vip_card->shops()->pluck('name');
            return $vip_card;
        }
    }
}
