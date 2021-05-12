@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item active">Wishlist</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Wishlist Start -->
    <div class="wishlist-page">
        <div class="container-fluid">
            <div class="wishlist-page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @if ($liked_products->count() > 0)
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Brand</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($liked_products as $product)
                                            <tr>
                                                <td>
                                                    <div class="img">
                                                        <img src="{{ asset('img/products/' . $products_images[$product->id]) }}"
                                                            alt="Product Image">
                                                        <p>{{ $product->name }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ ucfirst(trans($product->brand)) }}
                                                </td>
                                                <td>{{ $product->price }}</td>
                                                <td>
                                                    <a class="btn me-4" href="/cart/{{$product->id}}/add"><i class="fas fa-shopping-cart"></i></a>
                                                    <a class="btn" href="/wishlist/{{ $product->id }}/delete"><i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div style="min-height: 40vh" class="d-flex justify-content-center align-items-center">
                                    <h4 class="text-center">Belum ada produk yang ditambahkan ke wishlist</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.toast')
    <!-- Wishlist End -->
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