@extends('layouts.app')

@section('head-link')
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('static/admin/theme/min/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('static/admin/theme/min/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('static/admin/theme/min/css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('static/admin/theme/min/css/colors/default.css')}}" id="theme" rel="stylesheet">
@endsection

@section('body')
    <body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="new-login-register">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="javascript:void(0)" class="p-20 di"><img src="{{asset('static/admin/plugins/images/admin-logo.png')}}"></a>
                <div class="lg-content">
                    <h2>THE ULTIMATE & MULTIPURPOSE ADMIN TEMPLATE OF 2017</h2>
                    <p class="text-muted">with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more... </p>
                    <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Buy now</a>
                </div>
            </div>
        </div>
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">代理商登录</h3>
                <small></small>
                <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group m-t-20{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            {{--<label>手机号</label>--}}
                            <input class="form-control" id="phone" type="text" name="phone" value="{{ old('email') }}" placeholder="手机号" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            {{--<label>密码</label>--}}
                            <input id="password" type="password" name="password" class="form-control" required placeholder="密码">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-info pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> 记住密码 </label>
                            </div>
                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> 忘记密码?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">登 录</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="{{url('auth/wechat_web')}}" class="btn btn-success" data-toggle="tooltip"  title="微信登录">
                                    <i aria-hidden="true" class="fa fa-weixin"></i>
                                </a>
                                <a href="{{url('auth/qq')}}" class="btn btn-info" data-toggle="tooltip"  title="QQ登录">
                                    <i aria-hidden="true" class="fa fa-qq"></i>
                                </a>
                                <a href="{{url('auth/weibo')}}" class="btn btn-googleplus" data-toggle="tooltip"  title="微博登录">
                                    <i aria-hidden="true" class="fa fa-weibo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>还没有账号？<a href="{{url('register')}}" class="text-primary m-l-5"><b>注册</b></a></p>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
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
    </body>
@endsection
