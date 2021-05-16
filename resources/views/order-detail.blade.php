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
                                            (<span class="text-uppercase">{{ $order->courier }}</span> :
                                            {{ $order->service }})
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
                                    @if (isset($payment->type))
                                        <tr>
                                            <td colspan="4">
                                                Metode Pembayaran
                                            </td>
                                            <td>
                                                <strong>
                                                    {{ $payment->type }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4">
                                            Status Pengiriman
                                        </td>
                                        <td class="fw-bold">
                                            {{ $order->delivered ? 'Sudah terkirim' : 'Belum dikirim' }}
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
                    <div class="container-fluid bg-white py-4">
                        @if ($order->paid && $shipping->delivered)
                            <div>
                                <h2>
                                    Review
                                </h2>
                                <p>
                                    @if (!$review)
                                        <p>Anda belum memberikan review</p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Beri Review
                                        </button>

                                    @else
                                        {{ $review->message }}
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="/order/{{$order->id}}/review">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Beri Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="review" class="form-label">Masukkan Komentar Anda</label>
                        <input type="text" name="message" class="form-control" id="review" required>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Penilaian Dalam Skala 1 - 5</label>
                        <select class="form-select" aria-label="Default select example" name="rating" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary text-white" style="background-color: #897853;">Kirim</button>
                </div>
            </form>
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
