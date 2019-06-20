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
                        <p><strong>功能包含:</strong><br>
                        <strong>1. 商品功能</strong>: 商品展示，Cookie紀錄瀏覽過的商品，關聯商品及類別，商品分頁，提供價格排序。 <br>
                        <strong>2. 購物車功能</strong>: 購物車商品移除及新增，Ajax實作購物車商品數量的增加，購物車稍後購買。 <br>
                        <strong>3. 結帳功能</strong>: 商品折扣碼使用，結帳資料寫入Mysql，查看個人結帳清單。<br>
                        <strong>4. 會員系統</strong>: 註冊及登入，修改個人會員資料，提供Google登入。<br>
                        <strong>5. 搜尋功能</strong>: 採用Elasticsearch做引擎，laravel scout做全文索引。
                        </p>
                    </div> <!-- end hero-copy -->
                </div> <!-- end hero -->    
            </header>

           <div class="featured-section">
                <div class="container">
                    @if ($browsedProducts->isNotEmpty())
                    <h1 class="text-center">曾瀏覽過的商品</h1>
                    <p class="section-description">透過cookie紀錄瀏覽過的商品，實作流程:  <br>
                    1. 於Product頁看過一個商品，會將該商品的id存到瀏覽紀錄，瀏覽紀錄以cookie存取。 <br>
                    2. 當看過的商品已經出現在瀏覽紀錄裡面，就不用重複存取。 <br>
                    3. 當瀏覽紀錄已經有8筆時，當有新的商品加入，最舊的一筆會被剔除。 <br> 
                    4. 從cookie中拿出瀏覽紀錄中商品的id。 <br>
                    5. 藉由cookie拿出的id，可以找到商品。 <br>
                    </p>
                        <div class="products text-center">
                            @foreach ($browsedProducts as $product)
                                <div class="product">
                                    <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product"></a>
                                    <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                                    <div class="product-price">{{ round($product->price) }}</div>
                                </div>
                            @endforeach
                        </div> <!-- end browsed Products -->
                    @endif
                    <br>
                    @if($products->isNotEmpty())
                    <h1 class="text-center">精選商品</h1>
                    <p class="section-description">商品(Products)的table有紀錄feature欄位，目的為精選出商品:  <br>
                    單純透過sql下出feature=true，亦即此商品為精選商品，另外也依照商品創建的時間進行排序。 <br>
                    </p>
                    <div class="products text-center">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product"></a>
                                <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                                <div class="product-price">{{ round($product->price) }}</div>
                            </div>
                        @endforeach
                    </div> <!-- end products -->
                    @endif

                    <div class="text-center button-container">
                        <a href="{{ route('shop.index') }}" class="button">更多商品</a>
                    </div>

                </div> <!-- end container -->

            </div> <!-- end featured-section -->
            @include('partials.footer')
        </div> <!-- end #app -->
    </body>
</html>