<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Ecommerce Example</title>
    @vite(['resources/sass/app.scss'])
</head>
<body>
<div id="app">
    <header class="with-background">
        <div class="top-nav container">
            <div class="top-nav-left">
                <div class="logo">Laravel Ecommerce</div>
                {{ menu('main', 'partials.menus.main') }}
            </div>
            <div class="top-nav-right">
                @include('partials.menus.main-right')
            </div>
        </div> <!-- end top-nav -->
        <div class="hero container">
            <div class="hero-copy">
                <h1>Laravel Ecommerce Demo</h1>
                <p>Includes multiple products, categories, a shopping cart and a checkout system with Stripe
                    integration.</p>
                <div class="hero-buttons">
                    <a href="#" class="button button-white">Screencasts</a>
                    <a href="#" class="button button-white">GitHub</a>
                </div>
            </div> <!-- end hero-copy -->

            <div class="hero-image">
                <img src="img/macbook-pro-laravel.png" alt="hero image">
            </div> <!-- end hero-image -->
        </div> <!-- end hero -->
    </header>

    <div class="featured-section">

        <div class="container">
            <h1 class="text-center">Laravel Ecommerce</h1>

            <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi,
                consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt
                aliquid possimus temporibus enim eum hic.</p>

            <div class="text-center button-container">
                <a href="#" class="button">Featured</a>
                <a href="#" class="button">On Sale</a>
            </div>

            <div class="products text-center">
                @foreach ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img
                                src="{{ productImage($product->image) }}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}">
                            <div class="product-name">{{ $product->name }}</div>
                        </a>
                        <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                @endforeach
            </div> <!-- end products -->

            <div class="text-center button-container">
                <a href="{{ route('shop.index') }}" class="button">View more products</a>
            </div>

        </div> <!-- end container -->

    </div> <!-- end featured-section -->

    <blog-posts></blog-posts>

    @include('partials.footer')
</div>

@vite(['resources/js/app.js'])

</body>
</html>
