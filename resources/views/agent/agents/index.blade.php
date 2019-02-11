@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('agents')}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">权限</button>
                </span>
                {{-- Select2 插件 --}}
                @include('layouts.plugins.Select2',['name'=>'pid','options'=>['足球'=>1,'篮球'=>3,'乒乓球'=>5],'selected'=>[5]])
            </div>

            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>$dropdowns])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info">查询</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped product-overview" data-url="{{url('agents')}}">
            <thead>
                <tr>
                    <th data-name="id" data-sort="true">ID</th>
                    <th data-name="username">用户名</th>
                    <th data-name="nickname" data-sort="true">昵称</th>
                    <th data-name="phone">手机号</th>
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
                    <th>用户名</th>
                    <th>昵称</th>
                    <th>手机号</th>
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
         *
         */
        function decorateColumn()
        {
            return [
                {
                    "targets": 4,   //状态
                    "className": 'td-center',
                    "render": function (data,type,row){
                        var btn = row.status ? 'info' : 'danger';
                        var i = row.status ? 'check' : 'times';
                        return `<button type="button" onclick="toggleStatus(this)" data-url="{{url('agents/status')}}`+`/` + row.id + `" data-status="` + row.status + `" class="btn btn-` + btn +` btn-circle"><i class="fa fa-` + i + `"></i> </button>`;
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
            html += '<a href="agents/'+data.id+'/edit" class="btn btn-primary btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<a href="{{url('admin/destroy')}}/'+data.id+'" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
            return html;
        }

        /**
         * 状态切换
         * @param that
         */
        function toggleStatus(that) {
            sweetConfirm('确定修改状态吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:$(that).data('url'),
                    data:{'status':$(that).data('status'),'_token':'{{csrf_token()}}'},
                    type:'POST',
                    success:function(result){
                        if(!result.errorCode){
                            swal({'title':result.message,'type':'success'},function () {
                                window.location.reload();
                            });
                        }else{
                            swal(result.message,'','error');
                        }
                    }
                });
            });
        }
    </script>
@endpush