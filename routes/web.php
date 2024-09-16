<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Ambil pengguna yang sedang login
    $user = Auth::user();

    // Periksa peran pengguna dan arahkan ke halaman yang sesuai
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.index'); // Ganti dengan route yang sesuai untuk admin
        case 'dokter':
            return redirect()->route('dokter.index'); // Ganti dengan route yang sesuai untuk dokter
        case 'staff':
            return redirect()->route('dashboard.index'); // Ganti dengan route yang sesuai untuk staff
        default:
            return redirect()->route('login'); // Atau halaman default jika peran tidak dikenali
    }
});


Route::middleware(['auth', 'verified', 'role:staff'])->group(function() {
    Route::GET('/staff/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/staff/{id}/update-status', [DashboardController::class, 'updateStatus'])->name('dashboard.updateStatus');

    Route::GET('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi.index');
    Route::GET('/registrasi/create', [RegistrasiController::class, 'create'])->name('registrasi.create');
    Route::GET('/registrasi/create/pasien', [RegistrasiController::class, 'createPasien'])->name('registrasi.createPasien');
    Route::POST('/registrasi/store', [RegistrasiController::class, 'store'])->name('registrasi.store');
    Route::POST('/registrasi/store/pasien', [RegistrasiController::class, 'storePasien'])->name('registrasi.storePasien');
    Route::GET('/registrasi/edit/{id}', [RegistrasiController::class, 'edit'])->name('registrasi.edit');
    Route::PUT('/registrasi/update/{id}', [RegistrasiController::class, 'update'])->name('registrasi.update');
    Route::DELETE('/registrasi/delete/{id}', [RegistrasiController::class, 'delete'])->name('registrasi.delete');
    Route::GET('/registrasi/detail/{id}', [RegistrasiController::class, 'detail'])->name('registrasi.detail');
    Route::post('/registrasi/{id}/update-status', [RegistrasiController::class, 'updateStatus'])->name('registrasi.updateStatus');

    Route::GET('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::GET('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::POST('/pasien/store', [PasienController::class, 'store'])->name('pasien.store');
    Route::GET('/pasien/edit/{id}', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::PUT('/pasien/update/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::DELETE('/pasien/delete/{id}', [PasienController::class, 'delete'])->name('pasien.delete');
    Route::GET('/pasien/detail/{id}', [PasienController::class, 'detail'])->name('pasien.detail');
});

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::GET('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::GET('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::POST('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::GET('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::PUT('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::DELETE('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
});

Route::middleware(['auth', 'role:dokter'])->group(function() {
    Route::GET('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.index');
    Route::GET('/dokter/create/{id}', [DokterController::class, 'create'])->name('dokter.create');
    Route::PUT('/dokter/store/{id}', [DokterController::class, 'store'])->name('dokter.store');
});

Route::middleware(['auth', 'role:admin,staff'])->group(function() {
    Route::GET('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::GET('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::GET('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

Route::middleware(['auth'])->group(function() {
    Route::GET('/profil/{id}', [ProfilController::class, 'index'])->name('profil.index');
    Route::PUT('/profil/update/{id}', [ProfilController::class, 'update'])->name('profil.update');
});

require __DIR__.'/auth.php';
