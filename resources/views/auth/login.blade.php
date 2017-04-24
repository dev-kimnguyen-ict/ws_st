<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập thệ thống</title>
    <link rel="stylesheet" href="{{ URL::asset('css/login.min.css') }}"/>
</head>
<body class="loginPage">
    

    <!-- Main content wrapper -->
    <div class="loginWrapper" style="top:45%;">
    
        <div id="admin_login" style="height:auto; margin:auto;">
            <div class="title">
                <a href="{{ url('/') }}">
                    <img src="{{ URL::asset('contents/images/icons/dark/laptop.png') }}" class="titleIcon"/>
                </a>
                <h6>Đăng nhập</h6>
                <div class="social-auth">
                    <a href="{{ route('auth.social.redirect', 'facebook') }}"
                        class="social-auth-facebook"
                        title="Đăng nhập bằng tài khoản facebook">
                    </a>
                    <a href="{{ route('auth.social.redirect', 'google') }}"
                        class="social-auth-google"
                        title="Đăng nhập bằng tài khoản Google">
                    </a>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="has-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            {!! Form::open([
                'route' => 'auth.postLogin',
                'method' => 'POST',
                'class' => 'form',
                'id' => 'form'
            ]) !!}
               <fieldset>
                    <div class="formRow">
                        {!! Form::label('email', 'Địa chỉ email:') !!}
                        <div class="loginInput">{!! Form::email('email', null, ['required' => 'true']) !!}</div>
                    </div>
                    
                    <div class="formRow">
                        {!! Form::label('password', 'Mật khẩu:') !!}
                        <div class="loginInput">{!! Form::password('password', null, ['required' => true]) !!}</div>
                    </div>
                    
                    <div class="loginControl">
                        {!! Form::submit('Đăng nhập', ['class' => 'logMeIn']) !!}
                        <div style="float: left; margin: 20px 15px;">
                            <a href="{{ route('auth.getRegister') }}"
                                style="float: left; display: block; text-decoration: none; color: inherit;">Đăng ký</a>
                            <a href="{{ route('password.getPasswordReset') }}"
                                style="float: left; margin-left: 20px; display: block; text-decoration: none; color: inherit;">Quên mật khẩu?</a>
                        </div>
                    </div>
                </fieldset>
            {!! Form::close() !!}
        </div>
    </div> 
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">Bản quyền &copy; 2016 - Nguyễn Hữu Kim</div>
    </div>

</body>
</html>