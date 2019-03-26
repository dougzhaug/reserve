@extends($layout)

@push('link')
<!-- xeditable css -->
<link href="{{asset('static/admin/plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet" />
@endpush

@section('content')
    <h3 class="box-title m-b-0">添加预约</h3>
    <p class="text-muted m-b-30 font-13"> Use Bootstrap's predefined grid classes for horizontal form </p>
    <form class="form-horizontal" action="{{url('reserves')}}" method="post">
        {{ csrf_field() }}

        <input type="hidden" id="type" name="type" value="2">

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="inputName" class="col-sm-2 control-label">名称*</label>
            <div class="col-sm-9">
                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="inputName" placeholder="名称">
                @if ($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('min_ahead_days') ? ' has-error' : '' }}">
            <label for="inputMin" class="col-sm-2 control-label">起始天数*</label>
            <div class="col-sm-9">
                <input name="min_ahead_days" type="text" value="{{ old('min_ahead_days') }}" class="form-control" id="inputMin" placeholder="可预约的起始天数">
                @if ($errors->has('min_ahead_days'))
                    <span class="help-block">{{$errors->first('min_ahead_days')}}</span>
                @endif
            </div>
        </div>

        <div class="form-group {{ $errors->has('max_ahead_days') ? ' has-error' : '' }}">
            <label for="inputMax" class="col-sm-2 control-label">结束天数*</label>
            <div class="col-sm-9">
                <input name="max_ahead_days" type="text" value="{{ old('max_ahead_days') }}" class="form-control" id="inputMax" placeholder="可预约的结束天数">
                @if ($errors->has('max_ahead_days'))
                    <span class="help-block">{{$errors->first('max_ahead_days')}}</span>
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

        <div class="form-group">
            <label class="col-sm-2 control-label">配置信息</label>
            <div class="col-sm-9">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class=""><a href="#type-only" onclick="switchType(1)" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-credit-card"></i></span> 唯一模式</a></li>
                    <li role="presentation" class="active"><a href="#type-time-interval" onclick="switchType(2)" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-cc-paypal text-info"></i></span> 时间间隔模式</a></li>
                    <li role="presentation" class=""><a href="#type-queuing" onclick="switchType(3)" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-cc-paypal text-info"></i></span> 排号机制模式</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane" id="type-only">
                        <div class="col-md-7 col-sm-5">
                            <div class="form-group">
                                <label for="inputCharge" class="col-sm-2 control-label">模式</label>
                                <div class="col-sm-9">

                                    {{-- Radio 单选框插件 --}}
                                    @include('layouts.plugins.Radio',['name'=>'only[status]','style'=>'info','level'=>1,'radio'=>[['name'=>'开启','value'=>1,'checked'=>true],['name'=>'关闭','value'=>0]]])
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 pull-right">
                            <h3 class="box-title m-t-10">General Info</h3>
                            <h2><i class="fa fa-cc-visa text-info"></i> <i class="fa fa-cc-mastercard text-danger"></i> <i class="fa fa-cc-discover text-success"></i> <i class="fa fa-cc-amex text-warning"></i></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane active" id="type-time-interval">
                        <div class="col-md-7 col-sm-5">
                            <table style="clear: both" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="35%">开始时间</th>
                                        <th width="35%">结束时间</th>
                                        <th width="30%"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr class="interval-item">
                                        <td>
                                            <a href="javascript:void(0);" class="editable editable-click editable-empty times" data-type="combodate" data-value="08:00" data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm" data-title="Setup event date and time" data-original-title="" title="">08:00</a>
                                            <input name="interval[start_time][]" type="hidden" value="08:00">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="editable editable-click editable-empty times" data-type="combodate" data-value="08:00" data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm" data-title="Setup event date and time" data-original-title="" title="">08:00</a>
                                            <input name="interval[end_time][]" type="hidden" value="08:00">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs interval-add"><span class="glyphicon glyphicon-plus"></span>添加</button>
                                            {{--<button type="button" class="btn btn-danger btn-xs interval-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>--}}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-5 pull-right">
                            <h3 class="box-title m-t-10">General Info</h3>
                            <h2><i class="fa fa-cc-visa text-info"></i> <i class="fa fa-cc-mastercard text-danger"></i> <i class="fa fa-cc-discover text-success"></i> <i class="fa fa-cc-amex text-warning"></i></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="type-queuing">
                        <div class="col-md-7 col-sm-5">
                            <div class="form-group ">
                                <label for="inputNumber" class="col-sm-2 control-label">可预约数</label>
                                <div class="col-sm-9">
                                    <input name="queuing[number]" type="text" class="form-control" id="inputNumber" placeholder="可预约数量">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 col-sm-5 pull-right">
                            <h3 class="box-title m-t-10">General Info</h3>
                            <h2><i class="fa fa-cc-visa text-info"></i> <i class="fa fa-cc-mastercard text-danger"></i> <i class="fa fa-cc-discover text-success"></i> <i class="fa fa-cc-amex text-warning"></i></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
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
<!-- jQuery x-editable -->
<script src="{{asset('static/admin/plugins/bower_components/moment/moment.js')}}"></script>
<script type="text/javascript" src="{{asset('static/admin/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>
<!--jQuery Cookie-->
<script src="{{asset('static/admin/plugins/bower_components/jquery-cookie/dist/jquery.cookie.js')}}"></script>

<script type="text/javascript">
    $(function () {
        $.cookie('time-interval','08:00');
        //初始化x-editable
        XeditableInit();
    })

    //添加时间段
    $(document).on('click','.interval-add',function () {
        var tr = $(this).parent().parent();

        var nowTime = $.cookie('time-interval');

        var html = `
            <tr class="interval-item">
                <td>
                    <a href="javascript:void(0);" class="editable editable-click editable-empty times" data-type="combodate" data-value="` + nowTime + `" data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm" data-title="Setup event date and time" data-original-title="" title="">` + nowTime + `</a>
                    <input name="interval[start_time][]" type="hidden" value="` + nowTime + `">
                </td>
                <td>
                    <a href="javascript:void(0);" class="editable editable-click editable-empty times" data-type="combodate" data-value="` + nowTime + `" data-template="HH:mm" data-format="HH:mm" data-viewformat="HH:mm" data-title="Setup event date and time" data-original-title="" title="">` + nowTime + `</a>
                    <input name="interval[end_time][]" type="hidden" value="` + nowTime + `">
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-xs interval-add"><span class="glyphicon glyphicon-plus"></span>添加</button>
                    <button type="button" class="btn btn-danger btn-xs interval-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>
                </td>
            </tr>
        `;


        tr.after(html);
        
        //重新加载x-editable
        XeditableInit();
    })

    //删除时间段
    $(document).on('click','.interval-delete',function () {
        if(confirm(('确定要删除吗？'))){
            $(this).parent().parent().remove();
        }
    })
    
    function XeditableInit() {
        $('.times').editable({
            mode: 'inline',
            success: function () {
                var timeValue = $(this).next().find('input').val();
                $(this).next().next().val(timeValue);
                console.log(timeValue);
                $.cookie('time-interval',timeValue);
                console.log($.cookie('time-interval'));;
            }
        });
    }

    //切换类型
    function switchType(n) {
        $('#type').val(n);
    }
</script>
<!--Style Switcher -->
<script src="{{asset('static/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush