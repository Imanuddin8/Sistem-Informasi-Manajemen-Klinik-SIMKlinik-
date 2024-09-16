@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Dashboard</h1>
    <p>Selamat Datang {{auth()->user()->name}}, Anda login sebagai {{auth()->user()->role}}</p>
</div>
<div class="mb-3">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="m-0 text-primary">Registrasi Pasien</h4>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="registrasi-tbody">
                        @foreach ($registrasi as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $row->pasien->nama }}</td>
                                <td>{{ formatDateTime($row->tanggal) }}</td>
                                <td>{{ $row->keluhan }}</td>
                                <td>{{ $row->user->name ?? 'Dokter tidak ada' }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('dokter.create', $row->id)}}" class="btn btn btn-primary">
                                        <i class="fa-solid fa-edit"></i>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Fungsi untuk memuat data registrasi
        function loadRegistrasi() {
            $.ajax({
                url: '{{ route("registrasi.index") }}', // Route untuk mengambil data registrasi
                method: 'GET',
                success: function(data) {
                    $('#registrasi-tbody').html(data); // Memuat data ke dalam tbody
                },
                error: function(xhr, status, error) {
                    console.log(error); // Jika ada error
                }
            });
        }

        // Memuat data setiap 5 detik (5000 ms)
        setInterval(loadRegistrasi, 5000);

        // Muat data pertama kali
        loadRegistrasi();
    });
</script>
@endsection
