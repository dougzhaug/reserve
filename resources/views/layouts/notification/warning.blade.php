@if (count($errors->warning) > 0)

    @php
        $errorsAll = $errors->warning->all();
        $expire = array_pop($errorsAll);
    @endphp

    @foreach ($errorsAll as $error)
        <div class="alert alert-warning alert-dismissable" style="margin-bottom:0;font-size: 16px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p style="display:flex;align-items:center;">
                <i class="icon fa fa-warning" style="font-size: 26px;"></i>
                <span style="margin-left: 12px;"><b>{{$error or '警告'}}</b></span>
            </p>
        </div>
    @endforeach
@endif

@push('script')
    <script>
        var msg = $('.alert-warning');
        msg.delay().fadeIn();
        @if(isset($expire) && $expire)    //是否自动关闭
            msg.delay({{$expire}}).fadeOut(800,'swing');
        @endif
    </script>
@endpush