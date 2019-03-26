@extends($layout)

@section('content')
    <form class="form-horizontal" action="{{url('chapters',[$chapter['id']])}}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH')}}

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">名称*</label>
            <div class="col-sm-9">
                <input name="name" type="text" value="{{$chapter['name'] or old('name') }}" class="form-control" id="inputName" placeholder="名称">
                @if ($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('files') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label">资源*</label>
            <div class="col-sm-9">
                @uploader(['name' => 'files', 'max'=>100, 'accept' => 'jpg,png,gif,txt,pdf','src'=>$chapter['files']])
                {{-- 文件上传 --}}
                @uploader('assets')
                @if ($errors->has('files'))
                    <span class="help-block">{{$errors->first('files')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('summary') ? ' has-error' : '' }}">
            <label for="inputPrice" class="col-sm-2 control-label">简介*</label>
            <div class="col-sm-9">
                <textarea name="summary" class="form-control" rows="5" placeholder="简介">{{$chapter['summary'] or old('summary')}}</textarea>
                @if ($errors->has('summary'))
                    <span class="help-block">{{$errors->first('summary')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputSort" class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9">
                <input name="sort" type="text" value="{{$chapter['sort'] or old('sort')}}" class="form-control" id="inputSort" placeholder="排序"> </div>
        </div>

        <div class="form-group">
            <label for="inputCharge" class="col-sm-2 control-label">模式</label>
            <div class="col-sm-9">

                {{-- Radio 单选框插件 --}}
                @include('layouts.plugins.Radio',['name'=>'charge','checked'=>$chapter['charge'],'style'=>'info','level'=>1,'radio'=>[['name'=>'免费','value'=>0],['name'=>'收费','value'=>1]]])
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