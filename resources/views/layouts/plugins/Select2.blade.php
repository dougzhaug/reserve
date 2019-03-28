@push('link')
    <!-- Select2 CSS -->
    <link href="{{asset('static/admin/plugins/bower_components/custom-select/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

    @php $selected = $selected ?? 0; @endphp

    <select name="{{$name or 'select'}}"
            id = "{{$name or 'select'}}"
            class="form-control select2 select2-multiple"
            @if(isset($disabled) && $disabled) disabled @endif
            @if(isset($required) && $required) required @endif
            @if(isset($multiple) && $multiple) multiple @endif
    >
        {{--判断是否分组--}}
        @if(is_assoc($options))
            @foreach($options as $group_key=>$option)
                @if(is_array($option))
                    <optgroup label="{{$group_key or ''}}">
                        @foreach($option as $key=>$val)
                            @php $value = $val['value'] ?? $val; @endphp
                            <option value="{{$value}}" @if($value == $selected || (is_array($selected) && in_array($value,$selected)) || (isset($val['selected']) && $val['selected'])) selected @endif >{{$val['name'] or $key}}</option>
                        @endforeach
                    </optgroup>
                @else
                    @php $value = $option['value'] ?? $option; @endphp
                    <option value="{{$value}}" @if($value == $selected || (is_array($selected) && in_array($value,$selected)) || (isset($option['selected']) && $option['selected'])) selected @endif >{{$option['name'] or $group_key}}</option>
                @endif
            @endforeach
        @else
            @foreach($options as $key=>$val)
                @php $value = $val['value'] ?? $val; @endphp
                <option value="{{$value}}" @if($value == $selected || (is_array($selected) && in_array($value,$selected)) || (isset($val['selected']) && $val['selected'])) selected @endif >{{$val['name'] or $key}}</option>
            @endforeach
        @endif
    </select>

@push('script')
    <script src="{{asset('static/admin/plugins/bower_components/custom-select/dist/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            $(".select2").select2();
        })
    </script>
@endpush


{{--  使用说明

    必传参数

    name = 'select_name'                            //select下拉框name     [String]
    options = []                                    //select下拉选项信息支持以下形式    [Array]
        ['足球'=>1,'篮球'=>2,'乒乓球'=>3]
        [['name'=>'足球','value'=>1],['name'=>'篮球','value'=>2,'selected'=>true],['name'=>'乒乓球','value'=>3]]
        ['爱好'=>['足球'=>1,'篮球'=>2,'乒乓球'=>3],'特长'=>['头发特长'=>4,'指甲特长'=>5]]
        ['爱好'=>[['name'=>'足球','value'=>1,'selected'=>true],['name'=>'篮球','value'=>2],['name'=>'乒乓球','value'=>3]],'特长'=>[['name'=>'头发特长','value'=>4],['name'=>'指甲特长','value'=>5]]]


    选传参数
    selected = '2'/[2,5]                            //选中状态  [String,Array]
    disabled = false                                //禁用    false不禁用(默认)  true禁用
    required = false                                //必须选   false不必须(默认)  true必须
    multiple = false                                //多选    false单选(默认)    true多选

--}}