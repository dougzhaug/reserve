@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('chapters/index/'.request('goods_id'))}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['group'=>0,'dropdowns'=>$dropdowns])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info">查询</button>
            </div>
        </form>
    </div>
    <div class="box-label m-t-10 m-b-20">
        <a href="{{url('chapters/create/'.request('goods_id'))}}" class="btn btn-info">添加章节</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('chapters/index/'.request('goods_id'))}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
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
                    "targets": 2,   //缩略图
                    "render": function (data,type,row){
                        return `<img src="{{img_path()}}`+row.images[0]+`" alt="Boiox" width="50">`;
                    }
                },
                {
                    "targets": 5,   //状态
                    className : 'td-center',
                    "render": function (data,type,row){
                        var btn = '';
                        var msg = '';
                        switch(row.status){
                            case -1:
                                btn = 'danger'; msg = '未通过';
                                break;
                            case 0:
                                btn = 'warning'; msg = '审核中';
                                break;
                            case 1:
                                btn = 'info'; msg = '已通过';
                                break;
                            case 2:
                                btn = 'success'; msg = '上架';
                                break;
                            case 3:
                                btn = 'danger'; msg = '下架';
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
            html += '<a href="chapters/index/'+data.id+'" class="btn btn-success btn-xs tables-console tables-show"><span class="fa fa-file-text-o"></span>章节管理</a>';
            html += '<a href="goods/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="goods/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush