<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    private const PETUNJUK = 'Kamu adalah asisten LingkunganKU, aplikasi pelaporan masalah lingkungan '
        . '(jalan rusak, sampah, lampu jalan mati, selokan tersumbat, taman) untuk warga Kabupaten Nganjuk. '
        . 'Jawab dalam bahasa Indonesia, singkat (maksimal 4 kalimat), ramah, dan hanya seputar aplikasi ini: '
        . 'cara membuat laporan, memantau status laporan, notifikasi, akun, dan profil. '
        . 'Jangan menjawab topik di luar itu. Jangan meminta atau menyimpan data pribadi. '
        . 'Jika tidak tahu, arahkan pengguna ke menu Profil lalu Bantuan.';

    public function ask(Request $request)
    {
        $data = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:500'],
        ]);

        $key = config('services.gemini.key');
        $model = config('services.gemini.model');

        if (!$key || !$model) {
            return response()->json(['ok' => false, 'jawaban' => 'Asisten AI belum aktif.'], 200);
        }

        try {
            $res = Http::timeout(20)
                ->withHeaders(['x-goog-api-key' => $key])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
                    'systemInstruction' => ['parts' => [['text' => self::PETUNJUK]]],
                    'contents' => [[
                        'role' => 'user',
                        'parts' => [['text' => $data['pertanyaan']]],
                    ]],
                    'generationConfig' => ['maxOutputTokens' => 300, 'temperature' => 0.4],
                ]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'jawaban' => 'Asisten sedang sibuk, coba lagi nanti.'], 200);
        }

        if (!$res->ok()) {
            return response()->json(['ok' => false, 'jawaban' => 'Asisten sedang sibuk, coba lagi nanti.'], 200);
        }

        $teks = $res->json('candidates.0.content.parts.0.text');

        if (!$teks) {
            return response()->json(['ok' => false, 'jawaban' => 'Maaf, saya belum bisa menjawab itu. Coba lihat menu Bantuan di Profil.'], 200);
        }

        return response()->json(['ok' => true, 'jawaban' => trim($teks)]);
    }
}