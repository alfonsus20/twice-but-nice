@extends('layouts.app')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item">Order</li>
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
                                        <th>Harga</th>
                                        <th>Brand</th>
                                        <th>Size</th>
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
                                                        @foreach ($products_images as $products_image)
                                                            @if ($product->id === $products_image->product_id)
                                                                <img src="{{ asset('img/products/' . $products_image->path) }}"
                                                                    alt="Product Image">
                                                            @break
                                                        @endif
                                    @endforeach
                        </div>
                        <div class="d-flex justify-content-center align-items-center">{{ $product->name }}</div>
                    </div>
                    </td>
                    <td>
                        {{ $product->price }}
                    </td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->size_name }}</td>
                    </tr>
                    @php
                        $i = $i + 1;
                    @endphp
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex">
                <div class="ms-auto">
                    <a class="btn btn-danger " href="/order/{{ $order->id }}/delete">Batal</a>
                    {{-- <form class="btn p-0" action="/order/{{ $order->id }}/pay" method="POST"> --}}
                    {{-- @csrf --}}
                    <button class="w-auto h-auto pay-order btn" type="submit" id='pay-button'
                        style="background-color: transparent; padding: 6px 12px; font-size:1rem; color: #897853">Bayar</button>
                    {{-- </form> --}}
                </div>
            </div>
            <div id="snapToken">
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

{{-- @section('content')
    <a class="btn btn-danger " href="/order/{{ $order->id }}/delete">Batal</a>
    <form class="btn p-0" action="/order/{{ $order->id }}/pay" method="POST">
        @csrf
        <button class="w-auto h-auto pay-order" type="submit"
            style="background-color: transparent; padding: 6px 12px; font-size:1rem; color: #897853">Bayar</button>
    </form>
@endsection --}}

@section('script')
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var formPayment = $('#form-payment');
        var resultData = $("#result_data");
        var resultType = $("#result_type");
        payButton.addEventListener('click', function() {
            var token = document.getElementById('snapToken').innerText;
            console.log(token);
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