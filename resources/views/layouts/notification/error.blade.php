@if (count($errors->error) > 0)
    @php
        $errorsAll = $errors->error->all();
        $expire = array_pop($errorsAll);
    @endphp

    @foreach ($errorsAll as $key=>$error)
        <div class="alert alert-danger alert-dismissable" style="margin-bottom:0;font-size: 16px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="display:flex;align-items:center;">
                <i class="icon fa fa-ban" style="font-size: 26px;"></i>
                <span style="margin-left: 12px;"><b>{{$error or '失败'}}</b></span>
            </p>
        </div>
    @endforeach
@endif

@push('script')
    <script>
        var msg = $('.alert-danger');
        msg.delay().fadeIn();
        @if(isset($expire) && $expire)    //是否自动关闭
            msg.delay({{$expire}}).fadeOut(800,'swing');
        @endif
    </script>
@endpush
