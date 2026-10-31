<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $cred = (string) $request->input('credential');
        $clientId = config('services.google.client_id');

        if ($cred === '' || !$clientId) {
            return response()->json(['message' => 'Login Google belum dikonfigurasi.'], 422);
        }

        $res = Http::timeout(10)->get('https://oauth2.googleapis.com/tokeninfo', ['id_token' => $cred]);
        $d = $res->json();

        $terverifikasi = filter_var($d['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $issOk = in_array($d['iss'] ?? '', ['accounts.google.com', 'https://accounts.google.com'], true);

        if (!$res->ok() || ($d['aud'] ?? '') !== $clientId || !$issOk || !$terverifikasi || empty($d['email'])) {
            return response()->json(['message' => 'Token Google tidak valid. Coba lagi.'], 422);
        }

        $email = strtolower($d['email']);
        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = new User();
            $user->forceFill([
                'name' => $d['name'] ?? Str::before($email, '@'),
                'email' => $email,
                'password' => Hash::make(Str::random(40)),
                'email_verified_at' => now(),
            ])->save();
        } elseif (!$user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return response()->json([
            'redirect' => '/',
            'nama' => $user->name,
            'email' => $user->email,
            'foto' => $user->foto,
        ]);
    }
}
