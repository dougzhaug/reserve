@push('link')
    <!-- Dropzone css -->
    <link href="{{asset('static/admin/plugins/bower_components/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endpush

<form action="#" class="dropzone">
    <div class="fallback">
        <input name="{{$name or 'file'}}" type="file" multiple /> </div>
</form>

@push('script')
    <!-- Dropzone Plugin JavaScript -->
    <script src="{{asset('static/admin/plugins/bower_components/dropzone-master/dist/dropzone.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{asset('static/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
@endpush