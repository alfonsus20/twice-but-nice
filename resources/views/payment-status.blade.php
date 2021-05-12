@extends('layouts.app')
@section('content')
    <div class='d-flex justify-center align-items-center' style="height: 20rem">
        <div class="mx-auto text-center d-flex flex-column ">
            <h3>Transaksi {{ $status }}</h3>
            <a href="/">Kembali ke halaman awal</a>
        </div>
    </div>
@endsection
