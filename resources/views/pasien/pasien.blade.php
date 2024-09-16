@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Pasien</h1>
    <p>Daftar pasien-pasien di Klinik MAN Lumajang</p>
</div>
<div class="mb-3">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="m-0 text-primary">Daftar Pasien</h4>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <a href="{{route('pasien.create')}}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasien as $row)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ formatDateOnly($row->tanggalLahir) }}</td>
                                <td>{{ $row->no }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('pasien.edit', $row->id)}}" class="btn btn btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteModalPasien" class="btn btn-danger mx-3">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <a href="{{route('pasien.detail', $row->id)}}" class="btn btn btn-info px-3">
                                        <i class="fa-solid fa-info"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteModalPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Pilih "Hapus" di bawah jika Anda siap untuk menghapus data pasien.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <form action="{{route('pasien.delete', $row->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
