<?php

declare(strict_types=1);

namespace App\Livewire\Antrian\Admin;

use App\Traits\Antrian\Helper_Firestore;
use App\Models\d_antrian_satker_config_view;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use DateTime;
use Exception;

class Konfigurasi extends Component
{
    use Helper_Firestore;

    public string $pageTitle = "Konfigurasi Antrian";

    public function render(): View
    {
        $data_to_render = $this->retrieveData();
        return view('livewire.antrian.admin.konfigurasi', [
            'data_tanggal_disabled' => $data_to_render['tanggal_disabled'],
            'data_playlist_type' => $data_to_render['playlist_type'],
            'data_playlist' => $data_to_render['playlist'],
            'data_footer_type' => $data_to_render['footer_type'],
            'data_footer' => $data_to_render['footer'],
        ])
        ->layout('components.layouts.app')
        ->title($this->pageTitle);
    }

    public function submit_data_perubahan($type, $form_data)
    {
        if($type == 'tanggal_disabled'){
            DB::beginTransaction();
            try{

                $tanggal_disabled_string = $form_data['tanggal_disabled'];
                $tanggal_disabled_array = explode(',', $tanggal_disabled_string);

                $ada_error = false;

                foreach($tanggal_disabled_array as $item_tanggal_string){
                    if (!$this->isValidDate(trim($item_tanggal_string))) {
                        $ada_error = true;
                    }
                }

                if($ada_error){
                    $this->dispatch('notification', message: 'Gagal menyimpan data, kesalahan format.');
                    return;
                }


                $user_unit_code  = auth()->user()->satker->kode_satker;
                if(!$user_unit_code){
                    throw new Exception();
                }

                d_antrian_satker_config_view::where('kode_satker', $user_unit_code)
                    ->whereIn('config_key', ['tanggal_disabled'])
                    ->delete();

                $baru = new d_antrian_satker_config_view();
                $baru->kode_satker = $user_unit_code;
                $baru->config_key = 'tanggal_disabled';
                $baru->config_index = '1';
                $baru->config_value = $tanggal_disabled_string;
                $baru->save();

                $this->set_konfigurasi($this->setup_client_create(), $user_unit_code);
                DB::commit();
                $this->dispatch('notification', message: 'Berhasil menyimpan data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Gagal menyimpan data.');
            }
        }else if($type == 'video'){
            DB::beginTransaction();
            try{
                $user_unit_code  = auth()->user()->satker->kode_satker;
                if(!$user_unit_code){
                    throw new Exception();
                }

                d_antrian_satker_config_view::where('kode_satker', $user_unit_code)
                    ->whereIn('config_key', ['playlist_type', 'playlist'])
                    ->delete();

                $index = 1;
                foreach($form_data as $key=>$value){
                    if($key == 'playlist_type'){
                        $baru = new d_antrian_satker_config_view();
                        $baru->kode_satker = $user_unit_code;
                        $baru->config_key = 'playlist_type';
                        $baru->config_index = 1;
                        $baru->config_value = $value;
                        $baru->save();
                        continue;
                    }
                    if($value){
                        $url_parsed_arr = parse_url($value);
                        if ($url_parsed_arr['host'] == "www.youtube.com"
                            && $url_parsed_arr['path'] == "/watch"
                            && substr($url_parsed_arr['query'], 0, 2) == "v="
                            && substr($url_parsed_arr['query'], 2) != ""
                            && $url_parsed_arr['query']
                            && substr_count($url_parsed_arr['query'], '=') == 1)
                        {
                            $baru = new d_antrian_satker_config_view();
                            $baru->kode_satker = $user_unit_code;
                            $baru->config_key = 'playlist';
                            $baru->config_index = $index;
                            $baru->config_value = $value;
                            $baru->save();
                            $index += 1;
                            
                        }
                    }
                }
                $this->set_konfigurasi($this->setup_client_create(), $user_unit_code);
                DB::commit();
                $this->dispatch('notification', message: 'Berhasil menyimpan data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Gagal menyimpan data.');
            }
        }else if($type == 'footer'){
            DB::beginTransaction();
            try{
                $user_unit_code  = auth()->user()->satker->kode_satker;

                d_antrian_satker_config_view::where('kode_satker', $user_unit_code)
                    ->whereIn('config_key', ['footer_type', 'footer'])
                    ->delete();

                $index = 1;
                foreach($form_data as $key=>$value){
                    if($key == 'footer_type'){
                        $baru = new d_antrian_satker_config_view();
                        $baru->kode_satker = $user_unit_code;
                        $baru->config_key = 'footer_type';
                        $baru->config_index = 1;
                        $baru->config_value = $value;
                        $baru->save();
                        continue;
                    }

                    if($key == 'footer'){
                        $baru = new d_antrian_satker_config_view();
                        $baru->kode_satker = $user_unit_code;
                        $baru->config_key = 'footer';
                        $baru->config_index = 1;
                        $baru->config_value = $value;
                        $baru->save();
                        continue;
                    }
                }
                $this->set_konfigurasi($this->setup_client_create(), $user_unit_code);
                DB::commit();
                $this->dispatch('notification', message: 'Berhasil menyimpan data.');
            }catch(Exception $ex){
                DB::rollBack();
                Log::error($ex);
                $this->dispatch('notification', message: 'Gagal menyimpan data.');
            }
        }
    }


    private function retrieveData()
    {
        $user_unit_code  = auth()->user()->satker->kode_satker;

        $data_arr =  d_antrian_satker_config_view::where('kode_satker', $user_unit_code)
                ->orderBy('config_key', 'asc')
                ->orderBy('config_index', 'asc')
                ->get();

        $data_return = ['tanggal_disabled'=> '', 'playlist_type' => null, 'playlist' => [], 'footer_type' => null, 'footer' => null];

        foreach($data_arr as $item){
            if($item->config_key == 'tanggal_disabled'){
                $data_return['tanggal_disabled'] = $item['config_value'];
            }else if($item->config_key == 'playlist_type'){
                $data_return['playlist_type'] = $item['config_value'];
            }else if($item->config_key == 'playlist'){
                array_push( $data_return['playlist'], $item['config_value']);
            }else if($item->config_key == 'footer_type'){
                $data_return['footer_type'] = $item['config_value'];
            }else if($item->config_key == 'footer'){
                $data_return['footer'] = $item['config_value'];
            }
        }

        return $data_return;
    }

    private function isValidDate($date, $format = 'Y-m-d') {
        $dateTime = DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) === $date;
    }

}
