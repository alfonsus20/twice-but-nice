<div class="row">
    <div class="col-lg-4 sidebar">
        <div class="sidebar-widget brands">
            <div class="row">
                <div class="col-md-12 position-relative" style="padding : 0">
                    @if (Request::get('category'))
                        <input type="hidden" name="category" value="{{ Request::get('category') }}">
                    @endif
                    <label class="form-label">Masukkan kata kunci</label>
                    <input type="text" class="form-control" wire:model='keyword' name="keyword"
                        placeholder="Cari produk ..." onchange="setURL(event.target.value)"
                        value="{{ Request::get('keyword') }}" style="padding-right: 34px">
                    @if (Request::get('sort'))
                        <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
                    @endif
                    <button id="searchByKeyword" wire:click="filter"
                        class="btn d-flex align-items-center justify-content-center"
                        style="background-color : #897853;color : white;text-decoration : none;"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
            <h2 class="title">Kategori</h2>
            <nav class="navbar">
                <ul class="navbar-nav w-100">
                    <div class="row" id="form-category">
                        @foreach ($categories as $category)
                            <li
                                class="nav-item  col-lg-4 col-md-6 col-sm-12 {{ Request::get('category') == $category->id ? 'active-query' : '' }}">
                                <input type="radio" name="category" wire:model='category' value="{{ $category->id }}"
                                    id="{{ $category->category_name }}" style="display: none;">
                                <label for="{{ $category->category_name }}">{{ $category->category_name }}</label>
                            </li>
                        @endforeach
                        <li
                            class="nav-item  col-lg-4 col-md-6 col-sm-12 {{ Request::get('category') == 'pria' ? 'active-query' : '' }}">
                            <input type="radio" name="category" wire:model='category' value="pria" id="pria"
                                style="display: none;">
                            <label for="pria">Pria</label>
                        </li>
                        <li
                            class="nav-item col-lg-4 col-md-6 col-sm-12 {{ Request::get('category') == 'wanita' ? 'active-query' : '' }}">
                            <input type="radio" name="category" wire:model='category' value="wanita" id="wanita"
                                style="display: none;">
                            <label for="wanita">Wanita</label>
                        </li>
                    </div>
                </ul>
            </nav>
        </div>

        <div class="pb-4">
            <div class="sidebar-widget brands" style="padding-top: 0">
                <h2 class="title">Harga</h2>
                <div class="row w-100 px-3">
                    <input type="text" class="col-md-5" value="{{ Request::get('min_price') }}" name="min_price"
                        id="" wire:model = 'min_price' placeholder="MIN">
                    <div class="col-md-2 text-center"> - </div>
                    <input type="text" class="col-md-5" value="{{ Request::get('max_price') }}" name="max_price"
                        id="" wire:model = 'max_price' placeholder="MAX">
                </div>
            </div>

            <div class="sidebar-widget brands">
                <h2 class="title">Kualitas</h2>
                <div class="row w-100 px-3">
                    <input type="text" class="col-md-5" value="{{ Request::get('min_quality') }}" name="min_quality"
                        id="" wire:model='min_quality' placeholder="MIN">
                    <div class="col-md-2 text-center"> - </div>
                    <input type="text" class="col-md-5" value="{{ Request::get('max_quality') }}" name="max_quality"
                        id="" wire:model='max_quality' placeholder="MAX">
                </div>
            </div>

            @if (Request::get('category'))
                <input type="hidden" name="category" value="{{ Request::get('category') }}">
            @endif
            @if (Request::get('sort'))
                <input type="hidden" name="sort" value="{{ Request::get('sort') }}">
            @endif
            @if (Request::get('keyword'))
                <input type="hidden" name="keyword" value="{{ Request::get('keyword') }}">
            @endif
        </div>
        <div class="sidebar-widget brands pt-4">
            <h2 class="title">Brand</h2>
            <ul class="navbar-nav">
                <div class="row">
                    @foreach ($brands as $brand)
                        <li
                            class="nav-item col-lg-4 col-md-6 col-sm-12 {{ Request::get('brand') == $brand->brand ? 'active-query' : '' }}">
                            <input type="radio" name="brand" wire:model='brand' value="{{ $brand->brand }}"
                                id="{{ $brand->brand }}" style="display: none;">
                            <label for="{{ $brand->brand }}">{{ $brand->brand }}</label>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-md-12">
                <div class="product-view-top">
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center">
                            <label for="" class="form-label">Urut Berdasarkan</label>
                        </div>
                        <div class="col-md-3">
                            <select class="btn dropdown-toggle w-100" wire:model='sort' class="dropdown-menu"
                                style="background-color: #fff; color : #897853;">
                                <option class="dropdown-item" value="none"> Tidak ada </option>
                                <option class="dropdown-item" value="newest" wire:click="sort('newest')">Paling baru
                                </option>
                                <option class="dropdown-item" value="oldest" wire:click="sort('oldest')">Paling lama
                                </option>
                                <option class="dropdown-item" value="lowestPrice" wire:click="sort('lowestPrice')">
                                    Paling murah</option>
                                <option class="dropdown-item" value="highestPrice" wire:click="sort('highestPrice')">
                                    Paling mahal</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center">
                            Menampilkan {{ $products->count() }} hasil
                        </div>
                    </div>
                </div>
            </div>
            @forelse ($products as $product)
                @include('components.product-card')
            @empty
                <h3 class="text-center my-4">Produk tidak ditemukan</h3>
            @endforelse
        </div>
        <div class="col-md-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
