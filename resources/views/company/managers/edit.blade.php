@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">编辑会员</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('managers/'.$manager['id'])}}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH')}}

        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="inputAlias" class="col-sm-2 control-label">用户名*</label>
            <div class="col-sm-9">
                <input name="username" type="text" value="{{$manager['username'] or old('username') }}" class="form-control" id="inputAlias" placeholder="名称">
                @if ($errors->has('username'))
                    <span class="help-block">{{$errors->first('username')}}</span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('nickname') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">昵称</label>
            <div class="col-sm-9">
                <input name="nickname" type="text" value="{{$manager['nickname'] or old('nickname') }}" class="form-control" id="inputName" placeholder="角色描述">
                @if ($errors->has('nickname'))
                    <span class="help-block">{{$errors->first('nickname')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-9">

                {{-- Switchery 开关插件 --}}
                @include('layouts.plugins.Switchery',['name'=>'status','checked'=>$manager['status']])

            </div>
        </div>

        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
            <label for="permission" class="col-sm-2 control-label">分配权限</label>
            <div class="col-sm-9">
                @include('layouts.plugins.Select2',['name'=>'roles[]','options'=>$roles,'multiple'=>true,'selected'=>$manager_roles])

                @if ($errors->has('roles'))
                    <span class="help-block">{{$errors->first('roles')}}</span>
                @endif

            </div>
        </div>

        <div class="form-group m-b-0">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-default waves-effect waves-light m-t-10">取消</button>
                <button type="submit" class="btn btn-info waves-effect waves-left m-t-10">提交</button>
            </div>
        </div>
    </form>
@endsection

