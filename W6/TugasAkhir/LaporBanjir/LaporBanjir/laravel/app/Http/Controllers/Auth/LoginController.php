<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin($role)
    {
        return view('auth.login', ['role' => $role]);
    }

    public function prosesLogin(Request $request, $role)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $data['role'] = $role;

  
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()
            ->withErrors(['email' => 'Email atau password salah, atau akun ini bukan akun ' . $role . '.'])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();                          
        $request->session()->invalidate();       
        $request->session()->regenerateToken();  

        return redirect('/login');
    }
}
