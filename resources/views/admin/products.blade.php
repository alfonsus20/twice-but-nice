@extends('layouts.admin')
@section('content')
    <!-- Main Content -->

    <div class="section-header">
        <h1>Daftar Produk</h1>
    </div>

    @include('components.message')
    <form action="/admin/products" class="position-relative" method="get">
        <label class="form-label">Masukkan kata kunci</label>
        <input type="text" class="form-control" value="{{Request::get('keyword')}}" name="keyword" placeholder="Cari produk ..." style="padding-right: 34px">
        <button type="submit" class="btn btn-primary position-absolute top-0 end-0" style="color : white;text-decoration : none;    bottom: 5px;
                right: 0;"><i class="fa fa-search"></i></button>
    </form>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Brand</th>
                                    <th>Deskripsi</th>
                                    <th>Kondisi</th>
                                    <th>Sex</th>
                                    <th>Kategori</th>
                                    <th>Size</th>
                                    <th>Kualitas</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @php
                                    $page = (int) request()->get('page');
                                    if ($page < 1) {
                                        $page = 1;
                                    }
                                @endphp
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 + 10 * ($page - 1) }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->condition }}</td>
                                        <td>
                                            <div class="badge badge-{{ $product->sex ? 'info' : 'secondary' }}">
                                                {{ $product->sex ? 'Pria' : 'Wanita' }}</div>
                                        </td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->size_name }}</td>
                                        <td>{{ $product->quality }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <div class="badge badge-{{ $product->available ? 'success' : 'danger' }}">
                                                {{ $product->available ? 'Ada' : 'Kosong' }}</div>
                                        </td>
                                        <td class="text-center"><a href="/admin/products/{{ $product->id }}/edit"
                                                class="btn btn-warning">Ubah</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
