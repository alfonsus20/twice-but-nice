@extends('layouts.admin')

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Daftar Pengiriman</h1>
    </div>
    @include('components.message')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ID Pengiriman</th>
                                        <th>ID Order</th>
                                        <th>Customer</th>
                                        <th>Status Pembayaran</th>
                                        <th>Jenis Pengiriman</th>
                                        <th>Jenis Service</th>
                                        <th>Status Pengiriman</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($shippings as $shipping)
                                        <tr>
                                            <td>{{ $shipping->id }}</td>
                                            <td class="font-weight-600">{{$shipping->order_id}}</td>
                                            <td>
                                                {{ $shipping->name }}
                                            </td>
                                            <td>
                                                @if ($shipping->paid)
                                                    <div class="badge badge-success">Sudah dibayar</div>
                                                @else
                                                    <div class="badge badge-danger">Belum dibayar</div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $shipping->courier }}
                                            </td>
                                            <td>
                                                {{ $shipping->service }}
                                            </td>
                                            <td>
                                                @if ($shipping->delivered)
                                                    <div class="badge badge-success">Sudah dikirim</div>
                                                @else
                                                    <div class="badge badge-danger">Belum dikirim</div>
                                                @endif
                                            </td>                                          
                                            <td class="text-center">
                                                @if (!$shipping->delivered && $shipping->paid)
                                                    <a href="/admin/shipping/{{$shipping->id}}/send" class="btn btn-primary">Kirim</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{ $shippings->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection