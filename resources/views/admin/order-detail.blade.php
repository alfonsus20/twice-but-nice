@extends('layouts.admin')
@section('content')
    <div class="section-header">
        <h1>Detail Pemesanan</h1>
    </div>
    @include('components.message')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <td>ID Order</td>
                                <td>{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <td>Nama Customer</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Produk yang dibeli</td>
                                <td class="d-flex flex-wrap flex-row">
                                    @foreach ($products as $product)
                                        <div class='card m-2' style='width: 15rem;'>
                                            <div class='shadow rounded'>
                                                <img src="{{ asset('img/products') . '/' . $products_images[$product->id] }}"
                                                    class='w-100'>
                                                <div class='card-body'>
                                                    <h5 class='card-title text-center text-black'>{{ $product->name }}
                                                    </h5>
                                                    <p class='card-text text-center text-black'>{{ $product->price }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Pengiriman</td>
                                <td>{{ strtoupper($shipping->courier) }} ({{ $shipping->service }})</td>
                            </tr>
                            <tr>
                                <td>Biaya Pengiriman</td>
                                <td>{{ $shipping->cost }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>{{ $order->total }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>{{ $payment->type }}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembayaran</td>
                                <td>{{ $payment->updated_at }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
