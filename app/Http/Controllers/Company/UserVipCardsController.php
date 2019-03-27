<?php

namespace App\Http\Controllers\Company;

use App\Models\Shop;
use App\Models\User;
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
                    $query->where('vip_cards.shop_id', 0)
                        ->where('user_vip_card.user_id',$user_id)
                        ->whereIn('vip_cards.id', $universal_vip_card_id);
                });
            }

            $builder->select(['vip_cards.shop_id','vip_cards.name','vip_cards.type','vip_cards.universal','shops.name as shop_name','user_vip_card.id','user_vip_card.card_number','user_vip_card.balance','user_vip_card.expired_at','user_vip_card.status','user_vip_card.created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
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
}
