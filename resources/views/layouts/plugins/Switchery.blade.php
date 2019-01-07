@push('link')
    <!-- Switchery CSS -->
    <link href="{{asset('static/admin/plugins/bower_components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
@endpush

<input type="checkbox"
       class="js-switch"
       name="{{$name or 'switch'}}"
       @if((isset($checked) && $checked) || old($name) == 'on') checked @endif
       @if(isset($disabled) && $disabled) disabled @endif
       data-color="{{$color or '#13dafe'}}"
       data-secondary-color="{{$secondary_color or ''}}"
       data-size="{{$size or ''}}" />

@push('script')
    <script src="{{asset('static/admin/plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
    <script>
        $(function () {
            // Switchery
            // var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        })
    </script>
@endpush

{{--  使用说明

    必传参数
    name = 'switch'                                 //switch开关name     [String]

    选传参数
    checked = false                                 //选中状态 false关闭(默认) true开启
    disabled = false                                //是否可用 false可用(默认) true不可用
    color = '#13dafe'                               //开启状态的颜色
    secondary_color = ''                            //关闭状态的颜色
    size = ''                                       //开关大小  small小号  ''中号(默认)  large大号

--}}