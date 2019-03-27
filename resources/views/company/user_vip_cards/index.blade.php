@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('user_vip_cards/index')}}">
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
        <a href="{{url('user_vip_cards/create')}}" class="btn btn-info">添加会员卡</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('user_vip_cards/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
                <th data-name="card_number">卡号</th>
                <th data-name="type">类型</th>
                <th data-name="universal">是否通用</th>
                <th data-name="balance">余额</th>
                <th data-name="status">状态</th>
                <th data-name="expired_at">过期时间</th>
                @if(request()->role == 110)<th data-name="shop_id">所属商店</th>@endif
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
                <th>名称</th>
                <th>卡号</th>
                <th>类型</th>
                <th>是否通用</th>
                <th>余额</th>
                <th>状态</th>
                <th>过期时间</th>
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
            var html = '';
            html += '<a href="chapters/'+data.id+'" class="btn btn-success btn-xs tables-console tables-show"><span class="fa fa-credit-card-alt"></span>会员卡管理</a>';
            html += '<a href="shops/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="shops/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush