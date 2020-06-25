<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormPenilaianValidation extends FormRequest
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
        return [
            'nama_konsumen'   => 'required|string|regex:/^[\pL\s-]+$/u|min:3|max:25',
            'email_konsumen'  => 'nullable|email:rfc',
            'no_wa_telepon'   => 'required|numeric|min:10',
            'saran_pengaduan' => 'required|string|min:3'
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @override \Illuminate\Foundation\Http\FormRequest
     * @return array
     */
    public function messages()
    {
        return [
            'nama_konsumen.required'   => 'Isian nama lengkap tidak boleh kosong.',
            'nama_konsumen.regex'      => 'Nama lengkap tidak boleh mengandung karakter atau numerik.',
            'nama_konsumen.min'        => 'Nama lengkap minimal terdiri dari 3 karakter.',
            'nama_konsumen.max'        => 'Nama lengkap maksimum terdiri dari 25 karakter.',
            'email_konsumen.email'     => 'Format email tidak benar.',
            'no_wa_telepon.required'   => 'Nomor telepon/whatsapp tidak boleh kosong.',
            'no_wa_telepon.numeric'    => 'Nomor telepon/whatsapp harus numerik.',
            'no_wa_telepon.min'        => 'Nomor telepon/whatsapp minimal terdiri dari 10 digit.',
            'saran_pengaduan.required' => 'Kritik dan Saran tidak boleh kosong.',
            'saran_pengaduan.min'      => 'Kritik dan Saran minimal terdiri dari 3 karakter.'
        ];
    }
}
