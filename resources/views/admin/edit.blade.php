@extends('layout.main')

@section('konten')
<div class="text-center mb-3">
    <h2>Edit User</h2>
</div>
<div class="row justify-content-center mb-3">
    <div class="col-12 col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('admin.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <label for="name" class="font-weight-bold text-dark">Nama</label>
                            <input required type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Nama user">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="no" class="font-weight-bold text-dark">Nomor</label>
                            <input required name="no" type="text" class="form-control @error('no') is-invalid @enderror" placeholder="Nomor HP user" value="{{ old('no', $user->no) }}">
                            @error('no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="email" class="font-weight-bold text-dark">Email</label>
                            <input required type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Email user">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="password" class="font-weight-bold text-dark">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span>Kosongi jika ingin password tetap</span>
                        </div>
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="password_confirmation" class="font-weight-bold text-dark">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="role" class="font-weight-bold text-dark">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option disabled {{ old('role', $user->role) ? '' : 'selected' }}>Pilih Role User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="dokter" {{ old('role', $user->role) == 'dokter' ? 'selected' : '' }}>Dokter</option>
                                <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary mr-3">Batal</a>
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
