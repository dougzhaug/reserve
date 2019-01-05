
@if(isset($level) && $level)
    <div class="checkbox-list">
@endif

@foreach($checkbox as $key=>$val)
    @php $value = $val['value'] ?? $key @endphp

    @if(isset($level) && $level)
        <label class="checkbox-inline p-0">
    @endif

    <div class="checkbox
        @if(isset($circle) && $circle) checkbox-circle @endif
        @if(isset($style) && $style) checkbox-{{$style}} @endif"
    >

        <input name="{{$name or 'checkbox'}}[]"
               id="checkbox{{$value}}"
               type="checkbox"
               value="{{$value}}"
               @if(
                    (isset($val['checked']) && $val['checked']) ||
                    (isset($checked) && ($checked === true || $value == $checked || (is_array($checked) && in_array($value,$checked))))
               ) checked @endif
               @if(
                    (isset($val['disabled']) && $val['disabled']) ||
                    (isset($disabled) && ($disabled === true || $value == $disabled || (is_array($disabled) && in_array($value,$disabled))))
               ) disabled @endif
        >
        <label for="checkbox{{$value}}"> {{$val['name'] or $val}} </label>
    </div>

    @if(isset($level) && $level)
        </label>
    @endif
@endforeach

@if(isset($level) && $level)
    </div>
@endif

{{--  使用说明

    必传参数
    name = 'checkbox'                               //checkbox复选框name     [String]
    checkbox = []                                   //checkbox复选框选项信息 支持以下形式    [Array]
        ['1'=>'篮球','2'=>'足球','4'=>'羽毛球']
        [
            ['name'=>'玻璃球','value'=>3],
            ['name'=>'足球','value'=>5,'checked'=>1],
            ['name'=>'乒乓球','value'=>3,'disabled'=>1],
            ['name'=>'篮球','value'=>1,'checked'=>1,'disabled'=>1]
        ]

    选传参数
    level = false                                   //排列方式 false垂直排列(默认) true水平排列
    style = default                                 //颜色样式 default | info | primary | success | warning | danger | purple | inverse
    circle = false                                  //按钮形状 false方形(默认) true圆形
    checked = false                                 //选中状态 false都不选中(默认) true全部选中 '5'部分选中  [1,3]部分选中    [Bool,String,Array]
    disabled = false                                //是否可用 false不禁用(默认) true全部禁用  '5'部分禁用  [1,3]部分禁用    [Bool,String,Array]

--}}