@extends('layout.main')

@section('konten')
<div class="text-center mb-3">
    <h2>Tambah Data Pasien</h2>
</div>
<div class="row justify-content-center mb-3">
    <div class="col-12 col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('pasien.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <label for="nama" class="font-weight-bold text-dark">Nama</label>
                            <input required type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Nama pasien">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="tanggalLahir" class="font-weight-bold text-dark">Tanggal Lahir</label>
                            <input required type="date" class="form-control @error('tanggalLahir') is-invalid @enderror" name="tanggalLahir" id="tanggalLahir" value="{{ old('tanggalLahir') }}">
                            @error('tanggalLahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="jenisKelamin" class="font-weight-bold text-dark">Jenis Kelamin</label>
                            <select required name="jenisKelamin" id="jenisKelamin" class="form-control @error('jenisKelamin') is-invalid @enderror">
                                <option disabled selected>Pilih jenis kelamin</option>
                                <option value="laki-laki" {{ old('jenisKelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('jenisKelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenisKelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="no" class="font-weight-bold text-dark">Nomor</label>
                            <input required name="no" type="text" class="form-control @error('no') is-invalid @enderror" placeholder="Nomor HP pasien" value="{{ old('no') }}" required>
                            @error('no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="email" class="font-weight-bold text-dark">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Email pasien">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="font-weight-bold text-dark">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="5" placeholder="Alamat pasien">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('pasien.index')}}" class="btn btn-secondary mr-3">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
