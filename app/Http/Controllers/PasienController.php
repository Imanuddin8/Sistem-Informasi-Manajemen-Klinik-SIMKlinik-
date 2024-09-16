<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Registrasi;
use App\Models\User;
use Carbon\Carbon;
use Alert;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::orderBy('created_at', 'desc')->get();
        return view('pasien.pasien', compact('pasien'));
    }

    // Menampilkan form tambah pasien
    public function create()
    {
        $pasien = Pasien::all();
        return view('pasien.create', compact('pasien'));
    }

    // Menyimpan data pasien
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggalLahir' => 'required|date',
            'alamat' => 'nullable|string',
            'no' => 'required|string|min:10|max:13',
            'email' => 'nullable|email',
        ]);

        $tanggalLahir = Carbon::parse($request->tanggalLahir);
        $usiaTahun = $tanggalLahir->diffInYears(Carbon::now()); // Menghitung usia dalam tahun

        if ($usiaTahun >= 1) {
            // Jika usia lebih dari atau sama dengan 1 tahun, tampilkan dalam tahun
            $usia = $usiaTahun . ' tahun';
        } else {
            $usiaBulan = $tanggalLahir->diffInMonths(Carbon::now()); // Menghitung usia dalam bulan
            if ($usiaBulan >= 1) {
                // Jika usia kurang dari 1 tahun tapi lebih dari atau sama dengan 1 bulan, tampilkan dalam bulan
                $usia = $usiaBulan . ' bulan';
            } else {
                $usiaHari = $tanggalLahir->diffInDays(Carbon::now()); // Menghitung usia dalam hari
                // Jika usia kurang dari 1 bulan, tampilkan dalam hari
                $usia = $usiaHari . ' hari';
            }
        }

        // Isi "-" jika alamat atau email kosong
        $alamat = $request->alamat ?: '-';
        $email = $request->email ?: '';

        // Simpan data pasien
        Pasien::create([
            'nama' => $request->nama,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $alamat,
            'no' => $request->no,
            'jenisKelamin' => $request->jenisKelamin,
            'email' => $email,
            'usia' => $usia,
        ]);

        Alert::toast('Data pasien berhasil ditambahkan!','success');
        return redirect()->route('pasien.index');
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
       // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggalLahir' => 'required|date',
            'alamat' => 'nullable|string',
            'no' => 'required|string|min:10|max:13',
            'email' => 'nullable|email',
        ]);

        $tanggalLahir = Carbon::parse($request->tanggalLahir);
        $usiaTahun = $tanggalLahir->diffInYears(Carbon::now()); // Menghitung usia dalam tahun

        if ($usiaTahun >= 1) {
            // Jika usia lebih dari atau sama dengan 1 tahun, tampilkan dalam tahun
            $usia = $usiaTahun . ' tahun';
        } else {
            $usiaBulan = $tanggalLahir->diffInMonths(Carbon::now()); // Menghitung usia dalam bulan
            if ($usiaBulan >= 1) {
                // Jika usia kurang dari 1 tahun tapi lebih dari atau sama dengan 1 bulan, tampilkan dalam bulan
                $usia = $usiaBulan . ' bulan';
            } else {
                $usiaHari = $tanggalLahir->diffInDays(Carbon::now()); // Menghitung usia dalam hari
                // Jika usia kurang dari 1 bulan, tampilkan dalam hari
                $usia = $usiaHari . ' hari';
            }
        }

        // Isi "-" jika alamat atau email kosong
        $alamat = $request->alamat ?: '-';
        $email = $request->email ?: '';

        // Temukan pasien yang akan di-update
        $pasien = Pasien::findOrFail($request->id); // Pastikan ID pasien dikirim dari form

        // Update data pasien
        $pasien->update([
            'nama' => $request->nama,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $alamat,
            'no' => $request->no,
            'jenisKelamin' => $request->jenisKelamin,
            'email' => $email,
            'usia' => $usia,
        ]);

        Alert::toast('Data pasien berhasil diedit!','success');
        return redirect()->route('pasien.index');
    }

    public function delete($id)
    {
        $pasien = Pasien::findOrFail($id);

        $pasien->delete();

        Alert::toast('Data pasien berhasil dihapus!','success');
        return redirect()->route('pasien.index');
    }

    public function detail($id)
    {
        $pasien = Pasien::with('registrasi.user')->findOrFail($id);

        return view('pasien.detail', compact('pasien'));
    }
}
