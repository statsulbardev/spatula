<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'f_kode'    => 'required|min:4',
            'f_nama'    => 'required|min:3|max:100',
            'f_level'   => 'required',
            'f_alamat'  => 'required|min:5|max:191',
            'f_web'     => 'nullable|min:5|max:50',
            'f_telepon' => 'nullable|min:8|max:12'
        ];
    }

    public function messages() : array
    {
        return [
            'f_kode.required'   => 'Kode satker tidak boleh kosong',
            'f_kode.unique'     => 'Kode satker sudah digunakan sebelumnya',
            'f_kode.min'        => 'Kode satker minimum 4 karakter',
            'f_nama.required'   => 'Nama satker tidak boleh kosong',
            'f_nama.min'        => 'Nama satker minimum 3 karakter',
            'f_nama.max'        => 'Nama satker maksimum 100 karakter',
            'f_level.required'  => 'Level satker tidak boleh kosong',
            'f_alamat.required' => 'Alamat satker tidak boleh kosong',
            'f_alamat.min'      => 'Alamat satker minimum 5 karakter',
            'f_alamat.max'      => 'Alamat satker maksimum 191 karakter',
            'f_web.min'         => 'Website satker minimum 5 karakter',
            'f_web.max'         => 'Website satker maksimum 50 karakter',
            'f_telepon.min'     => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka',
            'f_telepon.max'     => 'Nomor telepon satker minimum 8 angka dan maksimal 12 angka'
        ];
    }
}
