<?php

namespace App\Http\Controllers\Company;

use App\Models\Chapter;
use App\Models\Goods;
use Illuminate\Http\Request;

class ChaptersController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            $builder = Chapter::where('goods_id',$request->goods_id)->select(['id', 'name', 'summary', 'sort', 'charge', 'created_at']);

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
        return view('agent.chapters.index',[
            'dropdowns'=> $dropdowns,
            'goods'=> Goods::find($request->goods_id)
        ]);
    }

    public function create()
    {
        return view('agent.chapters.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'files' => ['required','array','between:1,100'],
            'summary' => ['required'],
        ]);

        $create = $request->post();
        $create['goods_id'] = $request->goods_id;
        $create['file_format'] = file_format($request['files'][0]);

        $result = Chapter::create($create);

        if($result){
            return success('添加成功','chapters/'.$request->goods_id);
        }else{
            return error('网络异常');
        }
    }

    public function edit(Chapter $chapter)
    {
        return view('agent.chapters.edit',[
            'chapter'=>$chapter
        ]);
    }

    public function update(Request $request, Chapter $chapter)
    {
        $this->validate($request, [
            'name' => ['required'],
            'files' => ['required','array','between:1,100'],
            'summary' => ['required'],
        ]);

        $update = $request->post();
        $update['file_format'] = file_format($request['files'][0]);

        $result = $chapter->update($update);

        if($result){
            return success('编辑成功','chapters/'.$chapter['goods_id']);
        }else{
            return error('网络异常');
        }
    }

    public function destroy(Chapter $chapter)
    {
        $result = $chapter->delete();
        if($result){
            return ['errorCode'=>0,'message'=>'成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

    /**
     * 排序
     *
     * @param Chapter $chapter
     * @param Request $request
     * @return array
     */
    public function sort(Chapter $chapter,Request $request)
    {
        $result = $chapter->update(['sort'=>$request->sort]);
        if($result){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
