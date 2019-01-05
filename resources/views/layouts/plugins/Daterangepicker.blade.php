@push('link')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('static/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@if(isset($style) && $style == 'btn')
    <button type="button" class="btn btn-default pull-right date-range-btn" style="padding:8px 12px;">
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
                autoApply: true,
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                timePicker24Hour : true,
                timePicker : true,
                timePickerIncrement: {{$time_picker_increment or 10}},                      //选择分钟的间隔
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
            autoApply: true,                                                                //自动确定
                startDate: start_date ? start_date : moment().startOf('day'),               //默认开始时间
                endDate: end_date ? end_date : moment(),                                    //默认结束时间
                minDate: {{$min_date or 'false'}},                                          //最小时间
                maxDate: max_date ? max_date : moment(),                                    //最大时间
                dateLimit: {
                    days: {{$date_limit or 31}},                                            //起止时间的最大间隔
                },
                timePicker: {{$time_picker or 'false'}},                                    //是否小时分钟可选
                timePickerIncrement: {{$time_picker_increment or 10}},                      //选择分钟的间隔
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
            autoApply: true,                                                                //自动确定
                timePicker: true,
                timePickerIncrement: {{$time_picker_increment or 10}},                      //选择分钟的间隔
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
            $('.date-range-btn').daterangepicker(
                {
                autoApply: true,                                                            //自动确定
                    startDate: start_date ? start_date : moment().subtract(29, 'days'),     //默认开始时间
                    endDate: end_date ? end_date : moment(),                                //默认结束时间
                    minDate: {{$min_date or 'false'}},                                      //最小时间
                    maxDate: max_date ? max_date : moment(),                                //最大时间

                    timePicker12Hour: true,
                    timePickerIncrement: {{$time_picker_increment or 10}},                  //选择分钟的间隔
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