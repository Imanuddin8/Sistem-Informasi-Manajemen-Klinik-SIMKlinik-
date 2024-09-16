@extends('layout.main')

@section('konten')
<div class="text-center mb-3">
    <h2>Edit Registrasi Pasien</h2>
</div>
<div class="row justify-content-center mb-3">
    <div class="col-12 col-lg-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{route('registrasi.update', $registrasi->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-12 col-lg-6 mb-3">
                            <label for="pasien_id" class="font-weight-bold text-dark">Pasien</label>
                            <select required name="pasien_id" id="pasien_id" class="form-control @error('pasien_id') is-invalid @enderror">
                                <option selected disabled>Pilih pasien</option>
                                @foreach($pasien as $p)
                                    <option value="{{ $p->id }}" {{ $registrasi->pasien_id == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                                @endforeach
                            </select>
                            @error('pasien_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="dokter_id" class="font-weight-bold text-dark">Dokter</label>
                            <select required name="dokter_id" id="dokter_id" class="form-control @error('dokter_id') is-invalid @enderror">
                                <option selected disabled>Pilih Dokter</option>
                                @foreach($user as $p)
                                    <option value="{{ $p->id }}" {{ $registrasi->dokter_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('dokter_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="tanggal" class="font-weight-bold text-dark">Tanggal</label>
                            <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{$registrasi->tanggal}}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label for="keluhan" class="font-weight-bold text-dark">Keluhan</label>
                            <input required type="text" name="keluhan" id="keluhan" class="form-control @error('keluhan') is-invalid @enderror" value="{{ $registrasi->keluhan }}" placeholder="Keterangan">
                            @error('keluhan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5" placeholder="Alamat pasien">{{ $registrasi->keterangan }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('registrasi.index')}}" class="btn btn-secondary mr-3">Batal</a>
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
