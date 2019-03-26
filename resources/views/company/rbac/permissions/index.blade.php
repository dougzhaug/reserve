@extends($layout)

@section('content')
    <div class="box-body">
        <form id="formSearch" class="form-horizontal form-search" method="POST" action="{{url('permissions/index')}}">
            <div class="input-group m-b-10 m-r-10 col-sm-3">
                @include('layouts.plugins.DropdownsInput',['group'=>0,'dropdowns'=>[['name'=>'名称','value'=>'title'],['name'=>'电话','value'=>'phone']]])
            </div>

            <div class="search-input col-sm-1">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
            </div>
        </form>
    </div>
    <div class="box-label m-t-10 m-b-20">
        <a href="{{url('permissions/create')}}" class="btn btn-info">添加权限</a>
    </div>


    <div class="table-responsive">
        <table id="data-tables" class="table table-striped table-bordered product-overview" data-url="{{url('permissions/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">名称</th>
                <th data-name="rule">规则</th>
                <th data-name="url">Url</th>
                <th data-name="sort" data-sort="true" data-default-sort="desc" style="width: 80px;">排序</th>
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
         * 列美化
         */
        function decorateColumn()
        {
            return [
                {
                    "targets": 4,   //排序
                    "render": function (data,type,row){
                        var sort = row.sort ? row.sort : 0;
                        return `<div class="input-group input-group-sm col-sm-12">
                                    <input type="text" class="form-control " value="` + sort + `">
                                    <span class="input-group-btn">
                                    <button type="button" onclick="permissionSort(this)" class="btn btn-info btn-flat" data-old="` + sort + `" data-id="` + row.id + `">Go!</button>
                                    </span>
                                </div>`;
                    }
                },
                {
                    "targets": 6,   //icon
                    "render": function (data,type,row){
                        return `<i style="font-size:18px;" class="` + row.icon + `"></i> ` + row.icon;
                    }
                },
                {
                    "targets": 7,   //导航模式
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
            html += '<a href="permissions/create/'+data.id+'" class="btn btn-success btn-xs tables-console tables-add"><span class="glyphicon glyphicon-plus"></span>添加</a>';
            html += '<a href="permissions/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="permissions/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
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
                    },
                    error:function (err) {
                        swal(err.status + ' ' + err.statusText,'','error');
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
                    },
                    error:function (err) {
                        swal(err.status + ' ' + err.statusText,'','error');
                    }
                });
            });
        }
    </script>
@endpush