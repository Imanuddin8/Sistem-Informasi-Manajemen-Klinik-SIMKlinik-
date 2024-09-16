@extends('layout.main')

@section('konten')
<div class="text-center mb-3">
    <h2>Tambah Registrasi Pasien</h2>
</div>
<form action="{{route('registrasi.storePasien')}}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4 class="text-dark text-center">Data Pasien</h4>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nama" class="font-weight-bold text-dark">Nama</label>
                            <input required type="text" class="form-control @error('pasien_nama') is-invalid @enderror" name="pasien_nama" id="pasien_nama" value="{{ old('pasien_nama') }}" placeholder="Nama pasien">
                            @error('pasien_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="tanggalLahir" class="font-weight-bold text-dark">Tanggal Lahir</label>
                            <input required type="date" class="form-control @error('pasien_tanggalLahir') is-invalid @enderror" name="pasien_tanggalLahir" id="pasien_tanggalLahir" value="{{ old('pasien_tanggalLahir') }}">
                            @error('pasien_tanggalLahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="jenisKelamin" class="font-weight-bold text-dark">Jenis Kelamin</label>
                            <select required name="pasien_jenisKelamin" id="pasien_jenisKelamin" class="form-control @error('pasien_jenisKelamin') is-invalid @enderror">
                                <option disabled selected>Pilih jenis kelamin</option>
                                <option value="laki-laki" {{ old('pasien_jenisKelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="perempuan" {{ old('pasien_jenisKelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('pasien_jenisKelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="no" class="font-weight-bold text-dark">Nomor</label>
                            <input required name="pasien_no" type="text" class="form-control @error('pasien_no') is-invalid @enderror" placeholder="Nomor HP pasien" value="{{ old('pasien_no') }}" required>
                            @error('pasien_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="email" class="font-weight-bold text-dark">Email</label>
                            <input type="email" class="form-control @error('pasien_email') is-invalid @enderror" name="pasien_email" id="pasien_email" value="{{ old('pasien_email') }}" placeholder="Email pasien">
                            @error('pasien_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="font-weight-bold text-dark">Alamat</label>
                            <textarea class="form-control @error('pasien_alamat') is-invalid @enderror" name="pasien_alamat" id="pasien_alamat" rows="5" placeholder="Alamat pasien">{{ old('pasien_alamat') }}</textarea>
                            @error('pasien_alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div>
                        <h4 class="text-dark text-center">Registrasi Pasien</h4>
                    </div>
                    <div class="mb-3">
                        <label for="dokter_id" class="font-weight-bold text-dark">Dokter</label>
                        <select required name="dokter_id" id="dokter_id" class="form-control @error('dokter_id') is-invalid @enderror">
                            <option selected disabled>Pilih Dokter</option>
                            @foreach($user as $p)
                                <option value="{{ $p->id }}" {{ old('dokter_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('dokter_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="font-weight-bold text-dark">Keluhan</label>
                        <input required type="text" name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" value="{{ old('keluhan') }}" placeholder="Keluhan pasien">
                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5" placeholder="Keterangan registrasi">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('registrasi.index')}}" class="btn btn-secondary mr-3">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
</form>
@endsection
