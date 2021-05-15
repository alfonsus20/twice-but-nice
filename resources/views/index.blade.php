@extends('layouts.app')

@section('content')
    <!-- Main Slider Start -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=1"><i class="fas fa-tshirt"></i>Baju</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=10"><i class="fas fa-hat-cowboy"></i>Topi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=7"><i class="fas fa-user-secret"></i>Jaket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=5"><i class="fas fa-shoe-prints"></i>Sepatu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=pria"><i class="fa fa-male"></i>Pakaian Pria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products?category=wanita"><i class="fa fa-female"></i>Pakaian Wanita</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="header-slider normal-slider">
                        <div class="header-slider-item">
                            <img src="img/slider-1.jpg" alt="Slider Image" class="w-100" />
                            <div class="header-slider-caption">
                                <p>Pakaian thrifting dengan harga bersaing</p>
                                <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Belanja</a>
                            </div>
                        </div>
                        <div class="header-slider-item">
                            <img src="img/slider-2.jpg" alt="Slider Image" class="w-100" />
                            <div class="header-slider-caption">
                                <p>Terdapat banyak jenis pakaian, mulai dari baju, jaket, sepatu dan masih banyak lagi</p>
                                <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Belanja</a>
                            </div>
                        </div>
                        <div class="header-slider-item">
                            <img src="img/slider-3.jpg" alt="Slider Image" class="w-100" />
                            <div class="header-slider-caption">
                                <p>Mendukung berbagai jenis pengiriman dan metode pembayaran</p>
                                <a class="btn" href="/products"><i class="fa fa-shopping-cart"></i>Belanja</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-img">
                        <div class="img-item">
                            <img src="img/category-1.jpg" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="img-item">
                            <img src="img/category-2.jpg" />
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fab fa-cc-mastercard"></i>
                        <h2>Pembayaran yang Aman</h2>
                        <p>
                            Pembayaran dapat dilakukan dengan gopay, ovo, kartu kredit dan debit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Pengiriman yang Luas</h2>
                        <p>
                            Pengiriman tersedia ke seluruh Indonesia
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-check"></i>
                        <h2>Kualitas yang Terjamin</h2>
                        <p>
                           Pakaian yang kami sediakan terjamin kualitasnya
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fas fa-dollar-sign"></i>>
                        <h2>Harga yang Terjangkau</h2>
                        <p>
                            Kualitas bintang lima namun harga kaki lima
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->

    <!-- Category Start-->
    <div class="category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="img/category-3.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-250">
                        <img src="img/category-4.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                    <div class="category-item ch-150">
                        <img src="img/category-5.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-150">
                        <img src="img/category-6.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                    <div class="category-item ch-250">
                        <img src="img/category-7.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="img/category-8.jpg" />
                        <a class="category-name" href="">
                            <p>Some text goes here that describes the image</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End-->

    <!-- Call to Action Start -->
    <div class="call-to-action">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>Hubungi kami untuk informasi selengkapnya</h1>
                </div>
                <div class="col-md-6">
                    <a href="tel:+628129120221" class="text-decoration-none">+628129120221</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Produk Unggulan</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($featured_products as $product)
                    @include('components.product-card')
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Produk terbaru</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($newest_products as $product)
                    @include('components.product-card')
                @endforeach
            </div>
        </div>
    </div>
    <!-- Recent Product End -->

    <!-- Review Start -->
    <div class="review">
        <div class="container-fluid">
            <div class="row align-items-center review-slider normal-slider">
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-1.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo
                                finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-2.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo
                                finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="review-slider-item">
                        <div class="review-img">
                            <img src="img/review-3.jpg" alt="Image">
                        </div>
                        <div class="review-text">
                            <h2>Customer Name</h2>
                            <h3>Profession</h3>
                            <div class="ratting">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo
                                finibus luctus et vitae lorem
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Review End -->
@include('components.toast')
@endsection
@include('script.toast')