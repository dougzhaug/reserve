@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">添加商品</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('goods')}}" method="post">
        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label">类型*</label>
            <div class="col-sm-9">

                {{-- Select2 下拉插件 --}}
                @include('layouts.plugins.Select2',['name'=>'category','options'=>$category])

                @if ($errors->has('category'))
                    <span class="help-block">{{$errors->first('category')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">名称*</label>
            <div class="col-sm-9">
                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="名称">
                @if ($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="inputPrice" class="col-sm-2 control-label">价格*</label>
            <div class="col-sm-9">
                <input name="price" type="text" value="{{ old('price') }}" class="form-control" id="inputPrice" placeholder="价格">
                @if ($errors->has('price'))
                    <span class="help-block">{{$errors->first('price')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('images') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label">展示图集*</label>
            <div class="col-sm-9">
                {{-- 文件上传 --}}
                @uploader('assets')
                {{--@uploader(['name' => 'images', 'max' => 3, 'accept' => 'jpg,png,gif','src'=>['2019-02-01/jIKu8eixHquaKorJjoqDG4MRExwmz3csKZo75Ve9.jpg','2019-02-01/NgrvNVDBUjD8Urt2ITCmu4ihYQZTyVeLZooTsg18.jpg','2019-02-01/cAcfwkM4rQOtporY27m3BI2cXVCPj664AJf3hKP4.jpg']])--}}
                @uploader(['name' => 'images', 'max' => 3, 'accept' => 'jpg,png,gif','src'=>['2019-02-01/jIKu8eixHquaKorJjoqDG4MRExwmz3csKZo75Ve9.jpg','2019-02-01/NgrvNVDBUjD8Urt2ITCmu4ihYQZTyVeLZooTsg18.jpg']])
                {{--@uploader(['name' => 'images', 'max' => 3, 'accept' => 'jpg,png,gif'])--}}
                <span> 600 * 600  - | - 720*1280 - | - 1280*720</span>
                @if ($errors->has('images'))
                    <span class="help-block">{{$errors->first('images')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputAuthor" class="col-sm-2 control-label">作者</label>
            <div class="col-sm-9">
                <input name="author" type="text" value="{{ old('author') }}" class="form-control" id="inputAuthor" placeholder="作者"> </div>
        </div>

        <div class="form-group">
            <label for="inputSort" class="col-sm-2 control-label">简介</label>
            <div class="col-sm-9">
                <textarea name="summary" class="form-control" rows="5" placeholder="商品简介">{{ old('summary') }}</textarea> </div>
        </div>

        <div class="form-group m-b-0">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-default waves-effect waves-light m-t-10">取消</button>
                <button type="submit" class="btn btn-info waves-effect waves-left m-t-10">提交</button>
            </div>
        </div>
    </form>
@endsection