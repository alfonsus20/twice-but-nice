@extends('layouts.app')
@section('content')
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
                                <label>Provinsi</label>
                                <select class="form-select" name="province_id" id="province">
                                    <option value="none">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 my-2">
                                <label>Kota</label>
                                <select class="form-select" name="city_id" id="city">
                                    <option value="none">Pilih Kota</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city_id }}" province="{{ $city->province_id }}">
                                            {{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Kode Pos</label>
                                <input class="form-control" type="text" placeholder="Kode Pos" name="postal_code">
                            </div>
                            <div class="col-md-12">
                                <label>Alamat Lengkap</label>
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
                                <input class="form-control" type="password" placeholder="Konfirmasi Password"
                                    name="password_confirmation">
                            </div>
                            @if ($errors->any())
                                <div class="mb-4">
                                    @foreach ($errors->all() as $error)
                                        <div class="text-danger my-2">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
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
@section('script')
    <script>
        $("#city option").css({
            "display": "none"
        });
        $("#province").change(() => {
            $("#province option").css({
                display: "block"
            });
            let province = $("#province").val();
            console.log(province);
            if (province !== "none") {
                $("#city option").css({
                    "display": "block"
                });
                $("#city option[province!=" + province + "]").css({
                    "display": "none"
                });
            }else{
                $("#city").val("none");
                $("#city option").css({
                    "display": "none"
                });
            }
        })
    </script>
@endsection
