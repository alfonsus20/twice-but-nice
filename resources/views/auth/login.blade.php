@extends('layouts.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">Login</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Start -->
    <form class="login" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 mx-auto">
                    <div class="login-form">
                        <div class="row">
                            <div class="col-md-12">
                                <label>E-mail</label>
                                <input class="form-control" type="email" name="email" placeholder="E-mail / Username">
                            </div>
                            <div class="col-md-12">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="newaccount">
                                    <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="mb-4">
                                    @foreach ($errors->all() as $error)
                                        <div class="text-danger my-2">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="col-md-12">
                                <button class="btn" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
