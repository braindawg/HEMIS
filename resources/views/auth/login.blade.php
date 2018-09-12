<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'HEMIS') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        
        <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" />        
        
        <link rel="shortcut icon" href="favicon.ico" /> 
        <style>
            .ltr {
                direction: ltr;
                text-align: left;
            }
        </style>
        </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-4 login-container bs-reset">
                    <img class="login-logo login-6" src="img/hemis-logo.png" />
                    <div class="login-content">
                        
                        <h3>{{ trans('general.hemis') }}</h3>
                        <!-- <p> لطفا ایمیل و پسورد خود را وارد کنید.</p>  -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="login-form" >
                            {{ csrf_field() }}
                            <input type="hidden" name="form" value="login">
                            <div class="row">                            
                                <div class="col-xs-10 col-xs-offset-1">
                                    <input class="form-control form-control-solid placeholder-no-fix ltr" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ایمیل"/>                               
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <input class="form-control form-control-solid placeholder-no-fix ltr" type="password" name="password" required placeholder="پسورد"/> 
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>                                
                            </div>
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>لطفا ایمیل و پسورد خود را وارد کنید. </span>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="rem-password">
                                        <p>مرا به یاد داشته باش
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="width: initial">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-1">
                                    
                                    <button class="btn blue" type="submit">{{ trans('general.login') }}</button>
                                    <div class="forgot-password">
                                        <a href="javascript:;" id="forget-password" class="forget-password">پسورد خود را فراموش کرده اید؟</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
                        
                        <form class="forget-form"  method="post" action="{{ route('password.email') }}?form=forgot">
                            {{ csrf_field() }}                      
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <h3 class="font-green">پسورد خود را فراموش کرده اید؟</h3>
                                    <p>برای تغییر پسورد, ایمیل خود را وارد کنید. </p>
                                    <div class="form-group">
                                        <input class="form-control placeholder-no-fix ltr" type="text" autocomplete="off" placeholder="ایمیل" name="email" value="{{ old('email') }}" required />                                         
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" id="back-btn" class="btn grey btn-default">{{ trans('general.back') }}</button>
                                        <button type="submit" class="btn blue btn-success uppercase pull-right">{{ trans('general.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>                  
                        <!-- END FORGOT PASSWORD FORM -->
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-4 bs-reset">
                                <!-- <ul class="login-social">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="icon-social-dribbble"></i>
                                        </a>
                                    </li>
                                </ul> -->
                            </div>
                            <div class="col-xs-8 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; Ministry of Higher Education {{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 bs-reset">
                    <div class="login-bg"> </div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        
        <script src="{{ asset('js/all.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/login.js') }}" type="text/javascript"></script>
        <script>
        // $(function() {
        //     $('.login-form').hide();
        //     $('.forget-form').show();
        // })
        </script>
        
    </body>

</html>