@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">添加权限</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('test')}}">

        <div class="form-group">
            <label class="col-sm-2 control-label">父级</label>
            <div class="col-sm-9">

                {{-- Select2 插件 --}}
                @include('layouts.plugins.Select2',['name'=>'pid','options'=>$permission,'multiple'=>0])

            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Username*</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="inputEmail1" placeholder="Username"> </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="inputEmail2" placeholder="Email"> </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Website"> </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password*</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> </div>
        </div>
        <div class="form-group">
            <label for="inputPassword4" class="col-sm-2 control-label">Re Password*</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword4" placeholder="Retype Password"> </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <div class="checkbox checkbox-success">
                    <input id="checkbox33" type="checkbox">
                    <label for="checkbox33">Check me out !</label>
                </div>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-offset-2 col-sm-9">
                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Sign in</button>
            </div>
        </div>
    </form>
@endsection