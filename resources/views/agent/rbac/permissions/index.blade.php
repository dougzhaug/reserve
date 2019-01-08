@extends($layout)

@section('content')
    <h3 class="box-title">Editable with Datatable</h3>
    <p class="text-muted">Just click on word which you want to change and enter</p>
    <div class="box-body">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('permissions/index')}}">
            <div class="input-group m-b-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]])
            </div>
        </form>
    </div>
    <div class="box-label">
        <a href="{{url('permissions/create')}}" class="btn btn-info">添加权限</a>
    </div>


    <div class="table-responsive">
        <table id="data-tables" class="table table-striped" data-url="{{url('permissions/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
                <th data-name="rule">规则</th>
                <th data-name="pid">Pid</th>
                <th data-name="url">Url</th>
                <th data-name="sort">排序</th>
                <th data-name="remark">备注</th>
                <th data-name="icon">Icon</th>
                <th data-name="is_nav">导航模式</th>
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
                <th>规则</th>
                <th>Pid</th>
                <th>Url</th>
                <th>排序</th>
                <th>备注</th>
                <th>Icon</th>
                <th>导航模式</th>
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
            html += '<a href="permissions/create/'+data.id+'" class="btn btn-success btn-xs tables-add"><span class="glyphicon glyphicon-plus"></span>添加</a>';
            html += '<a href="permissions/'+data.id+'/edit" class="btn btn-info btn-xs tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="permissions/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }
    </script>
@endpush