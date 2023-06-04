<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'f_nama'     => 'required|regex:/^[\pL\s-]+$/u|min:3|max:100',
            'f_email'    => 'required|email:rfc',
            'f_password' => request()->route()->getName() === 'tambah-pengguna' ? 'required|min:8' : 'nullable|min:8',
            'f_nip'      => 'required|digits:9',
            'f_petugas'  => 'required',
            'f_role'     => 'required',
            'f_unit'     => 'nullable',
        ];
    }

    public function messages() : array
    {
        return [
            'f_nama.required'     => 'Nama pengguna tidak boleh kosong',
            'f_nama.regex'        => 'Nama pengguna hanya boleh mengandung karakter huruf',
            'f_nama.min'          => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
            'f_nama.max'          => 'Nama pengguna minimal 3 karakter dan maksimal 100 karakter',
            'f_email.required'    => 'Email tidak boleh kosong',
            'f_email.email'       => 'Format email tidak benar',
            'f_password.required' => 'Password tidak boleh kosong',
            'f_password.min'      => 'Password minimal 8 karakter',
            'f_email.unique'      => 'Email yang diiskan sudah pernah terdaftar',
            'f_nip.required'      => 'NIP BPS tidak boleh kosong',
            'f_nip.digits'        => 'NIP BPS harus terdiri dari 9 nomor',
            'f_petugas.required'  => 'Jenis petugas harus terpilih salah satu',
            'f_role.required'     => 'Role minimal terpilih salah satu',
            'f_unit.required'     => 'Unit kerja harus terpilih salah satu',
        ];
    }
}
