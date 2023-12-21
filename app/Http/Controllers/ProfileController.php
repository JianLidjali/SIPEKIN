<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pages.profile.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'current_password' => [
                    'required_with:new_password',
                    function ($attribute, $value, $fail) use ($user) {
                        if (!Hash::check($value, $user->password)) {
                            $fail('The current password is incorrect.');
                        }
                    },
                ],
                'new_password' => 'nullable|min:8',
            ], [
                'current_password.required_with' => 'Please enter your current password.',
                'new_password.min' => 'The new password must be at least 8 characters.',
            ]);

            $userData = [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
            ];

            if ($request->filled('new_password')) {
                // Update password only if a new password is provided
                $userData['password'] = Hash::make($request->input('new_password'));
            }

            $user->update($userData);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
