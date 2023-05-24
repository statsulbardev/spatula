<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
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
            'f_unit'           => 'required',
            'f_nama'           => 'required|min:4|max:30',
            'f_email'          => 'nullable|email:rfc',
            'f_nowatelp'       => 'required|numeric',
            'f_layanan'        => 'required',
            'f_ratinglayanan'  => 'required',
            'f_petugas'        => 'required_if:f_layanan,1',
            'f_ratingpetugas'  => 'required_if:f_layanan,1',
            'f_saranpengaduan' => 'required|min:4'
        ];
    }

    public function messages() : array
    {
        return [
            'f_unit.required'             => 'Unit kerja harus terpilih salah satu',
            'f_nama.required'             => 'Nama tidak boleh kosong',
            'f_nama.min'                  => 'Nama sekurang-kurangnya 4 karakter',
            'f_nama.max'                  => 'Nama maksimal sebanyak 30 karakter',
            'f_email.email'               => 'Format email tidak valid',
            'f_nowatelp.required'         => 'Nomor telp/whatsapp tidak boleh kosong',
            'f_nowatelp.numeric'          => 'Nomor telp/whatsapp hanya boleh angka',
            'f_layanan.required'          => 'Jenis layanan minimal terpilih salah satu',
            'f_ratinglayanan.required'    => 'Rating layanan harus terpilih salah satu',
            'f_petugas.required_if'       => 'Petugas layanan minimal terpilih salah satu',
            'f_ratingpetugas.required_if' => 'Rating petugas layanan minimal terpilih salah satu',
            'f_saranpengaduan.required'   => 'Saran Pengaduan tidak boleh kosong',
            'f_saranpengaduan.min'        => 'Saran Pengaduan sekurang-kurangnya terisi 4 karakter'
        ];
    }
}
