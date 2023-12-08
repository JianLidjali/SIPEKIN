<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    
    
    public function login()
    {
        return view('pages.auth.login');
    }

    public function auth_login(Request $request)
    {
        try{
            $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()
                ->route('dashboard.index')
                ->withSuccess('Selamat datang');
        }
        return redirect()
            ->back()
            ->withErrors(['message' => 'Ups! Username atau password salah']);
        }catch(\Throwable $th){
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
