<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function petugas()
    {
        return view('admin.petugas', [
            'users' => User::orderBy('role')->orderBy('name')->get(),
        ]);
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);
        if ($user->role == 'admin') {
            return back()->with('galat', 'Akun admin tidak bisa dihapus.');
        }
        $user->delete();
        return back()->with('sukses', 'Akun ' . $user->name . ' berhasil dihapus.');
    }
}
