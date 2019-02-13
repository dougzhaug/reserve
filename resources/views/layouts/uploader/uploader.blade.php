<div id="uploader_{{str_random()}}" class="uploader-list" data-options="{{$uploader_options}}" data-name="{{$name}}" data-max="{{$max}}" data-accept="{{$accept}}">
    @if(isset($src))
        @if(is_array($src))
            @foreach($src as $key=>$val)
                <div id="WU_FILE_{{$key+$max}}" class="img-item">
                    <div class="delete"></div>
                    @if(file_format($val) == 'image')
                        <img class="img" src="{{img_path().$val}}" alt="">
                    @else
                        <p style="text-transform:uppercase">{{file_format($val)}}</p>
                    @endif
                    <div class="wrapper" style="display: none;">100%</div>
                    <input type="hidden" name="{{$name}}[]" value="{{$val}}">
                </div>
            @endforeach
        @else

        @endif
    @endif
    <div class="img-item picker"></div>
    <div class="cf"></div>
</div>