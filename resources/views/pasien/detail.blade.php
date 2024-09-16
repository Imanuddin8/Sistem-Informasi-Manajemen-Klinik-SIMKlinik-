@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h3>Detail Data Pasien</h3>
</div>
<div class="card shadow mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-primary">Detail Pasien</h4>
        <a href="{{route('pasien.index')}}" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <div
            class="row justify-content-between"
        >
            <div class="col-12 col-lg-5 mb-2">
                <h5>Biodata Pasien</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{$pasien->nama}}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Lahir</strong></td>
                            <td>{{formatDateOnly($pasien->tanggalLahir)}}</td>
                        </tr>
                        <tr>
                            <td><strong>Usia</strong></td>
                            <td>{{$pasien->usia}}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>{{$pasien->jenisKelamin}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor</strong></td>
                            <td>{{$pasien->no}}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{$pasien->email}}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td class="table-wrap formatted-text">{{$pasien->alamat}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <h5>Riwayat Registrasi</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keluhan</th>
                                <th>Dokter</th>
                                <th>status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien->registrasi as $row)
                                <tr>
                                    <td>{{ $row->pasien->nama }}</td>
                                    <td>{{ formatDateTime($row->tanggal) }}</td>
                                    <td>{{ $row->keluhan }}</td>
                                    <td>{{ $row->user->name ?? 'Dokter tidak ada' }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        <a href="{{route('registrasi.detail', $row->id)}}" class="btn btn btn-info px-3">
                                            <i class="fa-solid fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
