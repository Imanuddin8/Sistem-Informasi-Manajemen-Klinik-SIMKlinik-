@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Profile</h1>
</div>
<div class="card shadow mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-primary">Setting Profile</h4>
        <a href="{{url()->previous()}}" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: {{$user->name}}</td>
                </tr>
            </table>
        </div>
        <div>
            <div
                class="row justify-content-start align-items-center"
            >
                <div class="col-12 col-lg-6 border border-primary rounded-lg p-3">
                    <span class="text-dark mb-2">Edit Email dan Password</span>
                    <form action="{{ route('profil.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label class="text-dark" for="name">Nama</label>
                            <input type="name" id="name" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="text-dark" for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <p class="mb-0 text-danger">Biarkan kosong jika Anda tidak ingin mengubah kata sandi.</p>
                            <label class="text-dark" for="password">Password Baru</label>
                            <input placeholder="Password baru" type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-dark" for="password_confirmation">Konfirmasi Password Baru</label>
                            <input placeholder="Konfirmasi password baru" type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
