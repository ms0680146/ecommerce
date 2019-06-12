<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Ecommerce Example</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">


    </head>
    <body>
        <div id="app">
            <header class="with-background">
                <div class="top-nav container">
                    <div class="top-nav-left">
                        <div class="logo">Ecommerce</div>
                    </div>
                    <div class="top-nav-right">
                    </div>
                </div> <!-- end top-nav -->
                <div class="hero container">
                    <div class="hero-copy">
                        <h1>Laravel Ecommerce Demo</h1>
                        <p>Includes multiple products, categories, a shopping cart and a checkout system with Stripe integration.</p>
                        <div class="hero-buttons">
                            <a href="https://www.youtube.com/playlist?list=PLEhEHUEU3x5oPTli631ZX9cxl6cU_sDaR" class="button button-white">Screencasts</a>
                            <a href="https://github.com/drehimself/laravel-ecommerce-example" class="button button-white">GitHub</a>
                        </div>
                    </div> <!-- end hero-copy -->

                    <div class="hero-image">
                        <img src="img/macbook-pro-laravel.png" alt="hero image">
                    </div> <!-- end hero-image -->
                </div> <!-- end hero -->    
            </header>


            </div> <!-- end featured-section -->

            <blog-posts></blog-posts>


        </div> <!-- end #app -->
        <script src="js/app.js"></script>
    </body>
</html>