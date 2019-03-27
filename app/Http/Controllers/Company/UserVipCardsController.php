<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use Illuminate\Http\Request;

class UserVipCardsController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $user_id = 1;   //这个用户是指users表用户

            $builder = User::find($user_id)->vipCard()->select(['vip_cards.shop_id','vip_cards.name','vip_cards.type','vip_cards.universal','user_vip_card.id','user_vip_card.card_number','user_vip_card.balance','user_vip_card.expired_at','user_vip_card.status','user_vip_card.created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }

            if($request->date_range){
                $builder->whereBetween('created_at',[$request->start_date,$request->end_date]);
            }

            if($request->shop_id){
                $builder->wherePivot('shop_id',$request->shop_id);
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

        $dropdowns = ['nickname'=>'昵称','remark'=>'备注','phone'=>'手机'];

        return view('company.user_vip_cards.index',[
            'dropdowns'=>$dropdowns,
//            'shops'=>Shop::getShopSelect(),
        ]);
    }
}
