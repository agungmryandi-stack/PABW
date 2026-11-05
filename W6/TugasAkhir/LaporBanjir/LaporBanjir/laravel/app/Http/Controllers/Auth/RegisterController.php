<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formRegister($role)
    {
        return view('auth.register', ['role' => $role]);
    }

    public function prosesRegister(Request $request, $role)
    {
        $aturan = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
        if ($role == 'admin') {
            $aturan['kode_admin'] = 'required|in:' . config('app.kode_admin');
        }
        $request->validate($aturan, [
            'kode_admin.in' => 'Kode admin salah.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        Auth::login($user);
        return redirect('/');
    }
}
