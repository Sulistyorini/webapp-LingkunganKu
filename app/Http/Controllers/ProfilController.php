<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function data(Request $request)
    {
        $u = \App\Support\WargaToken::user($request);
        return response()->json(['nama' => $u->name, 'email' => $u->email, 'foto' => $u->foto]);
    }

    public function ubah(Request $request)
    {
        $d = $request->validate(['nama' => ['required', 'string', 'max:100']]);
        $u = \App\Support\WargaToken::user($request);
        $u->forceFill(['name' => trim($d['nama'])])->save();
        return response()->json(['nama' => $u->name]);
    }

    public function foto(Request $request)
    {
        $d = $request->validate([
            'foto' => ['nullable', 'string', 'max:400000', 'starts_with:data:image/jpeg;base64,'],
        ], [
            'foto.max' => 'Foto terlalu besar.',
            'foto.starts_with' => 'Format foto tidak dikenali.',
        ]);
        $u = \App\Support\WargaToken::user($request);
        $u->forceFill(['foto' => $d['foto'] ?? null])->save();
        return response()->json(['foto' => $u->foto]);
    }
}
