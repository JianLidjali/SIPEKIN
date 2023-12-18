<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Throwable;

class AuthController extends Controller
{

    public function login()
    {
        return view('pages.auth.login');
    }

    public function auth_login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt($request->only('username', 'password'))) {
                return redirect()
                    ->route('dashboard.index');
            }

            return redirect()
                ->back()
                ->withErrors(['message' => 'Ups! Username atau password salah']);
        } catch (Throwable $th) {
            info('Exception' . $th->getMessage());
            return redirect()
                ->back()
                ->withErrors(['message' => $th->getMessage()]);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
