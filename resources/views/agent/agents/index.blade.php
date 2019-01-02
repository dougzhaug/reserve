@extends($layout)

@section('content')
    <h3 class="box-title">Editable with Datatable</h3>
    <p class="text-muted">Just click on word which you want to change and enter</p>

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