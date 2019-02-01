<?php

namespace App\Http\Controllers\Agent;

use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = Goods::select(['id','name','author','images','category','price','status','created_at']);

            /* where start*/

            if($request->keyword){
                $builder->where($request->action_field,'like','%'.$request->keyword.'%');
            }

            if($request->date_range){
                $builder->whereBetween('created_at',[$request->start_date,$request->end_date]);
            }

            /* where end */

            //获取总条数
            $total = $builder->count();

            /* order start */
            if($request->order){
                $order = $request->order[0];
                $order_column = $columns[$order['column']]['data'];
                $order_dir = $order['dir'];
                $builder->orderBy($order_column,$order_dir);
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

        $actionField = ['name'=>'姓名','phone'=>'手机号','email'=>'邮箱'];
        return view('agent.goods.index',['actionField'=>$actionField]);
    }

    public function create()
    {
        return view('agent.goods.create',[
            'category'=>[['name'=>'请选择','value'=>''],['name'=>'图集','value'=>1]]
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'images' => ['required','array','between:3,3'],
        ]);

        $create = $request->post();
        $create['agent_id'] = $request->user['id'];

        $permission = Goods::create($create);

        if($permission){
            return success('添加成功','goods');
        }else{
            return error('网络异常');
        }
    }

    public function show()
    {

    }

    public function edit()
    {
        return view('agent.goods.edit',[
            'category'=>[['name'=>'请选择','value'=>''],['name'=>'图集','value'=>1]]
        ]);
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
