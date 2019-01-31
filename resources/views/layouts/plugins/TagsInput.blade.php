@push('link')
    <!-- TagsInput css -->
    <link href="{{asset('static/admin/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
@endpush

<input type="text" name="{{$name}}" value="{{$value or ''}}" class="form-control" data-role="tagsinput" placeholder="{{$placeholder or ''}}" />

@push('script')
    <!-- TagsInput JavaScript -->
    <script src="{{asset('static/admin/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
@endpush