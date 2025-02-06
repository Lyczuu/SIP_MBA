<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    //query login
    public function cek_login(Request $request)
    {
        //validasi inputan dari fore
        //dd($request);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

       // Check login attempt
if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    $level = Auth::user()->role_id;

    // Redirect based on user role
    switch ($level) {
        case 1: // Admin
            return redirect()->intended('/admin/dashboard');

        case 2: // AM Wilayah
            return redirect()->intended('admin/dashboard');

        case 3: // AM Wilayah 2
            return redirect()->intended('/admin/dashboard');

    }
}
       else{
        //use session
         Session::flash('status','failed');
         Session::flash('message','Username atau password salah');

         return redirect('/login');


        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
