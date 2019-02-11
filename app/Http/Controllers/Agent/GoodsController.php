<?php

namespace App\Http\Controllers\Agent;

use App\Models\Goods;
use App\Models\GoodsTag;
use Illuminate\Http\Request;

class GoodsController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Goods::where('agent_id',$request->user['id'])->select(['id','name','author','images','category','price','status','created_at']);

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
        return view('agent.goods.index',['dropdowns'=>$dropdowns]);
    }

    public function create()
    {
        return view('agent.goods.create',[
            'category'=>Goods::getCategorySelect()
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

        $result = Goods::create($create);

        if($result){
            GoodsTag::makeTag($result,$request['tags']);
            return success('添加成功','goods');
        }else{
            return error('网络异常');
        }
    }

    public function show(Request $request, Goods $goods)
    {
        if($goods['agent_id'] != $request->user['id']) return error('请求异常');

        return view('agent.goods.show',[
            'goods' => $goods
        ]);
    }

    /**
     * @param Goods $goods
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Goods $goods)
    {
        $goods['tags'] = implode(',',array_column($goods->tags->toArray(),'name'));
        return view('agent.goods.edit',[
            'goods'=>$goods,
            'category'=>Goods::getCategorySelect($goods['category'])
        ]);
    }

    public function update(Request $request, Goods $goods)
    {
        if($goods['agent_id'] != $request->user['id']) return error('请求异常');

        $this->validate($request, [
            'category' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'images' => ['required','array','between:3,3'],
        ]);

        $update = $request->post();

        $result = $goods->update($update);

        if($result){
            GoodsTag::makeTag($goods,$request['tags']);
            return success('编辑成功','goods');
        }else{
            return error('网络异常');
        }
    }

    public function destroy(Request $request, Goods $goods)
    {
        if($goods['agent_id'] != $request->user['id']) return ['errorCode'=>1,'message'=>'请求异常'];

        $result = $goods->delete();
        if($result){
            return ['errorCode'=>0,'message'=>'成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
