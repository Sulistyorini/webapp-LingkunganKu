<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaAuthController extends Controller
{
    private const DOMAIN_SEKALI_PAKAI = [
        'mailinator.com', 'yopmail.com', 'guerrillamail.com', 'tempmail.com',
        '10minutemail.com', 'trashmail.com', 'sharklasers.com', 'getnada.com',
        'dispostable.com', 'maildrop.cc', 'throwawaymail.com', 'fakeinbox.com',
    ];

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'email' => [
                'required', 'string', 'max:255', 'email:rfc', 'unique:users,email',
                function ($attr, $value, $fail) {
                    $domain = strtolower(substr(strrchr($value, '@'), 1));
                    if (in_array($domain, self::DOMAIN_SEKALI_PAKAI, true)) {
                        $fail('Gunakan email asli, bukan email sekali pakai.');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:8'],
            'konfirmasi_password' => ['required', 'same:password'],
        ], [
            'email.email' => 'Email tidak valid atau domainnya tidak dikenali.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'konfirmasi_password.same' => 'Password dan konfirmasi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $data['nama_lengkap'],
            'email' => strtolower($data['email']),
            'password' => $data['password'],
        ]);

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json(['redirect' => '/', 'nama' => $user->name, 'email' => $user->email]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt(['email' => strtolower($data['email']), 'password' => $data['password']], $request->boolean('ingat'))) {
            return response()->json(['errors' => ['email' => ['Email atau password tidak sesuai.']]], 422);
        }

        $request->session()->regenerate();
        $tujuan = Auth::user()->hasVerifiedEmail() ? '/' : '/';
        return response()->json(['redirect' => $tujuan, 'nama' => Auth::user()->name, 'email' => Auth::user()->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
