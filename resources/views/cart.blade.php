@extends('layouts.app')
@section('content')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                @if ($added_products->count() > 0)
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Brand</th>
                                            <th>Size</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($added_products as $product)
                                            <tr class="{{ $product->available ? '' : 'text-danger' }}">
                                                <td>
                                                    <div class="img">
                                                        @foreach ($products_images as $products_image)
                                                            @if ($product->id == $products_image->product_id)
                                                                <img src="{{ asset('img/products/' . $products_image->path) }}"
                                                                    alt="Product Image">
                                                            @break
                                                        @endif
                                        @endforeach
                                        <p>{{ $product->name }}</p>
                            </div>
                            </td>
                            <td>
                                {{ ucfirst(trans($product->brand)) }}
                            </td>
                            <td>
                                {{ $product->size_name }}
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->available ? 'Ada' : 'Kosong' }}</td>
                            <td><a href="/cart/{{ $product->id }}/delete"><i class="fa fa-trash"></i></a></td>
                            </tr>
                @endforeach
                </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="cart-page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="coupon">
                        <input type="text" placeholder="Coupon Code">
                        <button>Apply Code</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="cart-summary">
                        <div class="cart-content">
                            <h1>Ringkasan Belanja</h1>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($added_products as $product)
                                <p>{{ $product->name }}<span>Rp {{ $product->price }}</span></p>
                                @php
                                    $total += $product->price;
                                @endphp
                            @endforeach
                            <h2>Total<span>Rp {{ $total }}</span></h2>
                        </div>
                        <div class="cart-btn d-flex justify-content-center align-items-center">
                            <a href="/products">Tambah Produk</a>
                            <a href="/checkout">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div style="min-height: 40vh" class="d-flex justify-content-center align-items-center">
        <h5 class="text-center">Belum ada produk yang ditambahkan ke keranjang</h5>
    </div>
    @endif
    </div>
    </div>
    @include('components.toast')
    </div>
    <!-- Cart End -->
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