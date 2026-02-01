@if ($products->count() > 0)
    <div class="grid-layout-3 gap-30-20">
        @foreach ($products as $product)
            <div class="card-product style-2 wow fadeInUp" data-wow-delay="0s">
                <button class="request-quote-btn" data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                    data-product-price="{{ $product->price }}">
                    Request a Quote
                </button>

                <div class="image">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image) : asset('assets/images/item/haagen.png') }}"
                            alt="{{ $product->name }}" style="height:15em;">
                    </a>
                </div>

                <a href="{{ route('products.show', $product->slug) }}" class="name-product font-worksans hover-text-4">
                    {{ $product->name }}
                </a>

                <div class="pricing-star">
                    <div class="price-wrap">
                        <span class="price-2">
                            PKR {{ number_format($product->price, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="no-products-found">
        <i class="fas fa-box-open"></i>
        <h4>No Products Found</h4>
        <p class="text-muted">Try adjusting your search or filter criteria</p>
        <a href="{{ route('products.public.list') }}" class="btn btn-secondary filters mt-2 fs-5">
            Clear Filters
        </a>

    </div>
@endif
