<?php

namespace App\Http\Requests\anggota;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnggotaRequest extends FormRequest
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
            'nama'                  => 'required|min:3',
            'nik'                   => 'required|min:16',
            'telepon'               => 'required|min:10',
            'alamat'                => 'required|max:255',
            'email'                 => 'required|email|unique:users,email',
            'status'                => 'nullable'
        ];
    }
}
