<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrasi;
use Carbon\Carbon;
use App\Exports\RegistrasiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $registrasi = Registrasi::all();
        return view('report.report', compact('registrasi'));
    }

    public function filter(Request $request)
    {
        $query = Registrasi::query();

        // Filter by tanggal_awal
        if ($request->filled('tanggal_awal')) {
            $tanggalAwal = Carbon::createFromFormat('Y-m-d', $request->input('tanggal_awal'))->format('Y-m-d');
            $query->whereDate('tanggal', '>=', $tanggalAwal);
        }

        // Filter by tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $tanggalAkhir = Carbon::createFromFormat('Y-m-d', $request->input('tanggal_akhir'))->format('Y-m-d');
            $query->whereDate('tanggal', '<=', $tanggalAkhir);
        }

        $registrasi = $query->get();

        return view('report.report', compact('registrasi'));
    }

    public function cetak(Request $request)
    {
        $query = Registrasi::query();

        // Filter by tanggal_awal
        if ($request->filled('tanggal_awal')) {
            $tanggalAwal = Carbon::createFromFormat('Y-m-d', $request->input('tanggal_awal'))->format('Y-m-d');
            $query->whereDate('tanggal', '>=', $tanggalAwal);
        }

        // Filter by tanggal_akhir
        if ($request->filled('tanggal_akhir')) {
            $tanggalAkhir = Carbon::createFromFormat('Y-m-d', $request->input('tanggal_akhir'))->format('Y-m-d');
            $query->whereDate('tanggal', '<=', $tanggalAkhir);
        }

        $registrasi = $query->get();

        $jumlahRegistrasi = $registrasi->count();

        return view('report.cetak', compact('registrasi', 'tanggalAwal', 'tanggalAkhir', 'jumlahRegistrasi'));
    }
}
