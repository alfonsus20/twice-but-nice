@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item"><a href="/order">Order</a></li>
                <li class="breadcrumb-item active">Order Detail</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid my-4">
            <div class="row">

                <div class="col-lg-12">
                    <div class="cart-page-inner">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Brand</th>
                                        <th>Size</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody class="align-middle">
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="d-flex flex-row items-center">
                                                    <div class="img">
                                                        <img src="{{ asset('img/products/' . $products_images[$product->id]) }}"
                                                            alt="Product Image">
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        {{ $product->name }}</div>
                                                </div>
                                            </td>
                                            <td>{{ $product->brand }}</td>
                                            <td>{{ $product->size_name }}</td>
                                            <td>
                                                Rp {{ $product->price }}
                                            </td>
                                        </tr>
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            Total
                                        </td>
                                        <td>
                                            Rp {{ $order->total - $order->cost }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Ongkos kirim
                                            ({{ $order->courier }} : {{ $order->service }})
                                        </td>
                                        <td>
                                            Rp {{ $order->cost }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Subtotal
                                        </td>
                                        <td>
                                            Rp {{ $order->total }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            Pembayaran
                                        </td>
                                        <td>
                                            <strong>
                                                @if ($order->paid)
                                                    Sudah dibayar
                                                @elseif (!$order->paid && $current_status == 'unpaid')
                                                    Belum dibayar
                                                @else
                                                    Pembayaran {{ $current_status }}
                                                @endif
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if (!$order->paid)
                        <div class="d-flex">
                            <div class="ms-auto">
                                @if ($current_status != 'pending')
                                    <a class="btn btn-danger " href="/order/{{ $order->id }}/delete">Batal</a>
                                @endif
                                @if ($current_status == 'unpaid')
                                    <a class="btn" type="submit" id='pay-button'>Bayar</a>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div id="snapToken" class="d-none">
                        {{ $snapToken }}
                    </div>
                    <form action="/payment" method="POST" id="form-payment">
                        @csrf
                        <input type="hidden" name="result_data" id="result_data">
                        <input type="hidden" name="result_type" id="result_type">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var formPayment = $('#form-payment');
        var resultData = $("#result_data");
        var resultType = $("#result_type");
        payButton.addEventListener('click', function() {
            var token = document.getElementById('snapToken').innerText.trim();
            // console.log(token.trim());
            snap.pay(token, {
                onSuccess: function(result) {
                    resultType.val('success');
                    resultData.val(JSON.stringify(result));
                    console.log(result);
                    formPayment.submit();
                },
                onPending: function(result) {
                    resultType.val('pending');
                    resultData.val(JSON.stringify(result));
                    console.log(result);
                    formPayment.submit();
                },
                onError: function(result) {
                    resultType.val('error');
                    resultData.val(JSON.stringify(result));
                    console.log(result);
                    formPayment.submit();
                },
                onClose: function() {
                    resultType.val('closed');
                    console.log(result);
                }
            });
        });
    </script>
@endsection