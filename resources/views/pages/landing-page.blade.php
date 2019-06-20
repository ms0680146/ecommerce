<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ecommerce | 電子商務平台</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div id="app">
            <header class="with-background">
                <div class="top-nav container">
                    <div class="top-nav-left">
                        <a href="/"><div class="logo">電子商務</div></a>
                        @include('partials.menus.main')
                    </div>
                    <div class="top-nav-right">
                        @include('partials.menus.main-right')
                    </div>
                </div> <!-- end top-nav -->
                <div class="hero container">
                    <div class="hero-copy">
                        <h1>電子商務平台展示</h1>
                        <p>包含商品, 部落格, 購物車等功能</p>
                    </div> <!-- end hero-copy -->
                </div> <!-- end hero -->    
            </header>

           <div class="featured-section">
                <div class="container">
                    <h1 class="text-center">商品</h1>

                    <p class="section-description">請挑選您喜歡的商品吧.</p>

                    <div class="products text-center">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product"></a>
                                <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                                <div class="product-price">{{ round($product->price) }}</div>
                            </div>
                        @endforeach
                    </div> <!-- end products -->

                    <div class="text-center button-container">
                        <a href="{{ route('shop.index') }}" class="button">更多商品</a>
                    </div>

                </div> <!-- end container -->

            </div> <!-- end featured-section -->
            @include('partials.footer')
        </div> <!-- end #app -->
    </body>
</html>