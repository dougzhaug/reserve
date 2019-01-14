<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Models\Role;
use App\Rules\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Guard;

class AgentsController extends AuthController
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

            $builder = Agent::select(['id','openid','username','sex','avatar','phone','nickname','authorize_status','status','source','created_at']);

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
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        return view('agent.agents.create',['roles'=>$roles]);
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
            return success('添加成功','agents');
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
     * 编辑页面
     *
     * @param Agent $agent
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Agent $agent)
    {
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        $agent_roles = array_column($agent->roles->toArray(),'id') ? : [];  //获取当前用户的角色
        return view('agent.agents.edit',['agent'=>$agent,'roles'=>$roles,'agent_roles'=>$agent_roles]);
    }

    /**
     * 编辑
     *
     * @param Request $request
     * @param Agent $agent
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Agent $agent)
    {
        $this->validator($request->all(),[
            'username' => 'required|string|max:255',
            'roles' => 'required',
        ]);

        $update = [
            'username' => $request->username,
            'nickname' => $request->nickname,
            'status' => $request->status,
        ];

        $agent_result = $agent->update($update);
        if(!$agent_result){
            return error('网络异常');
        }

        $result = $agent->syncRoles($request->roles);
        if($result){
            return success('编辑成功','agents');
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
    public function destroy(Agent $agent)
    {
        $result = $agent->delete();
        if($result){
            return success('删除成功','role');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 状态切换
     *
     * @param Agent $agent
     * @param Request $request
     * @return array
     */
    public function status(Agent $agent,Request $request)
    {
        $result = $agent->update(['status'=>$request->status ? 0 : 1]);
        if($result){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
