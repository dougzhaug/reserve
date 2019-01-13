<div class="input-group-btn ">
    {{-- 当只有一个查询类型时，不显示下拉箭头 --}}
    @if(count($dropdowns) > 1)
        <button type="button" class="btn waves-effect waves-light btn-info dropdown-toggle" data-toggle="dropdown">
            @if(is_array($drop_reset = reset($dropdowns)))
                @if(is_array($reset = reset($drop_reset)))
                    {{reset($reset)}}
                @else
                    {{reset($drop_reset)}}
                @endif
            @else
                {{reset($dropdowns)}}
            @endif
        <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
            @if(isset($group) && $group)
                @foreach($dropdowns as $key=>$dropdown)
                    @foreach($dropdown as $key=>$val)
                        <li data-field="{{$val['value'] or $key}}"><a href="javascript:void(0);">{{$val['name'] or $val}}</a></li>
                    @endforeach
                    <li class="divider"></li>
                @endforeach
            @else
                @foreach($dropdowns as $key=>$val)
                    <li data-field="{{$val['value'] or $key}}"><a href="javascript:void(0);">{{$val['name'] or $val}}</a></li>
                @endforeach
            @endif
        </ul>
    @else
        <button type="button" class="btn waves-effect waves-light btn-info dropdown-toggle" data-toggle="dropdown">
            @if(is_array($dropdowns))
                @if(is_array($drop_reset = reset($dropdowns)))
                    @if(is_array($reset = reset($drop_reset)))
                        {{reset($reset)}}
                    @else
                        {{reset($drop_reset)}}
                    @endif
                @else
                    {{reset($dropdowns)}}
                @endif
            @else
                {{$dropdowns}}
            @endif
        </button>
    @endif
</div>
<input name="{{$name or 'keyword'}}" type="text" id="{{$name or 'keyword'}}" class="form-control" placeholder="{{$placeholder or ''}}">
<input name="{{$current_field or 'current_field'}}" type="hidden" id="{{$current_field or 'current_field'}}"
       value="
            @if(is_array($dropdowns))
                @if(is_assoc($dropdowns))
                    {{key($dropdowns)}}
                @else
                   @if(is_array($reset = reset($drop_reset)))
                        @if(is_assoc($reset)) {{key(reset($drop_reset))}} @else {{key($reset)}} @endif
                   @else
                        @if(isset($group) && $group) {{key($drop_reset)}} @else {{$drop_reset['value'] or 'keyword'}} @endif
                   @endif
                @endif
            @else
                {{$name or 'keyword'}}
            @endif"
>

@push('script')
    <script>
        /**
         * 多功能搜索框，点击事件
         */
        $('.dropdown-menu li').on('click',function () {
            $(this).parent().prev().html($(this).text()+' <span class="caret"></span>');
            $('#{{$current_field or 'current_field'}}').val($(this).data('field'));
        })
    </script>
@endpush

{{--  使用说明

    必传参数
    dropdowns = ''/[]                            //下拉选项,支持以下形式    [String,Array]
        /*** 非分组类型 需要配合 group=false(默认) 参数使用 ***/
        '名称'
        ['name'=>'名称','phone'=>'联系电话','group_name'=>'组名称']
        [['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone'],['name'=>'组名称','value'=>'group_name']]

        /*** 分组类型 需要配合 group=true 参数使用 ***/
        [['name'=>'名称','phone'=>'联系电话'],['group_name'=>'组名称']]
        [[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']],[['name'=>'组名称','value'=>'group_name']]]        /*** 注：该类型当只有一个数组时，会按照单项处理***/


    选传参数
    name = 'keyword'                             //input框name(默认为keyword)     [String]
    current_field = 'current_field'              //下拉选中的标识       [String]
    placeholder = ''                             //input框placeholder         [String]
    group = false                                //下拉分组 flase不分组(默认)         true分组

--}}