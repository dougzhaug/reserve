<?php

namespace App\Http\Controllers\Company;

use App\Models\Reserve;
use Illuminate\Http\Request;

class ReservesController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Reserve::where(['company_id'=>$request->user['company_id']])->select(['id','name','min_ahead_days','max_ahead_days','type','status','created_at']);

            if($request->role == 120){
                $builder->where('shop_id',$request->user->shop->id);
            }

            if($request->role == 130){  //员工
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
        return view('company.reserves.index',['dropdowns'=>$dropdowns]);
    }

    /**
     * 添加页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('company.reserves.create');
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'type' => ['required'],
            'min_ahead_days' => ['required'],
            'max_ahead_days' => ['required'],
        ]);

        $create = $request->post();
        $create['company_id'] = $request->user['company_id'];
        $create['config'] = json_encode(['only'=>$request->only,'interval'=>$request->interval,'queuing'=>$request->queuing]);

        $result = Reserve::create($create);

        if($result){
            return success('添加成功','reserves');
        }else{
            return error('网络异常');
        }
    }

    public function show(Reserve $reserve)
    {
//dd(request()->id);die;
        return view('company.reserves.show',[
            'reserve'=>$reserve,
        ]);
    }

    public function getReserves(Request $request)
    {
        $month = $request->month?:date('Y-m');
        return Reserve::find($request->reserve_id)->reserveEvents()->where(['month'=>$month,'status'=>1])->get();
    }

    public function getReserveEvents(Request $request)
    {
        $date = $request->date?:date('Y-m-d');
        return Reserve::find($request->reserve_id)->reserveEvents()->where('date',$date)->get();
    }

    /**
     * 编辑页面
     *
     * @param Reserve $reserve
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Reserve $reserve)
    {

        $interval = [];
        foreach ($reserve['config']['interval']['start_time'] as $k=>$v){
            $interval[$k]['start_time'] = $v;
            $interval[$k]['end_time'] = $reserve['config']['interval']['end_time'][$k];

        }

        return view('company.reserves.edit',[
            'reserve'=>$reserve,
            'interval'=>$interval,
        ]);
    }


    public function update(Request $request, Reserve $reserve)
    {
        $this->validate($request, [
            'name' => ['required'],
            'min_ahead_days' => ['required'],
            'max_ahead_days' => ['required'],
        ]);

        $update = $request->post();
        $update['status'] = switchery2db($update['status']??0);
        $update['config'] = json_encode(['only'=>$request->only,'interval'=>$request->interval,'queuing'=>$request->queuing]);

        $result = $reserve->update($update);


        if($result){
            return success('编辑成功','reserves');
        }else{
            return error('网络异常');
        }
    }
}
