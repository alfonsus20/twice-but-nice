@extends('layouts.app')
@section('content')
    <!-- Checkout Start -->
    <div class="checkout">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form class="checkout-inner" action="/order/create" method="POST">
                        @csrf
                        <div class="checkout-summary">
                            <h1><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</h1>
                            <div class="row">
                                <div class="col-md-4">
                                    {{ auth()->user()->name }}
                                    {{ '(' . auth()->user()->telephone . ')' }}
                                </div>
                                <div class="col-md-6">
                                    {{ auth()->user()->address }}
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <a class="btn" href="/profile">Ubah</a>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-summary">
                            <h1><i class="fas fa-shopping-bag"></i> Total Belanja</h1>
                            @php
                                $sub_total = 0;
                            @endphp
                            @foreach ($cart_items as $item)
                                <div class="d-flex">
                                    @foreach ($products_images as $products_image)
                                        @if ($item->id == $products_image->product_id)
                                            <img src="{{ asset('img/products/' . $products_image->path) }}"
                                                alt="Product Image" style="width: 5rem">
                                        @break
                                    @endif
                            @endforeach
                            <p style="flex-grow: 1; margin-left : 2rem; margin-bottom:0"
                                class="d-flex align-items-center justify-content-between"><span>{{ $item->name }}</span>
                                <span>Rp {{ $item->price }}</span></p>
                            @php
                                $sub_total = $sub_total + $item->price;
                            @endphp
                        </div>
                        @endforeach
                        <p class="sub-total">Sub Total<span id="subtotal">Rp {{ $sub_total }}</span></p>
                        <p class="ship-cost">Pilih Kurir Pengiriman</p>
                        @php
                            $i = 1;
                        @endphp
                        <div class="ms-3">
                            @foreach ($delivery_costs as $name => $delivery_info)
                                @foreach ($delivery_info as $info)
                                    <b>{{ $info->name }}</b>
                                    @foreach ($info->costs as $cost)
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                value="{{ $info->code . '|' . $cost->service }}" type="radio"
                                                name="delivery" id="delivery{{ $i }}">
                                            <label class="form-check-label w-100" for="delivery{{ $i }}">
                                                <p>{{ $cost->service }}<span>Rp {{ $cost->cost[0]->value }}</span>
                                                </p>
                                            </label>
                                        </div>
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                        <p class="ship-cost">Biaya Pengiriman<span id="ship-cost">Rp</span></p>
                        <h2>Grand Total<span id="grand-total"></span></h2>
                    </div>

                    <div class="checkout-payment">
                        <div class="checkout-btn">
                            <button type="submit">Buat Pesanan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Checkout End -->
@endsection
@section('script')
    <script>
        let subtotal = $('#subtotal').text();
        $('input[name="delivery"]').change(() => {
            let deliveryCost = $('input[name="delivery"]:checked').parent().children('label').children().children()
                .text();
            $("#ship-cost").text(deliveryCost);
            $('#grand-total').text("Rp " + (Number(subtotal.replace("Rp ", "")) + Number(deliveryCost.replace("Rp ",
                ""))));
        })

    </script>
@endsection
