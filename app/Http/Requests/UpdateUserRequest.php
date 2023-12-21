<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');
        $employeeId = $userId->employee;

        return [
            'username' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId),
            ],
            'role' => 'required',

            'name' => 'required',
            'staffIdentityCardNo' => [
                'required',
                Rule::unique('employees', 'staffIdentityCardNo')->ignore($employeeId),
            ],
            'department' => 'required',
            'position' => 'required',
            'dateJoined' => 'required|date',
            'dateInThePresentPosition' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'staffIdentityCardNo.unique' => 'Staff Identity Card No sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'password_confirmation.same' => 'Konfirmasi password tidak sama.',
        ];
    }
}
