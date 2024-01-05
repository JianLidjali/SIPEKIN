<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = user::all();
        return view('pages.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
            'username' => $request->input('username'),
            'role' => $request->input('role'),
            'email' => $request->input('email'),
            'department' => $request->input('department'),
            'email_verified_at' => now(),
            'password' => bcrypt($request->input('password')),
            ]);
            
        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',

            'name' => 'required',
            'staffIdentityCardNo' => 'required|unique:employees,staffIdentityCardNo,' . $user->employee->id . ',id',

            'department' => 'required',
            'position' => 'required',
            'dateJoined' => 'required|date',
            'dateInThePresentPosition' => 'required|date',
        ]);

        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        // Perbarui data karyawan jika diperlukan
        $user->employee->update([
            'name' => $request->input('name'),
            'staffIdentityCardNo' => $request->input('staffIdentityCardNo'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'dateJoined' => $request->input('dateJoined'),
            'dateInThePresentPosition' => $request->input('dateInThePresentPosition'),
        ]);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        $user->delete();
        if ($user->employee) {
            $user->employee->delete();
        }
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }
}
