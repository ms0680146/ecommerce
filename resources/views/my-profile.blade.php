@extends('layout')

@section('title', '個人頁面')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-container container">
            <div>
                <a href="/">首頁</a>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span>個人頁面</span>
            </div>
            <div>
                @include('partials.menus.search')
            </div>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="container">
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
    </div>

    <div class="products-section container">
        <div class="sidebar">
            <ul>
              <li class="active"><a href="{{ route('users.profile.edit') }}">帳號設定</a></li>
              <li><a href="{{ route('users.order.index') }}">我的訂購</a></li>
            </ul>
        </div> <!-- end sidebar -->
        <div class="my-profile">
            <div class="products-header">
                <h1 class="stylish-heading">帳號設定</h1>
            </div>

            <div>
                <form action="{{ route('users.profile.update') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-control">
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="姓名" required>
                    </div>
                    <div class="form-control">
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>
                    </div>
                    <div class="form-control">
                        <input id="password" type="password" name="password" placeholder="密碼">
                        <div>若不想更新密碼，留空白即可</div>
                    </div>
                    <div class="form-control">
                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="確認密碼">
                    </div>
                    <div>
                        <button type="submit" class="my-profile-button">更新個人資料</button>
                    </div>
                </form>
            </div>

            <div class="spacer"></div>
        </div>
    </div>

@endsection