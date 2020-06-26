<?php

namespace App\Http\Controllers;

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
            'redirectUri'           => 'https://example.com/callback-url'
        ]);

        dd($provider);
    }
}
