<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'      => 'required|in:jalan,lampu-jalan,sampah,selokan,taman,lainnya',
            'deskripsi'     => 'required|string|max:5000',
            'kecamatan'     => 'required|string|max:100',
            'kelurahan'     => 'required|string|max:100',
            'alamat_lokasi' => ['nullable', 'string', 'max:150'],
            'titik_maps'    => [
                'nullable',
                'regex:/^-?\d{1,3}(?:\.\d+)?,\s*-?\d{1,3}(?:\.\d+)?$/',
            ],
            'foto_laporan'   => 'required|array|min:1|max:1',
            'foto_laporan.*' => 'image|mimes:jpg,jpeg,png,webp',
            'persetujuan'   => 'accepted',
            'nama_pelapor'  => 'nullable|string|max:255',
            'email_pelapor' => 'nullable|string|max:255',
        ], [
            'foto_laporan.required' => 'Foto wajib dilampirkan, minimal 1 foto.',
            'foto_laporan.min'      => 'Foto wajib dilampirkan, minimal 1 foto.',
            'foto_laporan.max'      => 'Hanya 1 foto per laporan.',
            'foto_laporan.*.image'  => 'File harus berupa gambar.',
            'foto_laporan.*.mimes'  => 'Foto harus berformat JPG, PNG, atau WebP.',
            'persetujuan.accepted'  => 'Centang persetujuan terlebih dahulu.',
            'deskripsi.required'    => 'Deskripsi wajib diisi.',
            'kecamatan.required'    => 'Kecamatan wajib dipilih.',
            'kelurahan.required'    => 'Kelurahan wajib dipilih.',
            'kategori.required'     => 'Jenis laporan wajib dipilih.',
        ]);

        // ── Simpan foto (support multiple) ──────────────────────────────
        $fotoPaths = [];

        if ($request->hasFile('foto_laporan')) {
            $files = $request->file('foto_laporan');
            // Normalkan: bisa array (multiple) atau single
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $fotoPaths[] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
                }
            }
        }

        $fotoPrimary = $fotoPaths[0] ?? null;

        // ── Nama kategori yang lebih rapi ────────────────────────────────
        $namaKategori = [
            'jalan'      => 'Jalan',
            'lampu-jalan'=> 'Lampu Jalan',
            'sampah'     => 'Sampah',
            'selokan'    => 'Selokan',
            'taman'      => 'Taman',
            'lainnya'    => 'Lainnya',
        ];

        $lokasi = ucfirst($validated['kelurahan'])
            . ', Kec. '
            . ucfirst($validated['kecamatan']);

        if (!empty($validated['titik_maps'])) {
            $lokasi .= ' (' . $validated['titik_maps'] . ')';
        }

        if (!empty($validated['alamat_lokasi'])) {
            $lokasi .= ' – ' . $validated['alamat_lokasi'];
        }

        $lokasi = mb_substr($lokasi, 0, 255); // kolom lokasi maksimal 255 karakter

        // ── Simpan ke database ───────────────────────────────────────────
        try {
            Laporan::create([
                'user_id'       => auth()->id(),
                'nama_pelapor'  => $validated['nama_pelapor'] ?? null,
                'email_pelapor' => $validated['email_pelapor'] ?? null,
                'judul'         => 'Laporan ' . $namaKategori[$validated['kategori']],
                'kategori'      => $namaKategori[$validated['kategori']],
                'deskripsi'     => $validated['deskripsi'],
                'lokasi'        => $lokasi,
                'foto'          => $fotoPrimary,
                'status'        => 'baru',
                'catatan_admin' => null,
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }

        if ($request->expectsJson()) {

            return response()->json(['ok' => true]);

        }


        return redirect()

            ->to('/buat-laporan?terkirim=1')
            ->with('laporan_terkirim', true);
    }
}
