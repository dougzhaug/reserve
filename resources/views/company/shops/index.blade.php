@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('shops/index')}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['group'=>0,'dropdowns'=>$dropdowns])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info">查询</button>
            </div>
        </form>
    </div>
    <div class="box-label m-t-10 m-b-20">
        <a href="{{url('shops/create')}}" class="btn btn-info">添加商店</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('shops/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
                <th data-name="logo">商店LOGO</th>
                <th data-name="manager_id">店长</th>
                <th data-name="status">状态</th>
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
                <th>商店LOGO</th>
                <th>店长</th>
                <th>状态</th>
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
                    "targets": 2,   //LOGO
                    "render": function (data,type,row){
                        return `<img src="`+row.logo+`" alt="Boiox" width="40">`;
                    }
                },
                {
                    "targets": 4,   //状态
                    className : 'td-center',
                    "render": function (data,type,row){
                        var btn = '';
                        var msg = '';
                        switch(row.status){
                            case 1:
                                btn = 'info'; msg = '正常';
                                break;
                            case 2:
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
            html += '<a href="chapters/'+data.id+'" class="btn btn-success btn-xs tables-console tables-show"><span class="fa fa-file-text-o"></span>预约管理</a>';
            html += '<a href="shops/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="shops/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush