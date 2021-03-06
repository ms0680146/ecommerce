<div class="might-like-section">
    <div class="container">
        <h2>您可能也會喜歡...</h2>
        <div class="might-like-grid">
            @foreach ($mightAlsoLike as $product)
                <a href="{{ route('shop.show', $product->slug) }}" class="might-like-product">
                    <img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product">
                    <div class="might-like-product-name">{{ $product->name }}</div>
                    <div class="might-like-product-price">{{ $product->price }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>