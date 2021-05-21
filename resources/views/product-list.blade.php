@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid">
            @livewire('product-list')
        </div>
    </div>
    <!-- Product List End -->
    @include('components.toast')
@endsection
@include('script.toast')