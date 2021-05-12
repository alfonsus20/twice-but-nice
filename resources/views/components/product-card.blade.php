<div class="col-md-4">
    <div class="product-item">
        <div class="product-title">
            <a href="#">{{ $product->name }}</a>
        </div>
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
        <div class="product-price">
            <h3><span>Rp</span>{{ $product->price }}</h3>
            <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
        </div>
    </div>
</div>