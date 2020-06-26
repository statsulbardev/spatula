<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use JKD\SSO\Client\Provider\Keycloak;

class BpsSsoController extends Controller
{
    public function __invoke()
    {
        $provider = new Keycloak([
            'authServerUrl'         => 'https://sso.bps.go.id',
            'realm'                 => 'pegawai-bps',
            'clientId'              => config('services.bps.client_id'),
            'clientSecret'          => config('services.bps.client_secret'),
            'redirectUri'           => 'https://webapps.bps.go.id/sulbar/spatula/'
        ]);

        if (!isset($_GET['code'])) {
            // Untuk mendapatkan authorization code
            $authUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;

        // Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

            unset($_SESSION['oauth2state']);
            exit('Invalid state');

        } else {

            try {
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                dd($token);
            } catch (Exception $e) {
                exit('Gagal mendapatkan akses token : '.$e->getMessage());
            }

            // Opsional: Setelah mendapatkan token, anda dapat melihat data profil pengguna
            try {

                $user = $provider->getResourceOwner($token);
                    echo "Nama : ".$user->getName();
                    echo "E-Mail : ". $user->getEmail();
                    echo "Username : ". $user->getUsername();
                    echo "NIP : ". $user->getNip();
                    echo "NIP Baru : ". $user->getNipBaru();
                    echo "Kode Organisasi : ". $user->getKodeOrganisasi();
                    echo "Kode Provinsi : ". $user->getKodeProvinsi();
                    echo "Kode Kabupaten : ". $user->getKodeKabupaten();
                    echo "Alamat Kantor : ". $user->getAlamatKantor();
                    echo "Provinsi : ". $user->getProvinsi();
                    echo "Kabupaten : ". $user->getKabupaten();
                    echo "Golongan : ". $user->getGolongan();
                    echo "Jabatan : ". $user->getJabatan();
                    echo "Foto : ". $user->getUrlFoto();
                    echo "Eselon : ". $user->getEselon();

            } catch (Exception $e) {
                exit('Gagal Mendapatkan Data Pengguna: '.$e->getMessage());
            }

            // Gunakan token ini untuk berinteraksi dengan API di sisi pengguna
            echo $token->getToken();
        }
    }
}
