<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class d_antrian_satker extends Model
{
    /**
     * Tabel terkait dengan model
     *
     * @var string
     */
    protected $table = 'd_antrian_satker';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $dates = ['antrian'];

    /**
     * Atribut yang diperlukan untuk mass assignment.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'kode_satker',
        'kode_layanan',
        'konsumen_nama',
        'konsumen_tahun_lahir',
        'tanggal',
        'status',
        'periode',
        'antrian',
        'antrian_internal',
        'konsumen_email',
        'konsumen_no_wa_telepon',
        'deskripsi',
        'sudah_nilai'
    ];

    public function satker()
    {
        return $this->hasOne(m_satker::class, 'kode_satker', 'kode_satker');
    }


    public function layanan()
    {
        return $this->hasOne(m_layanan::class, 'kode_layanan', 'kode_layanan');
    }

    public static function rearrange($kode_satker)
    {
        $tanggal_data_arr = d_antrian_satker::where('kode_satker', $kode_satker)
            ->where('tanggal', '>=' , Carbon::today()->format('Y-m-d'))
            ->select('tanggal')
            ->distinct()
            ->get();

        $antrian_satker_layanan = m_antrian_satker_layanan::where('kode_satker', $kode_satker)
            ->where('is_active', 1)
            ->get();

        $loket_layanan = [];
        $layanan_aktive = [];
        foreach($antrian_satker_layanan as $item_satker_layanan){
            if(!array_key_exists($item_satker_layanan->loket, $loket_layanan)){
                $loket_layanan[$item_satker_layanan->loket] = [];
            }
            array_push($loket_layanan[$item_satker_layanan->loket], $item_satker_layanan->kode_layanan);
            array_push($layanan_aktive, $item_satker_layanan->kode_layanan);
        }

        foreach($tanggal_data_arr as $item_tanggal)
        {
            $antrian_query = d_antrian_satker::query();
            $antrian_query->where('kode_satker', $kode_satker);
            $antrian_query->where('tanggal', $item_tanggal->tanggal);
            $antrian_query->whereIn('kode_layanan', $layanan_aktive);
            $antrian_query->orderby('antrian_internal', 'asc');
            $antrian = $antrian_query->get();

            foreach ($loket_layanan as $loket => $arr_kode_layanan) {
                $antrian_filter_periode_1 = $antrian->filter(function ($value, $key) use ($arr_kode_layanan) {
                    return in_array($value->kode_layanan, $arr_kode_layanan) && $value->periode == 0;
                })->sortBy('antrian_internal');

                $index = 1;
                foreach($antrian_filter_periode_1 as $item_antrian)
                {
                    d_antrian_satker::where('id', $item_antrian->id)
                        ->update(['antrian' => $item_antrian->periode.str_pad($index, 2, "0", STR_PAD_LEFT)]);
                    $index += 1;
                }

                $antrian_filter_periode_2 = $antrian->filter(function ($value, $key) use ($arr_kode_layanan) {
                    return in_array($value->kode_layanan, $arr_kode_layanan) && $value->periode == 1;
                })->sortBy('antrian_internal');

                $index = 1;
                foreach($antrian_filter_periode_2 as $item_antrian)
                {
                    d_antrian_satker::where('id', $item_antrian->id)
                        ->update(['antrian' => $item_antrian->periode.str_pad($index, 2, "0", STR_PAD_LEFT)]);
                    $index += 1;
                }
            }
        }
       
    }


}
