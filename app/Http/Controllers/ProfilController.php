<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function data(Request $request)
    {
        $u = $request->user();
        return response()->json(['nama' => $u->name, 'email' => $u->email, 'foto' => $u->foto]);
    }

    public function ubah(Request $request)
    {
        $d = $request->validate(['nama' => ['required', 'string', 'max:100']]);
        $u = $request->user();
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
        $u = $request->user();
        $u->forceFill(['foto' => $d['foto'] ?? null])->save();
        return response()->json(['foto' => $u->foto]);
    }
}
