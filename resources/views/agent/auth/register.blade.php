@extends('layouts.app')

@section('head-link')
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('static/admin/theme/min/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('static/admin/theme/min/css/animate.css')}}" rel="stylesheet">
    <!-- Wizard CSS -->
    <link href="{{asset('static/admin/plugins/bower_components/register-steps/steps.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('static/admin/theme/min/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('static/admin/theme/min/css/colors/blue-dark.css')}}" id="theme" rel="stylesheet">
@endsection

@section('body')
    <body>
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di"><img src="{{asset('static/admin/plugins/images/admin-logo.png')}}"></a>
                <div class="lg-content">
                    <h2>THE ULTIMATE & MULTIPURPOSE ADMIN TEMPLATE OF 2017</h2>
                    <p class="text-muted">with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more... </p> <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Buy now</a> </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Sign UP to Admin</h3> <small>Enter your details below</small>
                <form class="form-horizontal new-lg-form" id="loginform" action="{{url('register')}}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input name="phone" id="phone" value="{{old('phone')}}" class="form-control" type="text" required="" placeholder="手机号">
                        </div>
                        @if ($errors->has('phone'))
                            <div class="col-xs-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('phone')}}</strong></p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('phone_captcha') ? ' has-error' : '' }}">
                        <div class="col-xs-7">
                            <input name="phone_captcha" id="phone_captcha" value="{{old('phone_captcha')}}" class="form-control" type="text" required="" placeholder="手机验证码">
                        </div>
                        <div class="col-xs-5">
                            <button id="sendVerifySmsButton" class=" btn btn-info text-uppercase form-control" style="text-align:center"> 获取验证码 </button>
                        </div>
                        @if ($errors->has('phone_captcha'))
                            <div class="col-xs-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('phone_captcha')}}</strong></p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input name="password" id="password" class="form-control" type="password" required="" placeholder="密码">
                        </div>
                        @if ($errors->has('password'))
                            <div class="col-xs-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('password')}}</strong></p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input name="password_confirmation" id="password_confirmation" class="form-control" type="password" required="" placeholder="确认密码"> </div>
                    </div>

                    <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                        <div class="col-xs-7">
                            <input type="text" class="form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="图形验证码">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                        </div>
                        @if($errors->has('captcha'))
                            <div class="col-xs-12">
                                <p class="text-danger text-left"><strong>{{$errors->first('captcha')}}</strong></p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">注 册</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="login.html" class="text-danger m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{asset('static/admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('static/admin/theme/min/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{asset('static/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('static/admin/theme/min/js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/custom.min.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{asset('static/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script src="{{asset('static/admin/plugins/bower_components/laravel-sms/laravel-sms.js')}}"></script>
    <script>
        $('#sendVerifySmsButton').sms({
            //laravel csrf token
            token       : "{{csrf_token()}}",
            //请求间隔时间
            interval    : 60,
            //请求参数
            requestData : {
                //手机号
                mobile : function () {
                    return $('input[name=phone]').val();
                },
                //手机号的检测规则
                mobile_rule : 'mobile_required'
            }
        });
    </script>

    </body>
@endsection