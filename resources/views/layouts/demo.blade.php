@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">DEMO</h3>
    <p class="text-muted m-b-30 font-13"> 列表页面Demo </p>

    {{-- 列表页面Demo --}}

    <form action="" class="">
        <div class="input-group m-b-10 col-sm-3">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">权限</button>
            </span>
            {{-- Select2 插件 --}}
            @include('layouts.plugins.Select2',['name'=>'pid','options'=>['足球'=>1,'篮球'=>3,'乒乓球'=>5],'selected'=>[5]])
        </div>

        <div class="input-group m-b-10 col-sm-3">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{-- Daterangepicker 时间插件 --}}
            @include('layouts.plugins.Daterangepicker')
        </div>

        <div class="input-group m-b-10 col-sm-3">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">交易时间</button>
            </span>
            {{-- Daterangepicker 时间插件 --}}
            @include('layouts.plugins.Daterangepicker')
        </div>

        <div class="input-group m-b-10 col-sm-3">
            <div class="input-group">
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker',['style'=>'btn'])
            </div>
        </div>

        <div class="input-group m-b-10 col-sm-3">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">范围</button>
            </span>
            <div class="input-group">
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker',['style'=>'btn','placeholder'=>'请选择时间'])
            </div>
        </div>

        <div class="input-group m-b-10 col-sm-3">
            @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]])
        </div>
    </form>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped" data-url="{{url('agents')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="username">用户名</th>
                <th data-name="nickname" data-sort="true">昵称</th>
                <th data-name="phone">手机号</th>
                <th data-name="created_at">添加时间</th>
                <th data-name="">操作</th>
            </tr>
            </thead>
            <tbody>

            {{--DataTables插件--}}
            @include('layouts.plugins.DataTables')

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>昵称</th>
                <th>手机号</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </tfoot>
        </table>
    </div>

    {{-- 列表页面Demo(完) --}}

    <br><br>
    <p class="text-muted m-b-30 font-13"> 表单页面Demo </p>

    {{-- 表单页面Demo --}}
    <form class="form-horizontal" action="{{url('test')}}">

        <div class="form-group">
            <label class="col-sm-2 control-label">下拉框</label>
            <div class="col-sm-9">

                {{-- Select2 下拉插件 --}}
                @include('layouts.plugins.Select2',['name'=>'pid','options'=>[['name'=>'篮球','value'=>3],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>10]],'multiple'=>0,'selected'=>[5]])

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开关</label>
            <div class="col-sm-9">

                {{-- Switchery 开关插件 --}}
                @include('layouts.plugins.Switchery',['name'=>'status','color'=>'red','checked'=>true])

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">复选</label>
            <div class="col-sm-9">

                {{-- Checkbox 复选框插件 --}}
                @include('layouts.plugins.Checkbox',['name'=>'kkie','level'=>1,'style'=>'info','checkbox'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5,'checked'=>true,'disabled'=>1],['name'=>'乒乓球','value'=>3,'checked'=>true]]])

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">单选</label>
            <div class="col-sm-9">

                {{-- Radio 单选框插件 --}}
                @include('layouts.plugins.Radio',['name'=>'kkie','style'=>'info','level'=>1,'radio'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>3]]])

            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">时间选择器1</label>
            <div class="col-sm-9">
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker',['style'=>'single','opens'=>'left','value'=>'2018-12-20 12:02:22 ~ 2018-3-2'])
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">时间选择器2</label>
            <div class="col-sm-9">
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker',['time_picker'=>'true','show_dropdowns'=>'false'])
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputuname" class="col-sm-2 control-label">时间选择器3</label>
            <div class="col-sm-9">
                <div class="input-group">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['style'=>'reservation-time'])
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputuname" class="col-sm-2 control-label">时间选择器4</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker')
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">时间选择器5</label>
            <div class="col-sm-9">
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker',['style'=>'btn','opens'=>'left'])
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">上传</label>
            <div class="col-sm-9">

                {{-- 上传 --}}
                @uploader('assets')
                @uploader(['name' => 'avatar', 'max' => 100, 'accept' => 'jpg,png,gif,pdf,txt,csv'])
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">标签输入框</label>
            <div class="col-sm-9">
                @include('layouts.plugins.TagsInput',['name'=>'tag','value'=>'角色,卡死了'])
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

    {{-- 表单页面Demo(完) --}}
@endsection

@push('script')
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();


        /**
         * 重构操作栏
         *
         * @param data
         * @param type
         * @param row
         * @returns {string}
         */
        function getButton(data,type,row)
        {
            var html = '';
            html += '<a href="{{url('admin/edit')}}/'+data.id+'" class="btn btn-primary btn-xs tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<a href="{{url('admin/destroy')}}/'+data.id+'" class="btn btn-danger btn-xs tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
            return html;
        }

        /**
         * 删除 （自定义）
         */
        $('body').on('click','.tables-delete',function(){
            if(!confirm('确认要删除吗')){
                return false;
            }
        });
    </script>
@endpush