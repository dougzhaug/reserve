
@foreach($radio as $key=>$val)
    @php $value = $val['value'] ?? $key @endphp
    <div class="radio
        @if(isset($style) && $style) radio-{{$style}} @endif"
    >

        <input name="{{$name or 'radio'}}"
               id="radio{{$value}}"
               type="radio"
               value="{{$value}}"
               @if(
                    (isset($val['checked']) && $val['checked']) ||
                    (isset($checked) && $value == $checked )
               ) checked @endif
               @if(
                    (isset($val['disabled']) && $val['disabled']) ||
                    (isset($disabled) && ($disabled === true || $value == $disabled || (is_array($disabled) && in_array($value,$disabled))))
               ) disabled @endif
        >
        <label for="radio{{$value}}"> {{$val['name'] or $val}} </label>
    </div>
@endforeach


{{--  使用说明

    必传参数
    name = 'radio'                                  //radio复选框name     [String]
    radio = []                                      //radio复选框选项信息 支持以下形式    [Array]
        ['1'=>'篮球','2'=>'足球','4'=>'羽毛球']
        [
            ['name'=>'玻璃球','value'=>3],
            ['name'=>'足球','value'=>5],
            ['name'=>'乒乓球','value'=>3],
            ['name'=>'篮球','value'=>1,'checked'=>1,'disabled'=>1]
        ]

    选传参数
    style = default                                 //颜色样式
    circle = false                                  //按钮形状 false方形(默认) true圆形
    checked = false                                 //选中状态 false无选中项(默认) '5'选中项    [Bool,String]
    disabled = false                                //是否可用 false不禁用(默认) true全部禁用  '5'部分禁用  [1,3]部分禁用    [Bool,String,Array]

--}}