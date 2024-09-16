<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;

class profilController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('profil.profil', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Mengambil data user berdasarkan ID

        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        Alert::toast('Profile petugas berhasil diedit!','success');
        return redirect()->route('profile.index', $user->id);
    }
}
