<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'department' => 'required_if:role,HOD|nullable',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'Email sudah digunakan.',
            'password_confirmation.same' => 'Konfirmasi password tidak sama.',
        ];
    }
}
