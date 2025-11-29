<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        @if ($product->discount_percentage)
            <span class="sale-tag">{{ $product->discount_percentage }}%</span>
        @endif
        <div class="button">
            <a href="{{ route('product.show', $product->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to
                Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name ?? 'Category' }}</span>
        <h4 class="title">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ app(App\Helpers\Currency::class)->format($product->price, 'USD') }}</span>
            @if ($product->compare_price)
                <span class="discount-price">{{ app(App\Helpers\Currency::class)->format($product->compare_price, 'USD') }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->