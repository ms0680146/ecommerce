@extends('layout')

@section('title', 'Sign Up for an Account')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div>
             @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <h2>註冊個人帳號</h2>
            <div class="spacer"></div>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="姓名" required autofocus>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                <input id="password" type="password" class="form-control" name="password" placeholder="密碼" required>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="確認密碼"
                    required>

                <div class="login-container">
                    <button type="submit" class="auth-button">註冊</button>
                    <div class="already-have-container">
                        <p><strong>已經有帳號了?</strong></p>
                        <a href="{{ route('login') }}">馬上登入</a>
                    </div>
                </div>

            </form>
        </div>
    </div> <!-- end auth-pages -->
</div>
@endsection