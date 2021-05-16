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
                @if ($cart_items->count() > 0)
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
                                        @foreach ($cart_items as $item)
                                            <tr class="{{ $item->available ? '' : 'text-danger' }}">
                                                <td>
                                                    <div class="img">
                                                        <img src="{{ asset('img/products/' . $products_images[$item->id]) }}"
                                                            alt="Product Image">

                                                        <p>{{ $item->name }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ ucfirst(trans($item->brand)) }}
                                                </td>
                                                <td>
                                                    {{ $item->size_name }}
                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->available ? 'Ada' : 'Kosong' }}</td>
                                                <td><a href="/cart/{{ $item->id }}/delete"><i
                                                            class="fa fa-trash"></i></a></td>
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
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Ringkasan Belanja</h1>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($cart_items as $item)
                                                <p>{{ $item->name }}<span>Rp {{ $item->price }}</span></p>
                                                @php
                                                    $total += $item->price;
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
@include('script.toast')