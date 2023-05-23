<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'f_kode'      => 'required',
            'f_nama'      => 'required|min:5',
            'f_metode'    => 'required',
            'f_deskripsi' => 'nullable|min:5'
        ];
    }

    public function messages() : array
    {
        return [
            'f_kode.required'   => 'Kode layanan tidak boleh kosong',
            'f_kode.unique'     => 'Kode layanan sudah digunakan sebelumnya',
            'f_nama.required'   => 'Nama layanan tidak boleh kosong',
            'f_nama.min'        => 'Nama layanan minimum 5 karakter',
            'f_metode.required' => 'Metode layanan harus terisi',
            'f_deskripsi.min'   => 'Deskripsi layanan minimal 5 karakter'
        ];
    }
}
