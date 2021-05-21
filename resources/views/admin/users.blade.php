@extends('layouts.admin')
@section('content')
    <!-- Main Content -->

    <div class="section-header">
        <h1>Daftar Produk</h1>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Foto Profil</th>
                                    <th>Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                @php
                                    $page = (int) request()->get('page');
                                    if ($page < 1) {
                                        $page = 1;
                                    }
                                @endphp
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 + 10 * ($page - 1) }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img style="width:5rem" src="{{ asset('img/users/' . ($user->profile_image ? $user->profile_image : 'no-user.jpg')) }}"
                                                alt="user"></td>
                                        {{-- <td>Admin</td> --}}
                                        <td>
                                            <div
                                                class="badge badge-{{ count($user->getRoleNames()) == 1 ? 'info' : 'secondary' }}">
                                                {{ count($user->getRoleNames()) == 1 ? 'Admin' : 'Member' }}</div>
                                        </td>
                                        <td class="text-center">
                                            @if (count($user->getRoleNames()) == 1)
                                                <a href="/admin/users/{{ $user->id }}/withdrawadmin"
                                                    class="btn btn-danger">JADIKAN MEMBER</a>
                                            @else

                                                <a href="/admin/users/{{ $user->id }}/makeadmin"
                                                    class="btn btn-primary">JADIKAN ADMIN</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
