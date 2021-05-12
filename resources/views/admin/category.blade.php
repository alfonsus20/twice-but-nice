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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection