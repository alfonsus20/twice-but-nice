@extends('layouts.admin')
@section('content')
    <div class="section-header">
        <h1>Edit Produk</h1>
    </div>
    @include('components.message')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="card-body" method="POST" action="/admin/products/{{ $product->id }}/editpicture"
                        enctype="multipart/form-data">
                        @csrf
                        <label>Foto Produk</label>
                        <div id="canvas" class='d-flex flex-row flex-wrap mb-4'>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($images as $image)
                                <div class='card m-2' style='width: 20rem;'>
                                    <div class='shadow rounded'>
                                        <img src="{{ asset('img/products') . '/' . $image->path }}" class='w-100'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-center text-black'>Foto {{ $i }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $i += 1;
                                @endphp
                            @endforeach
                        </div>
                        <div class="form-group">
                            <input type="file" name="product_images[]" accept="image/*" multiple
                                onchange="previewImages(event)">
                        </div>
                        @error('product_images.*')
                            <div class="mt-2 mb-4 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <button class="btn btn-primary" type="submit">Update Foto</button>
                    </form>
                </div>
                <div class="card">
                    <form class="card-body" method="POST" action="/admin/products/{{ $product->id }}/edit"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label>Brand Produk</label>
                            <input type="text" class="form-control" name="brand"
                                value="{{ $product->brand }}">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $product->description }}">
                        </div>
                        <div class="form-group">
                            <label>Sex</label>
                            <select class="form-control" name="sex">
                                <option value="0" {{ $product->sex == 0 || $product->sex == '0' ? 'selected = selected' : '' }}>
                                    Wanita
                                </option>
                                <option value="1" {{ $product->sex == 1 || $product->sex == '1'? 'selected = selected' : '' }}>
                                    Pria
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}
                                        {{ $product->category_id == $category->id ? 'selected = selected' : '' }}>
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Size</label>
                            <div class="selectgroup w-100">
                                @foreach ($sizes as $size)
                                    <label class="selectgroup-item">
                                        <input type="radio" name="size" value="{{ $size->id }}"
                                            class="selectgroup-input"
                                            {{ $product->size_id == $size->id ? 'checked = checked' : '' }}>
                                        <span class="selectgroup-button">{{ $size->size_name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Berat (dalam gram)</label>
                            <div class="input-group">
                                <input type="number" class="form-control currency" name="weight" value="{{$product->weight}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kualitas (skala 10)</label>
                            <div class="input-group">
                                <input type="number" class="form-control currency" name="quality" value="{{$product->quality}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control currency" name="price"
                                    value="{{ $product->price }}">
                            </div>
                        </div>

                        {{-- @if ($errors->any())
                            <div class="mb-4">
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger my-2">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif --}}

                        <button class="btn btn-primary" type="submit">Update Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let previewImages = (e) => {
            let target = $("#canvas");
            target.empty();
            let images = e.target.files;
            for (let i = 0; i < images.length; i++) {
                let card = `<div class='card m-2' style = 'width: 20rem;'> 
                                                                <div class='shadow rounded'>
                                                                  <img src=${URL.createObjectURL(images[i])} class='w-100'>
                                                                    <div class='card-body'>
                                                                        <h5 class='card-title text-center text-black'>Gambar ${i+1}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>`
                target.append(card);
            }
        }

    </script>
@endsection
