@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">编辑角色</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('roles',[$role['id']])}}" method="post" onsubmit="return getContainUndetermined()">
        {{ csrf_field() }}
        {{ method_field('PATCH')}}

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">名称*</label>
            <div class="col-sm-9">
                <input name="name" type="text" value="{{$role['name'] or old('name') }}" class="form-control" id="inputName" placeholder="名称">
                @if ($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('depict') ? ' has-error' : '' }}">
            <label for="inputDepict" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-9">
                <input name="depict" type="text" value="{{$role['depict'] or old('depict') }}" class="form-control" id="inputDepict" placeholder="角色描述">
                @if ($errors->has('depict'))
                    <span class="help-block">{{$errors->first('depict')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-9">

                {{-- Switchery 开关插件 --}}
                @include('layouts.plugins.Switchery',['name'=>'status','checked'=>$role['status']])

            </div>
        </div>

        <div class="form-group {{ $errors->has('permissions') ? ' has-error' : '' }}" >
            <label for="permissions" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-9">

                {{--JsTree插件--}}
                @include('layouts.plugins.JsTree',['url'=>url('roles/permission_tree',[$role['id']]),'name'=>'permissions'])

                @if ($errors->has('permissions'))
                    <span class="help-block">{{$errors->first('permissions')}}</span>
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

@push('script')
    <script>
        //树状结构背景设置
        $('#js-tree').css({'border':'1px solid #96c2f1','background':'#eff7ff','padding':'10px'});
    </script>
@endpush