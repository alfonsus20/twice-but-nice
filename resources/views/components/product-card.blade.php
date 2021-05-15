<div class="col-md-4">
    <div class="product-item">
        <div class="product-image">
            <a href="/products/{{ $product->id }}">
                <img src="{{ asset('img/products/' . $products_images[$product->id]) }}"
                    alt="Product Image">
            </a>
            <div class="product-action">
                <a href="/cart/{{ $product->id }}/add" class="{{ in_array($product->id, $user_cart_items_ids) ? 'liked-product' : '' }}"><i class="fa fa-cart-plus"></i></a>
                <a href="/wishlist/{{ $product->id }}/add"
                    class="{{ in_array($product->id, $user_wishlist_items_ids) ? 'liked-product' : '' }}"><i
                        class="fa fa-heart"></i></a>
                <a href="/products/{{ $product->id }}"><i class="fa fa-search"></i></a>
            </div>
        </div>
        <div class="text-center py-2 product-description bg-white shadow-sm d-flex flex-column">
            <a href="/products/{{$product->id}}" class="text-decoration-none fw-bold fs-5">{{ $product->name }}</a>
            <div class="text-muted my-1">{{$product->brand}}</div>
            <div class="my-1 fs-6"><span>Rp</span>{{ $product->price }}</div>
        </div>
    </div>
</div>