@extends($layout)

@section('content')
    <h3 class="box-title">Editable with Datatable</h3>
    <p class="text-muted">Just click on word which you want to change and enter</p>
    <div class="box-body">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('goods/index')}}">
            <div class="input-group m-b-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['group'=>0,'dropdowns'=>[['name'=>'名称','value'=>'title'],['name'=>'电话','value'=>'phone']]])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
            </div>
        </form>
    </div>
    <div class="box-label">
        <a href="{{url('goods/create')}}" class="btn btn-info">添加商品</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('goods/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
                <th data-name="images">缩略图</th>
                <th data-name="author">作者</th>
                <th data-name="price">价格</th>
                <th data-name="status">状态</th>
                <th data-name="created_at">添加时间</th>
                <th data-name="">操作</th>
            </tr>
            </thead>
            <tbody>

            {{--DataTables插件--}}
            @include('layouts.plugins.DataTables',['paging'=>false])

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>缩略图</th>
                <th>作者</th>
                <th>价格</th>
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
                    "targets": 2,   //缩略图
                    "render": function (data,type,row){
                        return `<img src="/storage/uploads/`+row.images[0]+`" alt="iMac" width="50">`;
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
                        {{--return `<button type="button" onclick="toggleNav(this)" data-url="{{url('permissions/toggle_nav')}}`+`/` + row.id + `" data-nav="` + row.is_nav + `" class="btn btn-` + btn + ` btn-circle" style="text-align: center;"><i class="fa fa-` + i + `"></i></button>`;--}}
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
            html += '<a href="goods/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="goods/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush