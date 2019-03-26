<?php

namespace App\Http\Controllers\Company\Rbac;

use App\Http\Controllers\Company\AuthController;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Guard;

class PermissionsController extends AuthController
{

    /**
     * 列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $builder = Permission::where('guard_name',Guard::getDefaultName(static::class))
                ->select(['id','name as rule','pid','url','title as name','sort','remark','icon','is_nav','created_at']);

            /* where start*/
            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }
            /* where end */

            //count
            $total = $builder->count();

            /* order start */
            if($request->order){
                $builder->orderBy($request->columns[$request->order[0]['column']]['data'],$request->order[0]['dir']);
            }
            /* order end */

            $data = $builder->get();

            $data = make_tree_to_array($data);

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        return view('company.rbac.permissions.index');
    }

    /**
     * 添加页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('company.rbac.permissions.create',[
            'permission_select'=>Permission::getSelectArray($request->id),
        ]);
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
            'name' => ['required','unique:permissions'],
            'title' => ['required','unique:permissions'],
        ]);

        $create = $request->post();
        $create['is_nav'] = $create['is_nav'] ?? 0;

        $permission = Permission::create($create);

        if($permission){
            return success('添加成功','permissions');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 编辑页面
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view('company.rbac.permissions.edit',[
            'permission'=>$permission,
            'permission_select'=>Permission::getSelectArray($permission['pid'])
        ]);
    }

    /**
     * 编辑
     *
     * @param Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Permission $permission,Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'title' => ['required'],
        ]);

        $update = $request->post();
        $update['is_nav'] = $update['is_nav'] ?? 0;

        $result = $permission->update($update);

        if($result){
            return success('添加成功','permissions');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 删除
     *
     * @param Permission $permission
     * @return array
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        $permission = $permission->delete();
        if($permission){
            return ['errorCode'=>0,'message'=>'成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

    /**
     * 排序
     *
     * @param Permission $permission
     * @param Request $request
     * @return array
     */
    public function sort(Permission $permission,Request $request)
    {
        $result = $permission->update(['sort'=>$request->sort]);
        if($result){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

    /**
     * 导航模式切换
     *
     * @param Permission $permission
     * @param Request $request
     * @return array
     */
    public function toggleNav(Permission $permission,Request $request)
    {
        $result = $permission->update(['is_nav'=>$request->nav ? 0 : 1]);
        if($result){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

}
