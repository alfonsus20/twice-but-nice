@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">Register</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form class="login" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 mx-auto">
                    <div class="register-form">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nama</label>
                                <input class="form-control" type="text" placeholder="Nama" name="name">
                            </div>
                            <div class="col-md-12">
                                <label>E-mail</label>
                                <input class="form-control" type="email" placeholder="E-mail" name="email">
                            </div>
                            <div class="col-md-12">
                                <label>Nomor Telepon</label>
                                <input class="form-control" type="tel" placeholder="Nomor Telepon" name="telephone">
                            </div>
                            <div class="col-md-12">
                                <label>Alamat</label>
                                <input class="form-control" type="text" placeholder="Alamat" name="address">
                            </div>
                            <div class="col-md-12">
                                <label>Tanggal Lahir</label>
                                <input class="form-control" type="date" placeholder="Tanggal Lahir" name="birth_date">
                            </div>
                            <div class="col-md-12">
                                <label>Password</label>
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="col-md-12">
                                <label>Konfirmasi Password</label>
                                <input class="form-control" type="password" placeholder="Konfirmasi Password" name="password_confirmation">
                            </div>
                            <div class="col-md-12">
                                <button class="btn" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
