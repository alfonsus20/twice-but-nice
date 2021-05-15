@extends('layouts.app')
@section('content')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item active">Order</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid my-4">
            <div class="row">
                @if ($orders->count() > 0)
                    <div class="col-lg-12">
                        <div class="cart-page-inner">
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Order</th>
                                            <th>Produk Yang Dibeli</th>
                                            <th>Total Harga</th>
                                            <th>Waktu Pemesanan</th>
                                            <th>Bayar</th>
                                            <th>Pengiriman</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>
                                                    @foreach ($order_items as $item)
                                                        @if ($item->order_id === $order->id)
                                                            <div class="d-flex flex-row items-center">
                                                                <div class="img">
                                                                    <img src="{{ asset('img/products/' . $products_images[$item->id]) }}"
                                                                        alt="Product Image">
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    {{ $item->name }}</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $order->total }}
                                                </td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @if ($order->paid)
                                                        Sudah dibayar
                                                    @else
                                                        Belum dibayar
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>
                                                        @if ($order->delivered)
                                                            Sudah dikirim
                                                        @else
                                                            Belum dikirim
                                                        @endif
                                                    </div>
                                                    <div>
                                                        {{ $order->courier }}
                                                    </div>
                                                    <div>
                                                        ({{ $order->service }})
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/order/{{ $order->id }}" class="btn">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @else
                    <div style="min-height: 40vh" class="d-flex justify-content-center align-items-center">
                        <h5 class="text-center">Belum ada produk yang dipesan</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@include('components.toast')
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