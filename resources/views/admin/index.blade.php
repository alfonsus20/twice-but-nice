@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Pengiriman</div>
                    <div class="card-stats-items">
                        <!-- <div class="card-stats-item">
                                        <div class="card-stats-item-count">24</div>
                                        <div class="card-stats-item-label">Pending</div>
                                    </div> -->
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $sent }}</div>
                            <div class="card-stats-item-label">Sudah dikirim</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $not_sent }}</div>
                            <div class="card-stats-item-label">Belum dikirim</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        {{ $sent + $not_sent }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pemasukan</h4>
                    </div>
                    <div class="card-body">
                        Rp {{ $income }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Produk</div>
                    <div class="card-stats-items">
                        <!-- <div class="card-stats-item">
                                        <div class="card-stats-item-count">24</div>
                                        <div class="card-stats-item-label">Pending</div>
                                    </div> -->
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $sold }}</div>
                            <div class="card-stats-item-label">Terjual</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $not_sold }}</div>
                            <div class="card-stats-item-label">Belum Terjual</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Produk</h4>
                    </div>
                    <div class="card-body">
                        {{ $sold + $not_sold }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pemasukan</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>ID Order</th>
                                <th>Nama Customer</th>
                                <th>Total Biaya</th>
                                <th>Metode Pembayaran</th>
                                <th>Waktu Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach ($newest_orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td class="font-weight-600">{{$order->name}}</td>
                                    <td class="font-weight-600">{{$order->total}}</td>
                                    <td class="font-weight-600">{{$order->type}}</td>
                                    <td class="font-weight-600">{{$order->payment_time}}</td>
                                    <td class="font-weight-600"><a href="/admin/orders/{{$order->id}}" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
