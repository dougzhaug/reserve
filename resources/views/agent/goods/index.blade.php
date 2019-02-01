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
        <table id="data-tables" class="table table-striped table-bordered" data-url="{{url('goods/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
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
                    "targets": 4,   //导航模式
                    className : 'td-center',
                    "render": function (data,type,row){
                        var btn = row.is_nav ? 'info' : 'danger';
                        var i = row.is_nav ? 'check' : 'times';
                        return `<button type="button" onclick="toggleNav(this)" data-url="{{url('permissions/toggle_nav')}}`+`/` + row.id + `" data-nav="` + row.is_nav + `" class="btn btn-` + btn + ` btn-circle" style="text-align: center;"><i class="fa fa-` + i + `"></i></button>`;
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

        /**
         * 修改排序请求
         */
        function permissionSort(that){
            var id = $(that).data('id');
            var old = $(that).data('old');
            var now = $(that).parent().prev('input').val();
            if(old == now){
                return false;
            }

            sweetConfirm('确定要修改吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:"{{url('permissions/sort')}}"+'/'+id,
                    data:{sort:now,'_token':'{{csrf_token()}}'},
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

        /**
         * 导航模式切换
         *
         * @param that
         */
        function toggleNav(that) {
            sweetConfirm('确定修改导航模式吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:$(that).data('url'),
                    data:{'nav':$(that).data('nav'),'_token':'{{csrf_token()}}'},
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