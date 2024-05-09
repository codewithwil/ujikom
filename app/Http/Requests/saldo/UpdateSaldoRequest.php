<?php

namespace App\Http\Requests\saldo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaldoRequest extends FormRequest
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
            'saldo'          => 'nullable|max:11',
            'keterangan'     => 'nullable|max:255',
            'status'         => 'nullable'
        ];
    }
}
