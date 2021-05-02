@extends('layouts.admin')
@section('content')
    <div class="section-header">
        <h1>Tambah Produk</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="card-body" method="POST" action="/admin/products/add" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                <option value="1">Baju</option>
                                <option value="2">Celana</option>
                                <option value="3">Hoodie</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto Produk</label><br>
                            <input type="file" name="product_images[]" accept="image/*" multiple
                                onchange="previewImages(event)">
                        </div>

                        <div id="canvas" class='d-flex flex-row flex-wrap mb-4'>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Color Input</label>
                            <div class="col gutters-xs">
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="1" class="mr-2" id='color_1' />
                                    <label class="colorinput" for="color_1">
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="2" class="mr-2" id='color_2' />
                                    <label class="colorinput" for="color_2">
                                        <span class="colorinput-color bg-secondary"></span>
                                    </label>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="3" class="mr-2" id='color_3' />
                                    <label class="colorinput" for="color_3">
                                        <span class="colorinput-color bg-danger"></span>
                                    </label>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="4" class="mr-2" id='color_4' />
                                    <label class="colorinput" for="color_4">
                                        <span class="colorinput-color bg-warning"></span>
                                    </label>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="5" class="mr-2" id='color_5' />
                                    <label class="colorinput" for="color_5">
                                        <span class="colorinput-color bg-info"></span>
                                    </label>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <input name="color" type="radio" value="6" class="mr-2" id='color_6' />
                                    <label class="colorinput" for="color_6">
                                        <span class="colorinput-color bg-success"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Size</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="size" value="1" class="selectgroup-input" checked="">
                                    <span class="selectgroup-button">S</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="size" value="2" class="selectgroup-input">
                                    <span class="selectgroup-button">M</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="size" value="3" class="selectgroup-input">
                                    <span class="selectgroup-button">L</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="size" value="4" class="selectgroup-input">
                                    <span class="selectgroup-button">XL</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Currency</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control currency" name="price">
                            </div>
                        </div>

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="text-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        <button class="btn btn-primary" type="submit">Tambah Produk</button>

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
                let card = `
                                                <div class='card m-2' style = 'width: 20rem;'> 
                                                  <div class='shadow rounded'>
                                                    <img src=${URL.createObjectURL(images[i])} class='w-100'>
                                                    <div class='card-body'>
                                                      <h5 class='card-title text-center text-black'>Gambar ${i+1}</h5>
                                                    </div>
                                                  </div>
                                                </div>      
                                            `
                target.append(card);
            }
            console.log("object")
        }

    </script>
@endsection
