@extends($layout)

@section('content')
    <h3 class="box-title m-b-0">添加会员卡</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('user_vip_cards')}}" method="post">
        {{ csrf_field() }}

        <input type="hidden" name="user_id" value="{{request()->user_id}}">

        @if(request()->role == 110)
            <div class="form-group {{ $errors->has('shop') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">所属商店</label>
                <div class="col-sm-9">

                    {{-- Select2 下拉插件 --}}
                    @include('layouts.plugins.Select2',['name'=>'shop','options'=>$shops])

                    @if ($errors->has('shop'))
                        <span class="help-block">{{$errors->first('shop')}}</span>
                    @endif
                </div>
            </div>
        @endif

        <div class="form-group {{ $errors->has('vip_card') ? ' has-error' : '' }}">
            <label class="col-sm-2 control-label">会员卡</label>
            <div class="col-sm-9">

                {{-- Select2 下拉插件 --}}
                @include('layouts.plugins.Select2',['name'=>'vip_card','options'=>['请选择'=>0]])

                @if ($errors->has('vip_card'))
                    <span class="help-block">{{$errors->first('vip_card')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group" id="vip_detail">
            <label class="col-sm-2 control-label">详情</label>
            <div class="col-sm-9">
                <dl class="dl-horizontal">
                    <dd><img id="vip_bg_image" width="30%" src="" alt=""></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>名称</dt>
                    <dd id="vip_name"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>价格</dt>
                    <dd id="vip_price"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>类型</dt>
                    <dd id="vip_type"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt id="vip_present_title"></dt>
                    <dd id="vip_present"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>通用卡</dt>
                    <dd id="vip_universal"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>有效期</dt>
                    <dd id="vip_valid_date"></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>使用须知</dt>
                    <dd id="vip_direction_for_use"></dd>
                </dl>
            </div>
        </div>

        <div class="form-group {{ $errors->has('balance') ? ' has-error' : '' }}">
            <label for="inputBalance" class="col-sm-2 control-label">余额/余次*</label>
            <div class="col-sm-9">
                <input name="balance" type="text" value="{{ old('balance') }}" class="form-control" id="inputBalance" placeholder="余额或余次">
                @if ($errors->has('balance'))
                    <span class="help-block">{{$errors->first('balance')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">状态</label>
            <div class="col-sm-9">

                {{-- Switchery 开关插件 --}}
                @include('layouts.plugins.Switchery',['name'=>'status','checked'=>1])

            </div>
        </div>

        <div class="form-group m-b-0">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-default waves-effect waves-light m-t-10">取消</button>
                <button type="submit" class="btn btn-info waves-effect waves-left m-t-10">提交</button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script>

        $(function () {
            $('#vip_detail').hide();

            @if(request()->role == 120)
                getVipCardSelect("#vip_card",);
            @endif
            var shop_id = "{{request()->shop_id}}";
            if(shop_id > 0){
                getVipCardSelect("#vip_card",shop_id);
            }
        })

        /**
         * 会员卡联动
         */
        $("#shop").change(function () {

            var shop_id= $('#shop').val();
            if(shop_id == 0){
                return false;
            }

            getVipCardSelect("#vip_card",shop_id);
        });

        /**
         * 获取会员卡信息
         *
         * @param id        //填充的select2 id
         * @param shop_id   //业务数据 （商店id）
         */
        function getVipCardSelect(id,shop_id) {
            $(id).html('<option value=0>加载中......</option>');

            $(id).prop("disabled", true);

            $.ajax({
                url: "{{url('user_vip_cards/create')}}",
                dataType: "JSON",
                data: {'shop_id': shop_id,'_token':'{{csrf_token()}}'},
                type: "post",
                success:function (data) {
                    var gradeNum= data.length;
                    var option = "";
                    if(gradeNum>0){
                        for(var i = 0;i<gradeNum;i++){
                            option += "<option value='"+data[i].value+"'>"+data[i].name+"</option>";
                        }
                    }
                    $(id).html(option).trigger("change");
                    $(id).prop("disabled", false);
                },
                error:function(e) {
                    alert("系统异常，请稍候重试！");
                }
            });
        }

        /**
         * 获取会员卡详情
         */
        $("#vip_card").change(function () {

            var vip_card_id= $(this).val();
            if(vip_card_id == 0){
                return false;
            }

            $.ajax({
                url: "{{url('user_vip_cards/get_vip_card')}}",
                dataType: "JSON",
                data: {'vip_card_id': vip_card_id,'_token':'{{csrf_token()}}'},
                type: "post",
                success:function (data) {
                    console.log(data);
                    $('#vip_bg_image').attr("src",data.bg_image);
                    $('#vip_name').text(data.name);
                    $('#vip_price').text(data.price);
                    $('#vip_type').text(data.type==1?'储值卡':'记次卡');
                    $('#vip_present_title').text(data.type==1?'价值':'次数');
                    $('#vip_present').text(data.type==1 ? parseFloat(parseFloat(data.price)+parseFloat(data.present)).toFixed(2) : Number(data.present));
                    $('#vip_universal').text(data.universal==1 ? '通用卡【'+data.shops.join(' | ')+'】' : '非通用');
                    $('#vip_valid_date').text(data.valid_date==0 ? '永久' : data.valid_date+'天');
                    $('#vip_direction_for_use').text(data.direction_for_use);

                    $('#vip_detail').show();
                },
                error:function(e) {
                    alert("系统异常，请稍候重试！");
                }
            });
        });
    </script>
@endpush