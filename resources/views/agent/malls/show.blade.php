@extends($layout)

@section('content')
    <div class="">
        <h2 class="m-b-0 m-t-0">{{$goods['name']}}</h2> <small class="text-muted db">作者:{{$goods['author']}}</small>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="white-box text-center"> <img src="{{img_path().$goods['images'][2]}}" class="img-responsive" /> </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-6">
                <h4 class="box-title m-t-40">简介</h4>
                <p>{{$goods['summary']}}</p>
                <h2 class="m-t-40">￥{{$goods['price']}} <small class="text-success">(36% off)</small></h2>
                <button class="btn btn-inverse btn-rounded m-r-6" data-toggle="tooltip" title="添加到购物车"><i class="ti-shopping-cart"></i> </button>
                <button class="btn btn-danger btn-rounded"> 直接购买 </button>
                <h3 class="box-title m-t-40">标签</h3>
                <ul class="list-icons">
                    <li><i class="fa fa-check text-success"></i> Sturdy structure</li>
                    <li><i class="fa fa-check text-success"></i> Designed to foster easy portability</li>
                    <li><i class="fa fa-check text-success"></i> Perfect furniture to flaunt your wonderful collectibles</li>
                </ul>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="box-title m-t-40">章节</h3>
                <div class="table-responsive">
                    <table id="data-tables" class="table" data-url="{{url('chapters/index/'.$goods['id'])}}">
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
                        @include('layouts.plugins.DataTables',['paging'=>false])

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
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();
    </script>
@endpush