@extends('layout.main')

@section('konten')
<div class="text-center mb-3">
    <h2>Keluhan Pasien</h2>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-lg-6 mb-3">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="m-0 text-primary">Data Pasien</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{$registrasi->pasien->nama}}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Lahir</strong></td>
                            <td>{{formatDateOnly($registrasi->pasien->tanggalLahir)}}</td>
                        </tr>
                        <tr>
                            <td><strong>Usia</strong></td>
                            <td>{{$registrasi->pasien->usia}}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>{{$registrasi->pasien->jenisKelamin}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor</strong></td>
                            <td>{{$registrasi->pasien->no}}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{$registrasi->pasien->email}}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td class="table-wrap formatted-text">{{$registrasi->pasien->alamat}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-3">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="m-0 text-primary">Keluhan Pasien</h4>
            </div>
            <div class="card-body">
                <form action="{{route('dokter.store', $registrasi->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="keluhan" class="font-weight-bold text-dark">Keluhan</label>
                        <input required type="text" name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" value="{{ $registrasi->keluhan }}" placeholder="Keterangan">
                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5" placeholder="Alamat pasien">{{ $registrasi->keterangan }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('dokter.index')}}" class="btn btn-secondary mr-3">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
