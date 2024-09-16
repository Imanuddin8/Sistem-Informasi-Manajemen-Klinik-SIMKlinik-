@extends('layout.main')

@section('konten')
<div class="mb-4">
    <h1 class="h2 mb-0 text-gray-800 mb-1">Dashboard</h1>
    <p>Selamat Datang {{auth()->user()->name}}, anda login sebagai {{auth()->user()->role}}</p>
    <p class="mb-1">Klik Tambah untuk menambah user!!</p>
    <div class="mb-2">
        <a href="{{route('admin.create')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
    </div>
</div>
<div class="mb-3">
    <div class="card shadow mb-3">
        <div class="card-header">
            <h4 class="m-0 text-primary">Daftar User Staff</h4>
        </div>
        <div class="card-body">
            <div class="">
                <h5 class="text-dark">User Staff</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableStaff" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userStaff as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->no }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{route('admin.edit', $row->id)}}" class="btn btn btn-warning mr-2">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModalStaff" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Delete Modal-->
                                <div class="modal fade" id="deleteModalStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Pilih "Hapus" di bawah jika Anda siap untuk menghapus user.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form action="{{route('admin.delete', $row->id)}}" method="POST">
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
    <div class="card shadow mb-3">
        <div class="card-header">
            <h4 class="m-0 text-primary">Daftar User Dokter</h4>
        </div>
        <div class="card-body">
            <div>
                <h5 class="text-dark">User Dokter</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableDokter" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userDokter as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->no }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{route('admin.edit', $row->id)}}" class="btn btn btn-warning mr-2">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModalDokter" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Delete Modal-->
                                <div class="modal fade" id="deleteModalDokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Pilih "Hapus" di bawah jika Anda siap untuk menghapus user.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form action="{{route('admin.delete', $row->id)}}" method="POST">
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
    <div class="card shadow mb-3">
        <div class="card-header">
            <h4 class="m-0 text-primary">Daftar User Admin</h4>
        </div>
        <div class="card-body">
            <div>
                <h5 class="text-dark">User Admin</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableAdmin" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userAdmin as $row)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->no }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{route('admin.edit', $row->id)}}" class="btn btn btn-warning mr-2">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteModalAdmin" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <!-- Delete Modal-->
                                <div class="modal fade" id="deleteModalAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapus?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Pilih "Hapus" di bawah jika Anda siap untuk menghapus user.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form action="{{route('admin.delete', $row->id)}}" method="POST">
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
</div>
@endsection
