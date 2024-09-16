@foreach ($registrasi as $row)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $row->pasien->nama }}</td>
    <td>{{ formatDateTime($row->tanggal) }}</td>
    <td>{{ $row->keluhan }}</td>
    <td>{{ $row->user->name ?? 'Dokter tidak ada' }}</td>
    <td class="d-flex justify-content-center">
        <a href="{{ route('dokter.create', $row->id) }}" class="btn btn-primary">
            <i class="fa-solid fa-edit"></i>
        </a>
    </td>
</tr>
@endforeach
