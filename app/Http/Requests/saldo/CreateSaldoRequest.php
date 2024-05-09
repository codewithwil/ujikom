<?php

namespace App\Http\Requests\saldo;

use Illuminate\Foundation\Http\FormRequest;

class CreateSaldoRequest extends FormRequest
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
            'saldo'          => 'required|max:11',
            'keterangan'     => 'required|max:255',
            'status'         => 'nullable'
        ];
    }
}
