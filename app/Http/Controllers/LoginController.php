<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function index(){

        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'max:100'],
            'password' => ['required', 'max:100']
        ], [
            'username.max' => 'Username maximal 100 karakter',
            'password.max' => 'Username maximal 100 karakter',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admindashboard');
            } elseif (Auth::user()->role === 'member') {
                $request->session()->regenerate();
                return redirect()->intended('/memberdashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/librariandashboard');
            }
        }

        return back()->with('loginFail', 'Password atau username salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('successLogout', 'Anda Telah Berhsil Keluar!');
    }
}
