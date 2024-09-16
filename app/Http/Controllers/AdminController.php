<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Registrasi;
use App\Models\User;
use Carbon\Carbon;
use Alert;

class AdminController extends Controller
{
    public function index()
    {
        $userDokter = User::where('role', 'dokter')->orderBy('created_at', 'desc')->get();
        $userStaff = User::where('role', 'staff')->orderBy('created_at', 'desc')->get();
        $userAdmin = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();

        return view('admin.admin', compact('userDokter', 'userStaff', 'userAdmin'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'no' => 'required|string|min:10|max:13',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed', // Password harus required pada store
            'role' => 'required|string|in:admin,dokter,staff', // Menyesuaikan role yang ada
        ]);

        // Menyimpan data user
        $data = [
            'name' => $request->name,
            'no' => $request->no,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Mengenkripsi password
            'role' => $request->role, // Simpan role
        ];

        // Menggunakan model User secara statis untuk create
        User::create($data);

        // Mengatur pesan sesuai role
        $role = $request->role;
        $roleName = '';

        switch ($role) {
            case 'admin':
                $roleName = 'admin';
                break;
            case 'dokter':
                $roleName = 'dokter';
                break;
            case 'staff':
                $roleName = 'staff';
                break;
        }

        // Memberikan notifikasi toast
        Alert::toast("Data $roleName berhasil dibuat!", 'success');
        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'no' => 'required|string|min:10|max:13',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed', // Validasi password opsional
            'role' => 'required|string|in:admin,dokter,staff', // Menyesuaikan role yang ada
        ]);

        // Menyimpan data user
        $data = [
            'name' => $request->name,
            'no' => $request->no,
            'email' => $request->email,
            'role' => $request->role, // Simpan role
        ];

        // Jika ada password baru, update password
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password); // Mengenkripsi password
        }

        $user->update($data);

        // Mengatur pesan sesuai role
        $role = $request->role;
        $roleName = '';

        switch ($role) {
            case 'admin':
                $roleName = 'admin';
                break;
            case 'dokter':
                $roleName = 'dokter';
                break;
            case 'staff':
                $roleName = 'staff';
                break;
        }

        // Memberikan notifikasi toast
        Alert::toast("Data $roleName berhasil diedit!", 'success');
        return redirect()->route('admin.index');
    }

    public function delete($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengambil role user sebelum dihapus
        $role = $user->role;
        $roleName = '';

        // Menentukan nama role untuk pesan notifikasi
        switch ($role) {
            case 'admin':
                $roleName = 'admin';
                break;
            case 'dokter':
                $roleName = 'dokter';
                break;
            case 'staff':
                $roleName = 'staff';
                break;
        }

        // Hapus user
        $user->delete();

        // Memberikan notifikasi toast sesuai role
        Alert::toast("Data $roleName berhasil dihapus!", 'success');

        // Mengarahkan kembali ke halaman daftar user (misalnya halaman index admin)
        return redirect()->route('admin.index');
    }
}
