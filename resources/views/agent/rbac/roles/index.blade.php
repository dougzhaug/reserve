@extends($layout)

@section('content')
    <h3 class="box-title">Editable with Datatable</h3>
    <p class="text-muted">Just click on word which you want to change and enter</p>
    <div class="box-body">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('roles/index')}}">
            <div class="input-group m-b-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]])
            </div>
        </form>
    </div>
    <div class="box-label">
        <a href="{{url('roles/create')}}" class="btn btn-info">添加角色</a>
    </div>

    <div class="table-responsive">
        <table id="data-tables" class="table table-striped" data-url="{{url('roles/index')}}">
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
            html += '<a href="roles/'+data.id+'/edit" class="btn btn-info btn-xs tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="roles/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }

        $(function () {
            sweetConfirm(function (isConfirm) {
                alert(isConfirm);
            });
        })
    </script>
@endpush