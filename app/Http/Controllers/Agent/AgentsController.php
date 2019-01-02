<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentsController extends AgentAuthController
{
    /**
     * 首页
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = Agent::select(['id','openid','username','sex','avatar','phone','nickname','authorize_status','source','created_at']);

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
        return view('agent.agents.index',['actionField'=>$actionField]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admin.create',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required','unique:admins',new phone()],
            'email' => 'string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'permissions' => 'required',
        ]);

        $create = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $admin = Admin::create($create);

        if(!$admin){
            return error('网络异常');
        }

        $result = $admin->assignRole($request->permissions);

        if($result){
            return success('添加成功','admin');
        }else{
            return error('网络异常');
        }

    }

    /**
     * 展示页面
     *
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Admin $admin)
    {
        return view('admin.admin.show');
    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Admin $admin)
    {
        //
        $roles = Role::all();
        $admin_roles = array_column($admin->roles->toArray(),'id') ? : [];  //获取当前用户的角色
        return view('admin.admin.edit',['admin'=>$admin,'roles'=>$roles,'admin_roles'=>$admin_roles]);
    }

    /**
     * @param Request $request
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required',new phone()],
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:6',
            'permissions' => 'required',
        ]);

        $update = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if($request->password) $update['password'] = bcrypt($request->password);

        $admin_result = $admin->update($update);

        if(!$admin_result){
            return error('网络异常');
        }

        $result = $admin->syncRoles($request->permissions);

        if($result){
            return success('编辑成功','admin');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $result = $admin->delete();
        if($result){
            return success('删除成功','role');
        }else{
            return error('网络异常');
        }
    }
}
