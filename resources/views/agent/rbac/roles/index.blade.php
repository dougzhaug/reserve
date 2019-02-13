@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('roles/index')}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]])
            </div>
        </form>
    </div>
    <div class="box-label m-t-10 m-b-20">
        <a href="{{url('roles/create')}}" class="btn btn-info">添加角色</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped table-bordered product-overview" data-url="{{url('roles/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name" data-sort="true">角色名称</th>
                <th data-name="depict">描述</th>
                <th data-name="status">状态</th>
                <th data-name="created_at">创建时间</th>
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
                <th>角色名称</th>
                <th>描述</th>
                <th>状态</th>
                <th>创建时间</th>
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
                    "targets": 3,   //状态
                    "className": 'td-center',
                    "render": function (data,type,row){
                        var btn = row.status ? 'info' : 'danger';
                        var i = row.status ? 'check' : 'times';
                        return `<button type="button" onclick="toggleStatus(this)" data-url="{{url('roles/status')}}`+`/` + row.id + `" data-status="` + row.status + `" class="btn btn-` + btn +` btn-circle"><i class="fa fa-` + i + `"></i> </button>`;
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
            html += '<a href="roles/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="roles/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
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
                    },
                    error:function (err) {
                        swal(err.status + ' ' + err.statusText,'','error');
                    }
                });
            });
        }

    </script>
@endpush