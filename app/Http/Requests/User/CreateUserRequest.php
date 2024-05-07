<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'foto_profile'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name'                  => 'required|min:3',
            'nik'                   => 'nullable|min:16',
            'telepon'               => 'nullable|min:10',
            'alamat'                => 'nullable|max:255',
            'email'                 => 'required|email|unique:users,email',
            'role'                  => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_repeat'       => 'required|min:8'
        ];
    }
}
