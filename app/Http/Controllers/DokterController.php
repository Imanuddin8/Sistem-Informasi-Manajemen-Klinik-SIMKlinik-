<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Registrasi;
use App\Models\Pasien;
use Carbon\Carbon;
use Alert;

class DokterController extends Controller
{
    public function index()
    {
        $registrasi = Registrasi::where('status', 'sudah masuk')->get();
        $pasien = Pasien::all();
        $user = User::all();

        if (request()->ajax()) {
            return view('partials._registrasi_table', compact('registrasi'))->render();
        }

        return view('dokter.dokter', compact('registrasi', 'pasien', 'user'));
    }
    public function create($id)
    {
        $registrasi = Registrasi::findOrFail($id);

        return view('dokter.create', compact('registrasi'));
    }

    public function store(Request $request, $id)
    {
        $registrasi = Registrasi::findOrFail($id);

        $request->validate([
            'keterangan' => 'nullable|string',
            'keluhan' => 'required|string',
        ]);

        $keterangan = $request->keterangan ?: '-';

        $registrasi->update([
            'dokter_id' => $registrasi->dokter_id,  // Menggunakan nilai yang sudah ada di database
            'pasien_id' => $registrasi->pasien_id,  // Menggunakan nilai yang sudah ada di database
            'keluhan' => $request->keluhan,
            'keterangan' => $keterangan,
            'status' => 'sudah diperiksa',
            'tanggal' => $registrasi->tanggal,  // Menggunakan nilai yang sudah ada di database
        ]);

        Alert::toast('Registrasi pasien diperbarui!', 'success');
        return redirect()->route('dokter.index');
    }
}
