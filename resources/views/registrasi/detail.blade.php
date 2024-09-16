@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h3>Detail Registrasi Pasien</h3>
</div>
<div class="card shadow mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-primary">Registrasi Pasien</h4>
        <a href="{{ url()->previous() }}" class="btn btn-danger btn-icon-split">
            <span class="icon text-white-50">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-6 mb-3">
                <h5 class="text-dark">Data Pasien</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $registrasi->pasien->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td>{{ formatDateOnly($registrasi->pasien->tanggalLahir) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Usia</strong></td>
                                <td>{{ $registrasi->pasien->usia }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>{{ $registrasi->pasien->jenisKelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nomor</strong></td>
                                <td>{{ $registrasi->pasien->no }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $registrasi->pasien->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td class="table-wrap formatted-text">{{ $registrasi->pasien->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <h5 class="text-dark">Registrasi Pasien</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Nama Pasien</strong></td>
                                <td>
                                    {{ $registrasi->pasien->nama }}
                                    <input type="hidden" name="pasien_id" value="{{ $registrasi->pasien_id }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Registrasi</strong></td>
                                <td>{{ formatDateTime($registrasi->tanggal) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Keluhan</strong></td>
                                <td>{{ $registrasi->keluhan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>{{ $registrasi->status }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dokter</strong></td>
                                <td>
                                    {{ $registrasi->user->name ?? 'Dokter tidak ada' }}
                                    <input type="hidden" name="dokter_id" value="{{ $registrasi->dokter_id }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pengimput</strong></td>
                                <td>
                                    {{ $registrasi->staff->name ?? 'Staff tidak ada' }}
                                    <input type="hidden" name="staff_id" value="{{ $registrasi->staff_id }}">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Keterangan</strong></td>
                                <td class="table-wrap formatted-text">{{ $registrasi->keterangan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
