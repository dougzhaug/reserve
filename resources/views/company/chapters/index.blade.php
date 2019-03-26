@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">#{{$goods['name']}}# 的章节管理</h3>
    <p class="text-muted m-b-30 font-13"> {{$goods['summary']}} </p>

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
                <th data-name="sort" data-sort="true" data-default-sort="desc" style="width: 80px;">排序</th>
                <th data-name="charge">模式</th>
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
                <th>排序</th>
                <th>模式</th>
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
                    "targets": 2,   //排序
                    "render": function (data,type,row){
                        var sort = row.sort ? row.sort : 0;
                        return `<div class="input-group input-group-sm col-sm-12">
                                    <input type="text" class="form-control " value="` + sort + `">
                                    <span class="input-group-btn">
                                    <button type="button" onclick="chapterSort(this)" class="btn btn-info btn-flat" data-old="` + sort + `" data-id="` + row.id + `">Go!</button>
                                    </span>
                                </div>`;
                    }
                },
                {
                    "targets": 3,   //模式
                    className : 'td-center',
                    "render": function (data,type,row){
                        var btn = ''; var msg = '';
                        switch(row.charge){
                            case 0:
                                btn = 'success'; msg = '免费';
                                break;
                            case 1:
                                btn = 'info'; msg = '收费';
                                break;
                        }
                        return `<span class="label label-` + btn + ` font-weight-100">` + msg + `</span>`;
                    }
                }
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
            html += '<a href="/chapters/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="chapters/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }

        /**
         * 修改排序请求
         */
        function chapterSort(that){
            var id = $(that).data('id');
            var old = $(that).data('old');
            var now = $(that).parent().prev('input').val();
            if(old == now){
                return false;
            }

            sweetConfirm('确定要修改吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:"{{url('chapters/sort')}}"+'/'+id,
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
    </script>
@endpush