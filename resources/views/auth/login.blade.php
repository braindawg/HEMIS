<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HEMIS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('css/main.css') }}">

</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="logo">
                    <img src="{{ URL::asset('img/hemis.png') }}" alt="logo" width="360">
                </div>
                <div class="bnaz-font dark-color dari-slogan">
                    سیستم مدیریت اطلاعات وزارت تحصیلات عالی
                </div>
            </div>

            <div class="col-md-6 col-sm-6 left-border">
               
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder = "ایمیل"> 
                        @if ($errors->has('password'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder = "پسورد">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif

                        <input type="submit" class="form-control btn btn-success" value="LOGIN">
                    </form>

                </div>
    


        </div>
    </div>
</body>

</html>