@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Antrian</h1>
    <p>Selamat Datang {{auth()->user()->name}}, Anda login sebagai {{auth()->user()->role}}</p>
</div>
<div class="mb-3">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="m-0 text-primary">Antrian Pasien</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Keluhan</th>
                            <th>Dokter</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrasi as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $row->pasien->nama }}</td>
                                <td>{{ formatDateTime($row->tanggal) }}</td>
                                <td>{{ $row->keluhan }}</td>
                                <td>{{ $row->dokter->name ?? 'Dokter tidak ada' }}</td>
                                <td>
                                    <form action="{{ route('dashboard.updateStatus', $row->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="form-control">
                                            <option value="belum masuk" {{ $row->status == 'belum masuk' ? 'selected' : '' }}>Belum Masuk</option>
                                            <option value="sudah masuk" {{ $row->status == 'sudah masuk' ? 'selected' : '' }}>Sudah Masuk</option>
                                            <option value="batal" {{ $row->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
