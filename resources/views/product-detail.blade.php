@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Detail Start -->
    <div class="product-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="product-slider-single normal-slider">
                                    @foreach ($product_images as $product_image)
                                        @if ($product->id == $product_image->product_id)
                                            <img src="{{ asset('img/products/' . $product_image->path) }}"
                                                alt="Product Image">
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{ $product->name }}</h2>
                                    </div>

                                    <div class="price my-4">
                                        <p>Rp {{ $product->price }}</p>
                                    </div>

                                    <div class="action d-flex flex-row">
                                        <a class="btn {{in_array($product->id, $user_wishlist_items_ids) ? 'active-button' : ''}}" href="/wishlist/{{ $product->id }}/add"><i class="fa fa-heart"></i>
                                            +Wishlist</a>
                                        <a class="btn {{in_array($product->id, $user_cart_items_ids) ? 'active-button' : ''}}" href="/cart/{{ $product->id }}/add"><i
                                                class="fa fa-shopping-cart"></i> +Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row product-detail-bottom">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Deskripsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#specification">Spesifikasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#reviews">Kondisi</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active">
                                    <h4>Deskripsi Produk</h4>
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                                <div id="specification" class="container tab-pane fade">
                                    <h4>Spesifikasi Produk</h4>
                                    <table>
                                        <tbody>
                                            <tr class=spec-row>
                                                <td class="spec">Kategori</td>
                                                <td>{{ $product->category_name }}</td>
                                            </tr>
                                            <tr class=spec-row>
                                                <td class="spec">Merek</td>
                                                <td> {{ $product->brand }}</td>
                                            </tr>
                                            <tr class=spec-row>
                                                <td class="spec">Stok</td>
                                                <td> {{ $product->available ? 'Ada' : 'Kosong' }}</td>
                                            </tr>
                                            <tr class=spec-row>
                                                <td class="spec">Size</td>
                                                <td>{{ $product->size_name }}</td>
                                            </tr>
                                            <tr class=spec-row>
                                                <td class="spec">Kualitas</td>
                                                <td>{{ $product->quality }} / 10</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="reviews" class="container tab-pane fade">
                                    <h4>Kondisi Produk</h4>
                                    <p>
                                        {{ $product->condition }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product">
                        <div class="section-header">
                            <h1>Produk Berkaitan</h1>
                        </div>

                        <div class="row align-items-center product-slider product-slider-3">
                            <div class="col-lg-3">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="#">Product Name</a>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <a href="product-detail.html">
                                            <img src="{{ asset('img/product-1.jpg') }}" alt="Product Image">
                                        </a>
                                        <div class="product-action">
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><span>$</span>99</h3>
                                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="#">Product Name</a>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <a href="product-detail.html">
                                            <img src="{{ asset('img/product-8.jpg') }}" alt="Product Image">
                                        </a>
                                        <div class="product-action">
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><span>$</span>99</h3>
                                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="#">Product Name</a>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <a href="product-detail.html">
                                            <img src="{{ asset('img/product-6.jpg') }}" alt="Product Image">
                                        </a>
                                        <div class="product-action">
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><span>$</span>99</h3>
                                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.toast')
    <!-- Product Detail End -->
@endsection
@include('script.toast')
