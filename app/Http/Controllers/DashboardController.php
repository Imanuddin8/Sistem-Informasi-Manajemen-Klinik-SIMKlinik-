<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrasi;
use Carbon\Carbon;
use Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $registrasi = Registrasi::orderBy('created_at', 'asc')
                                ->where('status', 'belum masuk')
                                ->get();

        return view('dashboard.dashboard', compact('registrasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $registrasi = Registrasi::findOrFail($id);
        $registrasi->status = $request->status;
        $registrasi->save();

        Alert::toast('Update status pasien berhasil!','success');
        return redirect()->back();
    }
}
