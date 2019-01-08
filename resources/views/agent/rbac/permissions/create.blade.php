@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">添加权限</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('permissions')}}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label class="col-sm-2 control-label">父级</label>
            <div class="col-sm-9">

                {{-- Select2 下拉插件 --}}
                @include('layouts.plugins.Select2',['name'=>'pid','options'=>$permission_select])

            </div>
        </div>

        <div class="form-group {{ $errors->has('alias') ? ' has-error' : '' }}">
            <label for="inputAlias" class="col-sm-2 control-label">名称*</label>
            <div class="col-sm-9">
                <input name="alias" type="text" value="{{ old('alias') }}" class="form-control" id="inputAlias" placeholder="名称">
                @if ($errors->has('alias'))
                    <span class="help-block">{{$errors->first('alias')}}</span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">权限规则*</label>
            <div class="col-sm-9">
                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="权限规则">
                @if ($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="inputUrl" class="col-sm-2 control-label">Url</label>
            <div class="col-sm-9">
                <input name="url" type="text" class="form-control" id="inputUrl" placeholder="Url"> </div>
        </div>
        <div class="form-group">
            <label for="inputSort" class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9">
                <input name="sort" type="text" class="form-control" id="inputSort" placeholder="排序"> </div>
        </div>
        <div class="form-group">
            <label for="inputIcon" class="col-sm-2 control-label">Icon</label>
            <div class="col-sm-9">
                <input name="icon" type="text" class="form-control" id="inputIcon" placeholder="Icon"> </div>
        </div>

        <div class="form-group">
            <label for="inputRemark" class="col-sm-2 control-label">备注</label>
            <div class="col-sm-9">
                <input name="remark" type="text" class="form-control" id="inputRemark" placeholder="备注"> </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">导航模式</label>
            <div class="col-sm-9">

                {{-- Switchery 开关插件 --}}
                @include('layouts.plugins.Switchery',['name'=>'is_nav'])

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