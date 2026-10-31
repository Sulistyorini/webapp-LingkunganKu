<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = User::where('email', $credentials['email'])
            ->where('is_admin', true)
            ->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withErrors(['email' => 'Email atau password admin tidak sesuai.'])
                ->onlyInput('email');
        }

        $token = Crypt::encryptString(json_encode([
            'id'    => $admin->id,
            'name'  => $admin->name,
            'email' => $admin->email,
            'exp'   => time() + 7200,
        ]));

        $url = route('admin.dashboard');

        return response(
            '<!doctype html><meta charset="utf-8"><p>Masuk...</p><script>'
            . 'document.cookie="admin_token="+encodeURIComponent(' . json_encode($token) . ')'
            . '+"; path=/; max-age=7200; secure; samesite=lax";'
            . 'location.replace(' . json_encode($url) . ');</script>'
        );
    }

    public function logout(Request $request)
    {
        $url = route('admin.login');

        return response(
            '<!doctype html><meta charset="utf-8"><p>Keluar...</p><script>'
            . 'document.cookie="admin_token=; path=/; max-age=0; secure; samesite=lax";'
            . 'location.replace(' . json_encode($url) . ');</script>'
        );
    }
}
