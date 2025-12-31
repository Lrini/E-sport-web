<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    private function client()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_DRIVE_REDIRECT_URL'));
        $client->addScope('https://www.googleapis.com/auth/drive.file');
        //$client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
        $client->setAccessType('offline');
        $client->setPrompt('consent');
        return $client;
    }

    public function redirect()
    {
        $client = $this->client();
        return redirect()->away($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        $client = $this->client();

        if (!$request->has('code')) {
            return "Authorization code tidak ditemukan!";
        }

        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        dd($token); // cek apakah dapat refresh_token
    }
}
