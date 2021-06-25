<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use JKD\SSO\Client\Provider\Keycloak;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect('login');
    }

    public function sso(Request $request)
    {
        $provider = new Keycloak([
            'authServerUrl'         => 'https://sso.bps.go.id',
            'realm'                 => 'pegawai-bps',
            'clientId'              => config('services.bps.client_id'),
            'clientSecret'          => config('services.bps.client_secret'),
            'redirectUri'           => 'http://localhost/spatula/callback-url'
        ]);

        if (!isset($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl();

            $request->session()->put('oauth2state', $provider->getState());

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

    protected function sendFailedLoginResponse(Request $request)
    {
        alert()->error('Gagal Login', 'Username atau Password Anda Salah.');

        return redirect()->to(env('APP_URL') . 'login');
    }
}
