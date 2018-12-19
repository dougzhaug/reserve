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
    <link href="{{asset('static/admin/theme/min/css/colors/default.css')}}" id="theme" rel="stylesheet">
@endsection

@section('body')
    <body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="step-register">
        <div class="register-box">
            <div class="">
                <a href="javascript:void(0)" class="text-center db m-b-40"><img src="{{asset('static/admin/plugins/images/admin-logo-dark.png')}}" alt="Home" /><br/><img src="{{asset('static/admin/plugins/images/admin-text-dark.png')}}" alt="Register" /></a>
                <!-- multistep form -->
                <div id="msform">
                    <!-- progressbar -->
                    <ul id="eliteregister">
                        <li class="active">管理员帐号登录</li>
                        <li class="active">公众号授权登录</li>
                        <li class="@if (in_array(request()->input("register_step"),[3])) active @endif">接入成功</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset id="one">
                    </fieldset>
                    <fieldset id="two">
                        <h2 class="fs-title">点击按钮进入微信公众平台官方授权</h2>
                        <h3 class="fs-subtitle">Your presence on the social network</h3>
                        <a class="btn btn-outline btn-success waves-effect waves-light btn-lg" style="width: 60%;margin-bottom: 15px;"><i class="fa fa-weixin m-r-5"></i> <span>微信公众号授权登录</span> </a>
                        <p>授权之前，请确认</p>
                        <p>1）您有一个正常使用的微信公众号</p>
                        <p>2）已开启公众号安全助手(<a>如何开启？</a>)</p>
                    </fieldset>
                    <fieldset id="three">
                        <h2 class="fs-title">Personal Details</h2>
                        <h3 class="fs-subtitle">We will never sell it</h3>
                        <input type="text" name="fname" placeholder="First Name" />
                        <input type="text" name="lname" placeholder="Last Name" />
                        <input type="text" name="phone" placeholder="Phone" />
                        <textarea name="address" placeholder="Address"></textarea>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="submit" name="submit" class="submit action-button" value="Submit" />
                    </fieldset>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="{{asset('static/admin/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('static/admin/theme/min/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{asset('static/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
    <script src="{{asset('static/admin/plugins/bower_components/register-steps/jquery.easing.min.js')}}"></script>
    <script src="{{asset('static/admin/plugins/bower_components/register-steps/register-init.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('static/admin/theme/min/js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('static/admin/theme/min/js/custom.min.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{asset('static/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <script>
        var animating;
        $(function () {
            /******初始显示元素******/
            var step = "{{request()->input('register_step')}}";

            var fs = '#two';
            if(step == 3){
                fs = '#three';
            }

            if(fs){
                //隐藏one
                $('#one').hide();
                //显示判断得来的步骤
                $(fs).show();
            }
            /******初始显示元素（完）******/

            //重置next点击事件
            $(".next").click(function(){
                current_fs = $(this).parent();

                buttonType = current_fs.attr('id');

                if(buttonType = 'one'){     //绑定手机号

                }

                if(animating) return false;
                animating = true;

                next_fs = $(this).parent().next();

                //activate next step on progressbar using the index of next_fs
                $("#eliteregister li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        //as the opacity of current_fs reduces to 0 - stored in "now"
                        //1. scale current_fs down to 80%
                        scale = 1 - (1 - now) * 0.2;
                        //2. bring next_fs from the right(50%)
                        left = (now * 50)+"%";
                        //3. increase opacity of next_fs to 1 as it moves in
                        opacity = 1 - now;
                        current_fs.css({'transform': 'scale('+scale+')'});
                        next_fs.css({'left': left, 'opacity': opacity});
                    },
                    duration: 800,
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    },
                    //this comes from the custom easing plugin
                    easing: 'easeInOutBack'
                });
            });
        })
    </script>

    </body>
@endsection