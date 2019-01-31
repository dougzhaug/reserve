@push('link')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('static/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@if(isset($style) && $style == 'btn')
    <button type="button" class="btn btn-default pull-{{$opens or 'left'}} date-range-btn" style="padding:8px 12px;">
        <span name="{{$name or 'date_range'}}">
          <i class="fa fa-calendar"></i> {{$placeholder or '时间范围'}}
        </span>
        <i class="fa fa-caret-down"></i>
    </button>
@else
    <input type="text" name="{{$name or 'date_range'}}" value="{{$value or ''}}" class="form-control pull-right date-range-{{$style or 'reservation'}}" placeholder="{{$placeholder or ''}}">
@endif

@push('script')
    <!-- date-range-picker -->
    <script src="{{asset('static/admin/plugins/bower_components/moment/moment.js')}}"></script>
    <script src="{{asset('static/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $(function () {
            var start_date = "{{$start_date or false}}";                                    //可选择的开始时间
            var end_date = "{{$end_date or false}}";                                        //可选择的结束时间
            var max_date = "{{$max_date or false}}";                                        //

            //Date picker(1)
            $('.date-range-single').daterangepicker({
                opens:"{{$opens or 'right'}}",
                autoApply: true,
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                timePicker24Hour : true,
                timePicker : true,
                timePickerIncrement: {{$time_picker_increment or config('daterangepicker.time_increment')}},//选择分钟的间隔
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",              //时间格式
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                }
            },function(start, end, label) {
                beginTimeTake = start;
                if(!this.startDate){
                    this.element.val('');
                }else{
                    this.element.val(this.startDate.format(this.locale.format));
                }
            })

            //Date range picker(2)
            $('.date-range-reservation').daterangepicker({
                opens:"{{$opens or 'right'}}",
                autoApply: true,                                                            //自动确定
                startDate: start_date ? start_date : moment().startOf('day'),               //默认开始时间
                endDate: end_date ? end_date : moment(),                                    //默认结束时间
                minDate: {{$min_date or 'false'}},                                          //最小时间
                maxDate: max_date ? max_date : moment(),                                    //最大时间
                dateLimit: {
                    days: {{$date_limit or config('daterangepicker.date_limit')}},          //起止时间的最大间隔
                },
                timePicker: {{$time_picker or 'false'}},                                    //是否小时分钟可选
                timePickerIncrement: {{$time_picker_increment or config('daterangepicker.time_increment')}},//选择分钟的间隔
                timePicker12Hour: true,                                                     //开启24小时格式
                showDropdowns: {{$show_dropdowns or 'false'}},                              //年份和月份是否可选
                // applyClass : 'btn-small btn-primary blue',                               //样式
                // cancelClass : 'btn-small',
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",              //时间格式
                    separator: "{{$separator or config('daterangepicker.separator')}}",     //分隔符
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],

                },

            })

            //Date range picker with time picker(3)
            $('.date-range-reservation-time').daterangepicker({
                opens:"{{$opens or 'right'}}",
                autoApply: true,                                                            //自动确定
                timePicker: true,
                dateLimit: {
                    days: {{$date_limit or config('daterangepicker.date_limit')}},          //起止时间的最大间隔
                },
                timePickerIncrement: {{$time_picker_increment or config('daterangepicker.time_increment')}},//选择分钟的间隔
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",              //时间格式
                    separator: "{{$separator or config('daterangepicker.separator')}}",     //分隔符
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                },
            })

            //Date range as a button(4)
            $('.date-range-btn').daterangepicker({
                    opens:"{{$opens or 'right'}}",
                    autoApply: true,                                                        //自动确定
                    startDate: start_date ? start_date : moment().subtract(29, 'days'),     //默认开始时间
                    endDate: end_date ? end_date : moment(),                                //默认结束时间
                    minDate: {{$min_date or 'false'}},                                      //最小时间
                    maxDate: max_date ? max_date : moment(),                                //最大时间

                    timePicker12Hour: true,
                    timePickerIncrement: {{$time_picker_increment or config('daterangepicker.time_increment')}},//选择分钟的间隔
                    timePicker: {{$time_picker or 'false'}},
                    showDropdowns : {{$show_dropdowns or 'false'}},                         //年份和月份是否可选
                    locale: {
                        format: "{{$format or config('daterangepicker.format')}}",          //时间格式
                        separator: "{{$separator or config('daterangepicker.separator')}}", //分隔符
                        applyLabel: "应用",
                        cancelLabel: "取消",
                        resetLabel: "重置",
                        customRangeLabel:"自定义范围",
                        daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                        monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                            '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                        firstDay : 1
                    },
                    ranges   : {
                        '今天'       : [moment(), moment()],
                        '昨天'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '最近7天' : [moment().subtract(6, 'days'), moment()],
                        '最近30天': [moment().subtract(29, 'days'), moment()],
                        '本月'  : [moment().startOf('month'), moment().endOf('month')],
                        '上个月'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                },
                function (start, end) {
                    $('.date-range-btn span').html(start.format("{{$format or config('daterangepicker.format')}}") + "{{$separator or config('daterangepicker.separator')}}" + end.format("{{$format or config('daterangepicker.format')}}")+'<input type="hidden" name="date_range" value="'+start.format("{{$format or config('daterangepicker.format')}}") + "{{$separator or config('daterangepicker.separator')}}" + end.format("{{$format or config('daterangepicker.format')}}")+'">')
                }
            )
        })
    </script>
@endpush


{{--  使用说明

    必传参数
    name = 'date_range'                             //daterangepicker时间选择器name     [String]

    选传参数
    value = ''                                      //时间框内默认值
    style = 'reservation'                           //时间选择器样式 single | reservation | reservation-time | btn
    opens = 'right'                                 //时间插件弹出位置 right | center | left
    placeholder = ''                                //input框 placeholder 属性
    start_date = ''                                 //默认开始时间
    end_date = ''                                   //默认结束时间
    max_date = ''                                   //可使用最晚时间 默认当天
    min_date = ''                                   //可使用最早时间 默认 1970-01-01 08:00:00
    date_limit = 36000                              //时间区间最大天数 默认不限制
    format = 'YYYY-MM-DD HH:mm:ss'                  //时间格式
    separator = '~'                                 //分隔符 (时间区间) [部分]
    show_dropdowns = false                          //年 月 是否可选  false不可选(默认) true可选 [部分]
    time_picker_increment = 10                      //分钟间隔 [部分]

--}}