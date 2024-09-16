@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Laporan</h1>
    <p>Laporan pasien di Klinik MAN Lumajang</p>
</div>
<div class="mb-3">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="m-0 text-primary">Laporan Pasien</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.filter') }}" method="GET">
                <div class="row mb-3 justify-content-start align-items-center">
                    <div class="col-12 col-lg-auto mb-1">
                        <span>Tanggal</span>
                    </div>
                    <div class="col-4 col-lg-3 mb-2">
                        <input title="Tanggal awal" type="date" class="form-control" name="tanggal_awal" required>
                    </div>
                    -
                    <div class="col-4 col-lg-3">
                        <input title="Tanggal akhir" type="date" class="form-control" name="tanggal_akhir" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('laporan.index') }}" class="btn btn-primary">
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </a>
                    </div>
                </div>
            </form>
            <div class="mb-3">
                <a href="{{ route('laporan.cetak', request()->query()) }}" target="_blank" class="btn btn-primary btn-icon-split mb-1">
                    <span class="icon text-white-50">
                        <i class="fa-solid fa-file-pdf"></i>
                    </span>
                    <span class="text">Cetak PDF</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrasi as $row)
                            <tr>
                                <td>{{ $row->pasien->nama }}</td>
                                <td>{{ formatDateTime($row->tanggal) }}</td>
                                <td>{{ $row->keluhan }}</td>
                                <td>{{ $row->user->name ?? 'Dokter tidak ada' }}</td>
                                <td>{{ $row->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
