@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
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

            <h2>用戶登入</h2>
            <div class="spacer"></div>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="密碼" required>

                <div class="login-container">
                    <button type="submit" class="auth-button">登入</button>
                </div>

                <div class="spacer"></div>
            </form>
        </div>

        <div class="auth-right">
            <h2>還不是會員嗎?</h2>
            <div class="spacer"></div>
            <p><strong>訪客</strong></p>
            <p>不需要創建會員即可購物.</p>
            <div class="spacer"></div>
            <a href="{{ route('guest.checkout.index') }}" class="auth-button-hollow">訪客登入</a>
            <div class="spacer"></div>
            &nbsp;
            <div class="spacer"></div>
            <p><strong>註冊</strong></p>
            <p>註冊一個新的會員.</p>
            <div class="spacer"></div>
            <a href="{{ route('register') }}" class="auth-button-hollow">會員註冊</a>

        </div>
    </div>
</div>
@endsection