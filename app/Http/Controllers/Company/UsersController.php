<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            if($request->role == 110){
                $builder = Company::find($request->user['company_id'])->users()->join('shops','user_company_shop.shop_id','=','shops.id')->select(['users.id','users.nickname','users.phone','users.sex','users.headimgurl','users.status','users.created_at','shops.name as shop_name','shops.id as shop_id']);
            }elseif ($request->role == 120){
                $builder = Shop::find($request->user['shop_id'])->users()->select(['id','nickname','phone','sex','headimgurl','status','created_at']);
            }else{
                return [];
            }

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

        $dropdowns = ['nickname'=>'昵称','phone'=>'手机'];
        return view('company.users.index',['dropdowns'=>$dropdowns]);
    }
}
