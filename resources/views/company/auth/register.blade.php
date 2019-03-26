@extends('layouts.app')

@section('head-link')
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('static/admin/theme/min/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{asset('static/admin/theme/min/css/animate.css')}}" rel="stylesheet">
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
    <div id="wrapper">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">注册</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <section>
                            <div class="sttabs tabs-style-line">
                                <nav>
                                    <ul>
                                        <li><a href="#section-line-1" style="text-align:center;"><span><i class="fa fa-user" style="font-size: 18px;margin-right: 5px;"></i>基本信息</span></a></li>
                                        <li><a href="#section-line-2" style="text-align:center"><span><i class="fa fa-cubes" style="font-size: 18px;margin-right: 5px;"></i>类型选择</span></a></li>
                                        <li><a href="#section-line-3" style="text-align:center"><span><i class="fa fa-list-alt" style="font-size: 18px;margin-right: 5px;"></i>信息登记</span></a></li>
                                        <li><a href="#section-line-4" style="text-align:center"><span><i class="fa fa-wechat" style="font-size: 18px;margin-right: 5px;"></i>公众号授权</span></a></li>
                                    </ul>
                                </nav>
                                <div class="content-wrap">
                                    <section id="section-line-1">
                                        <div class="panel-wrapper m-t-20" aria-expanded="true">
                                            <div class="panel-body col-xs-6">
                                        <form class="form-horizontal new-lg-form" id="loginform" action="{{url('register')}}" method="POST">
                                            {{ csrf_field() }}

                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <div class="col-xs-8">
                                                    <input name="phone" id="phone" value="{{old('phone')}}" class="form-control" type="text" required="" placeholder="手机号">
                                                </div>
                                                @if ($errors->has('phone'))
                                                    <div class="col-xs-8">
                                                        <p class="text-danger text-left"><strong>{{$errors->first('phone')}}</strong></p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('phone_captcha') ? ' has-error' : '' }}">
                                                <div class="col-xs-5">
                                                    <input name="phone_captcha" id="phone_captcha" value="{{old('phone_captcha')}}" class="form-control" type="text" required="" placeholder="手机验证码">
                                                </div>
                                                <div class="col-xs-3">
                                                    <button id="sendVerifySmsButton" class="btn btn-info btn-block text-uppercase form-control" style="text-align:center;color:#FFF;"> 获取验证码 </button>
                                                </div>
                                                @if ($errors->has('phone_captcha'))
                                                    <div class="col-xs-8">
                                                        <p class="text-danger text-left"><strong>{{$errors->first('phone_captcha')}}</strong></p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-xs-8">
                                                    <input name="password" id="password" class="form-control" type="password" required="" placeholder="密码">
                                                </div>
                                                @if ($errors->has('password'))
                                                    <div class="col-xs-8">
                                                        <p class="text-danger text-left"><strong>{{$errors->first('password')}}</strong></p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-8">
                                                    <input name="password_confirmation" id="password_confirmation" class="form-control" type="password" required="" placeholder="确认密码"> </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
                                                <div class="col-xs-5">
                                                    <input type="text" class="form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="图形验证码">
                                                </div>
                                                <div class="col-xs-3">
                                                    <img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                                                </div>
                                                @if($errors->has('captcha'))
                                                    <div class="col-xs-8">
                                                        <p class="text-danger text-left"><strong>{{$errors->first('captcha')}}</strong></p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <div class="checkbox checkbox-primary p-t-0">
                                                        <input id="checkbox-signup" type="checkbox">
                                                        <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center m-t-20">
                                                <div class="col-xs-4">
                                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">注 册</button>
                                                </div>
                                            </div>
                                        </form>
                                            </div>
                                            <div class="panel-body col-sx-6">
                                                <div class="">
                                                    <p class="">已有平台账号? <a href="{{url('/login')}}">立即登录</a></p>
                                                </div>
                                            </div>
                                        </div>

                                    </section>

                                    <section id="section-line-2">
                                        <div class="row pricing-plan m-t-20">
                                            <div><b>请选择帐号类型，一旦成功建立帐号，类型不可更改</b></div>
                                            <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                                <div class="pricing-box">
                                                    <div class="pricing-body b-l">
                                                        <div class="pricing-header">
                                                            <h4 class="text-center">Silver</h4>
                                                            <h2 class="text-center"><span class="price-sign">$</span>24</h2>
                                                            <p class="uppercase">per month</p>
                                                        </div>
                                                        <div class="price-table-content">
                                                            <div class="price-row"><i class="icon-user"></i> 3 Members</div>
                                                            <div class="price-row"><i class="icon-screen-smartphone"></i> Single Device</div>
                                                            <div class="price-row"><i class="icon-drawar"></i> 50GB Storage</div>
                                                            <div class="price-row"><i class="icon-refresh"></i> Monthly Backups</div>
                                                            <div class="price-row">
                                                                <button class="btn btn-success waves-effect waves-light m-t-20">Sign up</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                                <div class="pricing-box b-l">
                                                    <div class="pricing-body">
                                                        <div class="pricing-header">
                                                            <h4 class="text-center">Gold</h4>
                                                            <h2 class="text-center"><span class="price-sign">$</span>34</h2>
                                                            <p class="uppercase">per month</p>
                                                        </div>
                                                        <div class="price-table-content">
                                                            <div class="price-row"><i class="icon-user"></i> 5 Members</div>
                                                            <div class="price-row"><i class="icon-screen-smartphone"></i> Single Device</div>
                                                            <div class="price-row"><i class="icon-drawar"></i> 80GB Storage</div>
                                                            <div class="price-row"><i class="icon-refresh"></i> Monthly Backups</div>
                                                            <div class="price-row">
                                                                <button class="btn btn-success waves-effect waves-light m-t-20">Sign up</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                                <div class="pricing-box featured-plan">
                                                    <div class="pricing-body">
                                                        <div class="pricing-header">
                                                            <h4 class="price-lable text-white bg-warning"> Popular</h4>
                                                            <h4 class="text-center">Platinum</h4>
                                                            <h2 class="text-center"><span class="price-sign">$</span>45</h2>
                                                            <p class="uppercase">per month</p>
                                                        </div>
                                                        <div class="price-table-content">
                                                            <div class="price-row"><i class="icon-user"></i> 10 Members</div>
                                                            <div class="price-row"><i class="icon-screen-smartphone"></i> Single Device</div>
                                                            <div class="price-row"><i class="icon-drawar"></i> 120GB Storage</div>
                                                            <div class="price-row"><i class="icon-refresh"></i> Monthly Backups</div>
                                                            <div class="price-row">
                                                                <button class="btn btn-lg btn-info waves-effect waves-light m-t-20">Sign up</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                                <div class="pricing-box">
                                                    <div class="pricing-body b-r">
                                                        <div class="pricing-header">
                                                            <h4 class="text-center">Dimond</h4>
                                                            <h2 class="text-center"><span class="price-sign">$</span>54</h2>
                                                            <p class="uppercase">per month</p>
                                                        </div>
                                                        <div class="price-table-content">
                                                            <div class="price-row"><i class="icon-user"></i> 15 Members</div>
                                                            <div class="price-row"><i class="icon-screen-smartphone"></i> Single Device</div>
                                                            <div class="price-row"><i class="icon-drawar"></i> 1TB Storage</div>
                                                            <div class="price-row"><i class="icon-refresh"></i> Monthly Backups</div>
                                                            <div class="price-row">
                                                                <button class="btn btn-success waves-effect waves-light m-t-20">Sign up</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section id="section-line-3">
                                        <h2>Tabbing 3</h2></section>
                                    <section id="section-line-4">
                                        <h2>Tabbing 4</h2></section>

                                </div>
                                <!-- /content -->
                            </div>
                            <!-- /tabs -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{asset('static/admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('static/admin/theme/min/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('static/admin/theme/min/js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/cbpFWTabs.js')}}"></script>
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
    <script type="text/javascript">
        (function() {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });
        })();
    </script>

    </body>
@endsection