<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Registrasi Pasien</title>

    {{-- css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h2 class="mt-4 text-center mb-5">Laporan Registrasi Pasien</h2>
        <table class="mb-3">
            <tr>
                <td>Tanggal</td>
                <td>: {{formatDateOnly($tanggalAwal)}} - {{formatDateOnly($tanggalAkhir)}}</td>
            </tr>
            <tr>
                <td>Jumlah registrasi pasien</td>
                <td>: {{$jumlahRegistrasi}}</td>
            </tr>
        </table>
        <div>
            <div
                class="row"
            >
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
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
                                    <td>{{$loop->iteration}}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
