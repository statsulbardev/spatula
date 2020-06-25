<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MPenggunaValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'fullname' => 'required|string|regex:/^[\pL\s-]+$/u|min:3|max:30',
            'username' => 'required|string|regex:/^[\pL\s-]+$/u|min:3|max:20',
            'email'    => 'required|email:rfc',
            'bpsid'    => 'nullable|numeric|min:9|max:9',
            'satker'   => 'required',
            'role'     => 'required',
            'photo'    => 'nullable|image|mimes:png,jpg,jpeg|max:500'
        ];

        if($this->route()->getName() === "pengguna.tambah") {
            $rules['password'] = 'required|string|min:8|max:20';
        } else {
            $rules['password'] = 'nullable|string|min:8|max:20';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Isian nama lengkap tidak boleh kosong.',
            'fullname.regex'    => 'Isian nama lengkap tidak boleh mengandung karakter atau numerik.',
            'fullname.min'      => 'Isian nama lengkap minimal terdiri dari 3 huruf.',
            'fullname.max'      => 'Isian nama lengkap maksimum terdiri dari 30 huruf.',
            'username.required' => 'Isian username tidak boleh kosong.',
            'username.regex'    => 'Isian username tidak boleh mengandung karakter atau numerik.',
            'username.min'      => 'Isian username minimal terdiri dari 3 huruf.',
            'username.max'      => 'Isian username maksimum terdiri dari 20 huruf.',
            'email.required'    => 'Isian email tidak boleh kosong.',
            'password.required' => 'Isian password tidak boleh kosong.',
            'password.min'      => 'Isian password minimal terdiri dari 8 karakter.',
            'password.max'      => 'Isian password maksumum terdiri dari 20 karakter.',
            'bpsid.min'         => 'Isian NIP BPS harus terdiri dari 9 nomor.',
            'bpsid.max'         => 'Isian NIP BPS harus terdiri dari 9 nomor.',
            'bpsid.numeric'     => 'Isian NIP BPS terdiri dari angka 0-9.',
            'photo.image'       => 'Foto profil harus merupakan format gambar.',
            'photo.mimes'       => 'Format foto profil yang diizinkan adalah jpg, jpeg, dan png.',
            'photo.max'         => 'Ukuran maksimum foto profil adalah 500 kb.',
        ];
    }
}
