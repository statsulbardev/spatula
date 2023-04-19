<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\m_pengguna;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JKD\SSO\Client\Provider\Keycloak;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    private $provider;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->provider = new Keycloak([
            'authServerUrl' => 'https://sso.bps.go.id',
            'realm'         => 'pegawai-bps',
            'clientId'      => config('services.bps.client_id'),
            'clientSecret'  => config('services.bps.client_secret'),
            'redirectUri'   => config('services.bps.redirect_uri')
        ]);
    }

    public function sso(Request $request)
    {
        if (!$request->input('code')) {
            $authUrl = $this->provider->getAuthorizationUrl();

            $request->session()->put('oauth2state', $this->provider->getState());
            $request->session()->save();

            return redirect($authUrl);

            exit;

        // Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
        } elseif (empty($request->input('state')) || ($request->input('state')) !== $request->session()->get('oauth2state')) {
            $request->session()->forget('oauth2state');
            $request->session()->save();

            exit;
        } else {
            try {
                $token = $this->provider->getAccessToken('authorization_code', [
                    'code' => $request->input('code')
                ]);

                $request->session()->put('spatula_access_token', $token->getToken());
                $request->session()->save();
            } catch (Exception $e) {
                return abort(400, $e->getMessage());
            }

            // Opsional: Setelah mendapatkan token, anda dapat melihat data profil pengguna
            try {

                $data = $this->provider->getResourceOwner($token);

                $pegawai = m_pengguna::where('bpsid', $data->getNip())->first();

                if(!empty($pegawai)) {
                    try {
                        DB::beginTransaction();

                        $pegawai->update([
                            'nama'     => $data->getName(),
                            'username' => $data->getUsername(),
                            'email'    => $data->getEmail(),
                            'foto'     => $data->getUrlFoto(),
                        ]);

                        DB::commit();
                    } catch(Exception $e) {
                        DB::rollBack();

                        return abort(403, $e->getMessage());
                    }

                    if(Auth::loginUsingId($pegawai->id)) return redirect()->intended('/');
                } else {
                    return abort(403, 'Anda tidak mempunyai akses untuk aplikasi ini.');
                }

            } catch (Exception $e) {
                return abort(401, $e->getMessage());
            }
        }
    }

    public function logout(Request $request)
    {
        //
    }
}
