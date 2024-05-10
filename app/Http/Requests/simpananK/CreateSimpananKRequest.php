<?php

namespace App\Http\Requests\SimpananK;

use Illuminate\Foundation\Http\FormRequest;

class CreateSimpananKRequest extends FormRequest
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
            'anggota_kode'      => 'required',
            'tanggal'           => 'required|date',
            'jenis_pembayaran'  => 'required',
            'divisi'            => 'required',
            'keterangan'        => 'required',
            'nominal'           => 'required',
            'status_buku'       => 'required',
            'status'            => 'required',
        ];
    }
}
