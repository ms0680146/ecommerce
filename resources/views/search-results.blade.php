@extends('layout')

@section('title', 'Search Results')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-container container">
            <div>
                <a href="/">首頁</a>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span>搜尋</span>
            </div>
            <div>
                @include('partials.menus.search')
            </div>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="search-results-container container">
        <h1>搜尋結果</h1>
        @if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <p class="search-results-count">{{ $products->total() }} 個 '{{ request()->keyword }}' 搜尋結果</p>
        @if ($products->total() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>簡介</th>
                    <th>內容</th>
                    <th>價格</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></th>
                        <td>{{ $product->detail }}</td>
                        <td>{{ str_limit($product->description, 80) }}</td>
                        <td>{{ round($product->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->appends(request()->input())->links() }}
        @endif
    </div> <!-- end search-results-container -->

@endsection