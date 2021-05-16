@component('mail::message')
# Hi, {{isset($username) ? $username : "Testing" }}

Terima kasih, telah berbelanja di Twice But Nice. Berikut rincian pembelajaan kamu:

@php
    $i = 1;
    $total = 0;
@endphp

@component('mail::table')
| No.      | Produk         | Harga  |
| ------------- |:-------------:| --------:|
@foreach ($products as $product)
|{{$i}}.| <div style="display: flex; flex-direction : row; margin: 10px;align-items: center;"><img src="file://{{asset('img/products/'. $products_images[$product->id])}}" alt="product" style="width: 40px; height:auto;"> <div style="padding-left: 20px">{{$product->name}}</div> </div>  | {{$product->price}} |
@php
    $i+=1;
    $total += $product->price;
@endphp
@endforeach
|       | Subtotal | {{$total}}     |
|       | Ongkos Kirim <br> ({{$shipping->courier}} : {{$shipping->service}}) | {{$shipping->cost}}      |
|       | Grand Total | {{$total + $shipping->cost}}      |
@endcomponent

Kamu dapat memantau pengiriman barangmu di sini:
@component('mail::button', ['url' => $url, 'color' => '#897853'])
Pantau Pesanan
@endcomponent

Salam Hangat,<br>
Admin {{ config('app.name') }}
@endcomponent