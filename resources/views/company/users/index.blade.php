@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('users/index')}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['group'=>0,'dropdowns'=>$dropdowns])
            </div>

            @if(request()->role == 110)
                <div class="input-group m-b-10 col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">商店</button>
                </span>
                    {{-- Select2 插件 --}}
                    @include('layouts.plugins.Select2',['name'=>'shop_id','options'=>$shops])
                </div>
            @endif

            <div class="input-group m-b-10 col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">状态</button>
                </span>
                {{-- Select2 插件 --}}
                @include('layouts.plugins.Select2',['name'=>'status','options'=>[['name'=>'请选择','value'=>''],['name'=>'正常','value'=>1],['name'=>'禁用','value'=>-1]]])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info">查询</button>
            </div>
        </form>
    </div>
    <div class="box-label m-t-10 m-b-20">
{{--        <a href="{{url('shops/create')}}" class="btn btn-info">添加商店</a>--}}
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('users/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="headimgurl">头像</th>
                <th data-name="nickname">昵称</th>
                <th data-name="remark">备注</th>
                <th data-name="phone">电话号码</th>
                <th data-name="sex">性别</th>
                <th data-name="status">状态</th>
                @if(request()->role == 110)<th data-name="shop_name">所属商店</th>@endif
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
                <th>头像</th>
                <th>昵称</th>
                <th>备注</th>
                <th>电话号码</th>
                <th>性别</th>
                <th>状态</th>
                @if(request()->role == 110)<th>所属商店</th>@endif
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('script')
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();

        /**
         * 列美化
         */
        function decorateColumn()
        {
            return [
                {
                    "targets": 1,   //头像
                    "render": function (data,type,row){
                        return `<img src="`+row.headimgurl+`" alt="Boiox" width="40">`;
                    }
                },
                {
                    "targets": 5,   //性别
                    className : 'td-center',
                    "render": function (data,type,row){

                        return row.sex == 1?'男':'女';
                    }
                },
                {
                    "targets": 6,   //状态
                    className : 'td-center',
                    "render": function (data,type,row){
                        var btn = '';
                        var msg = '';
                        switch(row.status){
                            case 1:
                                btn = 'info'; msg = '正常';
                                break;
                            case -1:
                                btn = 'danger'; msg = '停用';
                                break;
                        }
                        return `<span class="label label-` + btn + ` font-weight-100">` + msg + `</span>`;
                    }
                },
            ];
        }

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
            var shop_id = data.shop_id != undefined ? data.shop_id : 0;
            var html = '';
            html += '<a href="user_vip_cards/'+data.id+'/'+shop_id+'" class="btn btn-success btn-xs tables-console tables-show"><span class="fa fa-credit-card-alt"></span>会员卡管理</a>';
            html += '<a href="shops/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="shops/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush