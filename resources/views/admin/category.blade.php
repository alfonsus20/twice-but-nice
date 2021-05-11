@extends('layouts.admin')
@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Daftar Kategori</h1>
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
                                    <th>Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @php
                                    $page = (int) request()->get('page');
                                    if ($page < 1) {
                                        $page = 1;
                                    }
                                @endphp
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 + 10 * ($page - 1) }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td class="text-center"><a href="/admin/category/{{ $category->id }}/edit"
                                                class="btn btn-warning">Ubah</a></td>
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
