@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-widget brands">
                        <form class="row" action="/products" method="GET">
                            <div class="col-md-12 position-relative" style="padding : 0">
                                @if (Request::get('category'))
                                    <input type="hidden" name="category" value="{{ Request::get('category') }}">
                                @endif
                                <label class="form-label">Masukkan kata kunci</label>
                                <input type="text" class="form-control" name="keyword" placeholder="Cari produk ..."
                                    onchange="setURL(event.target.value)" value="{{ Request::get('keyword') }}" style="padding-right: 34px">
                                @if (Request::get('sort'))
                                    <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
                                @endif
                                <button type="submit" id="searchByKeyword"
                                class="btn d-flex align-items-center justify-content-center"
                                style="background-color : #897853;color : white;text-decoration : none;"><i
                                    class="fa fa-search"></i></button>
                            </div>
                            <div class="col-md-2 d-flex align-items-end position-relative">
                                {{-- <div style="margin-bottom: 15px; color : white;" class="product-search"> --}}
                           
                                {{-- </div> --}}
                            </div>
                        </form>
                        <h2 class="title">Kategori</h2>
                        <nav class="navbar">
                            <ul class="navbar-nav">
                                @foreach ($categories as $category)
                                    <li
                                        class="nav-item {{ Request::get('category') == $category->id ? 'active-query' : '' }}">
                                        <a class="nav-link"
                                            href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['category' => $category->id])) }}"></i>{{ ucfirst(trans($category->category_name)) }}</a>
                                    </li>
                                @endforeach
                                <li class="nav-item {{ Request::get('category') == 'pria' ? 'active-query' : '' }}">
                                    <a class="nav-link"
                                        href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['category' => 'pria'])) }}"></i>Pakaian
                                        Pria</a>
                                </li>
                                <li class="nav-item {{ Request::get('category') == 'wanita' ? 'active-query' : '' }}">
                                    <a class="nav-link"
                                        href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['category' => 'wanita'])) }}">Pakaian
                                        Wanita</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <form action="/products" method="GET">
                        <div class="sidebar-widget brands" style="padding-top: 0">
                            <h2 class="title">Harga</h2>
                            <div class="row w-100 px-3">
                                <input type="text" class="col-md-5" value="{{ Request::get('min_price') }}"
                                    name="min_price" id="" placeholder="MIN">
                                <div class="col-md-2 text-center"> - </div>
                                <input type="text" class="col-md-5" value="{{ Request::get('max_price') }}"
                                    name="max_price" id="" placeholder="MAX">
                            </div>
                        </div>

                        <div class="sidebar-widget brands">
                            <h2 class="title">Kualitas</h2>
                            <div class="row w-100 px-3">
                                <input type="text" class="col-md-5" value="{{ Request::get('min_quality') }}"
                                    name="min_quality" id="" placeholder="MIN">
                                <div class="col-md-2 text-center"> - </div>
                                <input type="text" class="col-md-5" value="{{ Request::get('max_quality') }}"
                                    name="max_quality" id="" placeholder="MAX">
                            </div>
                        </div>

                        @if (Request::get('category'))
                            <input type="hidden" name="category" value="{{ Request::get('category') }}">
                        @endif
                        @if (Request::get('sort'))
                            <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
                        @endif
                        @if (Request::get('keyword'))
                            <input type="hidden" name="keyword" value="{{ Request::get('keyword') }}">
                        @endif

                        <div class="sidebar-widget brands d-flex justify-content-center align-items-center">
                            <button class="btn" type="submit">Terapkan</button>
                        </div>
                    </form>
                    <div class="sidebar-widget brands">
                        <h2 class="title">Brand</h2>
                        <ul class="navbar-nav">
                            @foreach ($brands as $brand)
                                <li class="nav-item {{ Request::get('brand') == $brand->brand ? 'active-query' : '' }}">
                                    <a class="nav-link"
                                        href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['brand' => $brand->brand])) }}">{{ $brand->brand }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    <div class="col-md-3 d-flex align-items-center">
                                        <label for="" class="form-label">Urut Berdasarkan</label>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (Request::get('sort') === 'newest')
                                                Paling baru
                                            @elseif(Request::get('sort') === "oldest")
                                                Paling lama
                                            @elseif(Request::get('sort') === "highestPrice")
                                                Harga tertinggi
                                            @elseif(Request::get('sort') === "lowestPrice")
                                                Harga terendah
                                            @else
                                                Tidak ada
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href={{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort' => ''])) }}>Tidak
                                                    ada </a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort' => 'newest'])) }}">Paling
                                                    baru </a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort' => 'oldest'])) }}">Paling
                                                    lama </a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort' => 'lowestPrice'])) }}">Paling
                                                    murah </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge(request()->all(), ['sort' => 'highestPrice'])) }}">Paling
                                                    mahal </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center">
                                        Menampilkan {{ $products->count() }} hasil
                                    </div>
                                </div>
                            </div>
                        </div>

                        @forelse ($products as $product)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="#">{{ $product->name }}</a>
                                    </div>
                                    <div class="product-image">
                                        <a href="/products/{{ $product->id }}">
                                            @foreach ($products_images as $products_image)
                                                @if ($product->id == $products_image->product_id)
                                                    <img src="{{ asset('img/products/' . $products_image->path) }}"
                                                        alt="Product Image">
                                                @break
                                            @endif
                        @endforeach
                        </a>
                        <div class="product-action">
                            <a href="/cart/{{$product->id}}/add"><i class="fa fa-cart-plus"></i></a>
                            <a href="/wishlist/{{$product->id}}/add" class="{{ in_array($product->id, $liked_products) ? "liked-product" : "" }}"><i class="fa fa-heart"></i></a>
                            <a href="/products/{{ $product->id }}"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3><span>Rp</span>{{ $product->price }}</h3>
                        <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
            @empty
                <h3 class="text-center my-4">Produk tidak ditemukan</h3>
                @endforelse
            </div>
            <!-- Pagination Start -->
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
            <!-- Pagination Start -->
        </div>

        <!-- Side Bar Start -->
        <!-- Side Bar End -->
        </div>
        </div>
        </div>
        <!-- Product List End -->
        @include('components.toast')
    @endsection
    @section('script')
        <script>
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {})
            })
            var toast = document.getElementById("toast");
            toastList[0].show();
        </script>
    @endsection