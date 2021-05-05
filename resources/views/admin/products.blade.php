@extends('layouts.admin')
@section('content')
    <!-- Main Content -->

    <div class="section-header">
        <h1>Daftar Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    @include('components.message')

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
                                    <th>Sex</th>
                                    <th>Kategori</th>
                                    <th>Warna</th>
                                    <th>Size</th>
                                    <th>Kualitas</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th colspan="2" class="text-center">Action</th>
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
                                        <td>
                                            <div class="badge badge-{{ $product->sex ? 'info' : 'secondary' }}">
                                                {{ $product->sex ? 'Pria' : 'Wanita' }}</div>
                                        </td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>{{ $product->color_name }}</td>
                                        <td>{{ $product->size_name }}</td>
                                        <td>{{ $product->quality }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <div class="badge badge-{{ $product->available ? 'success' : 'danger' }}">
                                                {{ $product->available ? 'Ada' : 'Kosong' }}</div>
                                        </td>
                                        <td class="text-center"><a href="/admin/products/{{ $product->id }}/edit"
                                                class="btn btn-warning">Ubah</a></td>
                                        <td class="text-center"><a href="/admin/products/{{ $product->id }}/delete"
                                                class="btn btn-danger">Hapus</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                            class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
