<?php

namespace App\Http\Controllers\Company;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends AuthController
{
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Shop::where('company_id',$request->user['company_id'])->select(['id','name','logo','manager_id','status','created_at']);

            if($request->role == 120){  //店长
                $builder->where('manager_id',$request->user['id']);
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

        $dropdowns = ['name'=>'名称','author'=>'作者'];
        return view('company.shops.index',['dropdowns'=>$dropdowns]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
