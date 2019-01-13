@extends($layout)

@section('content')
    <h3 class="box-title">Editable with Datatable</h3>
    <p class="text-muted">Just click on word which you want to change and enter</p>

    <form action="" class="">
        <div class="input-group m-b-10 col-sm-3">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">权限</button>
            </span>
            {{-- Select2 插件 --}}
            @include('layouts.plugins.Select2',['name'=>'pid','options'=>['足球'=>1,'篮球'=>3,'乒乓球'=>5],'selected'=>[5]])
            {{--<input class="form-control" placeholder="Search for...">--}}
        </div>

        <div class="input-group m-b-10 col-sm-3">
            @include('layouts.plugins.DropdownsInput',['name'=>'pid','group'=>1,'dropdowns'=>[[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]]])
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
            html += '<a href="agents/'+data.id+'/edit" class="btn btn-primary btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<a href="{{url('admin/destroy')}}/'+data.id+'" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
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