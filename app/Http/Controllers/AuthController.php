<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function loginProcess(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {

            // WAJIB biar session aman
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'pegawai') {
                return redirect()->route('pegawai.dashboard');
            }

            // Kalau role aneh / ga dikenal
            Auth::logout();
            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Role user tidak valid.',
                ]);
        }

        // Kalau email / password salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
