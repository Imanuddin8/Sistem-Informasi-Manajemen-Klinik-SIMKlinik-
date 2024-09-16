<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Registrasi;
use App\Models\User;
use Carbon\Carbon;
use Alert;


class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasi = Registrasi::orderBy('created_at', 'desc')->get();
        $pasien = Pasien::all();
        $user = User::all();

        return view('registrasi.registrasi', compact('registrasi', 'pasien', 'user'));
    }

    public function create()
    {
        $pasien = Pasien::all();
        $user = User::where('role', 'dokter')->get();

        return view('registrasi.create', compact('pasien', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:users,id',
            'keterangan' => 'nullable|string',
            'keluhan' => 'required|string',
        ]);

        $keterangan = $request->keterangan?:'-';

        Registrasi::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'keterangan' => $keterangan,
            'tanggal' => Carbon::now(),
            'staff_id' => Auth::id(),
            'status' => 'belum masuk'
        ]);

        Alert::toast('registrasi pasien berhasil ditambahkan!','success');
        return redirect()->route('registrasi.index');
    }

    public function edit($id)
    {
        $registrasi = Registrasi::findOrFail($id);
        $pasien = Pasien::all();
        $user = User::where('role', 'dokter')->get();

        return view('registrasi.edit', compact('pasien', 'user', 'registrasi'));
    }

    public function update(Request $request, $id)
    {
        $registrasi = Registrasi::findOrFail($id);

        $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'dokter_id' => 'required|exists:users,id',
            'keterangan' => 'nullable|string',
            'keluhan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $keterangan = $request->keterangan?:'-';

        $registrasi->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'keterangan' => $keterangan,
            'staff_id' => Auth::id(),
            'tanggal' => $request->tanggal
        ]);

        Alert::toast('registrasi pasien berhasil diedit!','success');
        return redirect()->route('registrasi.index');
    }

    public function delete($id)
    {
        $registrasi = Registrasi::findOrFail($id);

        $registrasi->delete();

        Alert::toast('registrasi pasien berhasil dihapus!','success');
        return redirect()->route('registrasi.index');
    }

    public function detail($id)
    {
        $registrasi = Registrasi::findOrFail($id);
        $pasien = Pasien::all();
        $user = User::all();

        return view('registrasi.detail', compact('pasien', 'user', 'registrasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $registrasi = Registrasi::findOrFail($id);
        $registrasi->status = $request->status;
        $registrasi->save();

        Alert::toast('Update status pasien berhasil!','success');
        return redirect()->back();
    }

    public function createPasien()
    {
        $user = User::where('role', 'dokter')->get();

        return view('registrasi.createPasien', compact('user'));
    }

    public function storePasien(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'pasien_nama' => 'required|string|max:255',
            'pasien_tanggalLahir' => 'required|date',
            'pasien_no' => 'required|string|max:15',
            'pasien_email' => 'nullable|email|max:255',
            'pasien_alamat' => 'nullable|string|max:255',
            'dokter_id' => 'required|exists:users,id',
            'keterangan' => 'nullable|string',
            'keluhan' => 'required|string',
        ]);

        $pasien_tanggalLahir = Carbon::parse($request->pasien_tanggalLahir);
        $usiaTahun = $pasien_tanggalLahir->diffInYears(Carbon::now()); // Menghitung usia dalam tahun

        if ($usiaTahun >= 1) {
            // Jika usia lebih dari atau sama dengan 1 tahun, tampilkan dalam tahun
            $usia = $usiaTahun . ' tahun';
        } else {
            $usiaBulan = $pasien_tanggalLahir->diffInMonths(Carbon::now()); // Menghitung usia dalam bulan
            if ($usiaBulan >= 1) {
                // Jika usia kurang dari 1 tahun tapi lebih dari atau sama dengan 1 bulan, tampilkan dalam bulan
                $usia = $usiaBulan . ' bulan';
            } else {
                $usiaHari = $pasien_tanggalLahir->diffInDays(Carbon::now()); // Menghitung usia dalam hari
                // Jika usia kurang dari 1 bulan, tampilkan dalam hari
                $usia = $usiaHari . ' hari';
            }
        }

        // Isi "-" jika alamat atau email kosong
        $alamat = $request->pasien_alamat ?: '-';
        $email = $request->pasien_email ?: '';

        // Create a new Pasien entry
        $pasien = Pasien::create([
            'nama' => $request->pasien_nama,
            'tanggalLahir' => $request->pasien_tanggalLahir,
            'jenisKelamin' => $request->pasien_jenisKelamin,
            'no' => $request->pasien_no,
            'email' => $email,
            'alamat' => $alamat,
            'usia' => $usia,
        ]);

        // Set default value for keterangan if not provided
        $keterangan = $request->keterangan ?: '-';

        // Create a new Registrasi entry
        Registrasi::create([
            'pasien_id' => $pasien->id, // Use the newly created Pasien's ID
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'keterangan' => $keterangan,
            'staff_id' => Auth::id(),
            'tanggal' => Carbon::now(),
            'status' => 'belum masuk'
        ]);

        Alert::toast('Registrasi dan data pasien berhasil ditambahkan!','success');
        return redirect()->route('registrasi.index');
    }
}
