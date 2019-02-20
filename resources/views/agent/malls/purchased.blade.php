@extends($layout)

@section('pageTitle')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Starter Page</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="{{url('malls')}}" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">购物车 <i class="ti-shopping-cart" id="shopping-cart" style="font-size: 16px;"></i></a>
            <a href="javascript: void(0);" class="btn btn-success pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">已购买的</a>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Starter Page</li>
            </ol>
        </div>
    </div>
@endsection

@section('row')
    <div class="row">
        <div class="col-xs-12 waiting"  style="text-align:center;height: 30px;" data-page="1" data-loading="true">
            <div class="loading">
                <i class="fa fa-circle-o-notch fa-spin"></i> 加载中......
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var loading = false;  //防止重复加载

        $(function () {
            //初始化获取商品信息
            getGoods();
        })

        //监控下拉事件
        $(window).scroll(function () {
            if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
                var waiting = $('.waiting');
                $('.loading').show();
                if(waiting.data('loading')) {
                    getGoods();
                }
            }
        });

        //获取商品信息
        function getGoods() {
            if(loading){
                return false;
            }

            loading = true;

            var waiting = $('.waiting');
            var page = waiting.data('page');

            $.ajax({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                url: '/malls/purchased',
                data: {'page':page},
                type: 'POST',
                async:false,
                success:function (result) {
                    if(!result.errorCode) {
                        if (result.data.length > 0) {
                            paddingData(result.data);
                            waiting.data('page', result.page);
                        } else {
                            waiting.data('loading', false);
                            $('.loading').html('亲，到底儿了');
                        }
                    }else{
                        swal(result.message,'','error');
                    }
                    loading = false;
                },
                error:function (err) {
                    loading = false;
                    swal(err.status + ' ' + err.statusText,'','error');
                }
            })
        }

        //填充数据
        function paddingData(data) {
            var html='';
            $.each(data,function (k,v) {
                html += `
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="white-box">
                            <div class="product-img">
                                <img src="{{img_path()}}` + v.images[0] + `" height="200" />
                                <div class="pro-img-overlay">
                                    <a href="/malls/`+ v.id +`" class="bg-danger"><i class="ti-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-text">
                                <span class="pro-price bg-danger">`+ v.price +`</span>
                                <h3 class="box-title m-b-0">` +v.name+ `</h3>
                                <small class="text-muted db" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">` + v.summary + `</small>
                            </div>
                        </div>
                    </div>
                `;
            })

            $('.waiting').before(html);
        }
    </script>
@endpush