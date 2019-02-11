<?php

namespace App\Http\Controllers\Agent;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChaptersController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Chapter::where('goods_id',$request->id)->select(['id','name','summary','sort','created_at']);

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
        return view('agent.chapters.index',['dropdowns'=>$dropdowns]);
    }
}
