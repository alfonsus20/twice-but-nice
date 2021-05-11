@extends('layouts.admin')
@section('content')
    <div class="section-header">
        <h1>Edit Size</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="card-body" method="POST" action="/admin/size/{{ $size->id }}/edit"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Size</label>
                            <input type="text" class="form-control" name="size_name"
                                value="{{ $size->size_name }}">
                        </div>
                        @if ($errors->any())
                            <div class="mb-4">
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger my-2">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        <button class="btn btn-primary" type="submit">Update Size</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
