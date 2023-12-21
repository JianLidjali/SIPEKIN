<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'staffIdentityCardNo' => 'required|unique:employees,staffIdentityCardNo',
            'department' => 'required',
            'position' => 'required',
            'dateJoined' => 'required|date',
            'dateInThePresentPosition' => 'required|date|after_or_equal:dateJoined',
        ];
    }
    public function messages()
    {
        return [
            'staffIdentityCardNo.unique' => 'Staff Identity Card No sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'dateInThePresentPosition.after_or_equal' => 'Tanggal pada kolom "Date In The Present Position" harus setelah tanggal pada kolom "Date Joined".',
        ];
    }
}
