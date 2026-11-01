<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class WargaToken
{
    public static function make(User $u): string
    {
        return Crypt::encryptString(json_encode([
            'id'  => $u->id,
            'exp' => time() + 60 * 60 * 24 * 30,
        ]));
    }

    public static function user(Request $r): User
    {
        $t = (string) ($r->bearerToken() ?: $r->input('token'));
        $d = null;
        try {
            $d = json_decode(Crypt::decryptString($t), true);
        } catch (\Throwable $e) {
        }
        $u = ($d && ($d['exp'] ?? 0) > time()) ? User::find($d['id']) : null;
        if (!$u) {
            abort(response()->json(['message' => 'Unauthenticated.'], 401));
        }
        return $u;
    }
}