<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan #{{ $laporan->id }} - Admin LingkunganKu</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin-page">
    @include('admin.partials.sidebar')

    <main class="admin-main">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button class="hamburger" id="hamburger" aria-label="Buka menu">
                    <span></span><span></span><span></span>
                </button>
                <div>
                    <p class="eyebrow">DETAIL LAPORAN #{{ $laporan->id }}</p>
                    <h1>{{ $laporan->judul }}</h1>
                </div>
            </div>
            <div class="topbar-user">
                <span class="status-dot"></span>
                <span>{{ session('admin_name', 'Admin LingkunganKu') }}</span>
            </div>
        </header>

        {{-- Flash sukses --}}
        @if (session('sukses'))
            <div style="padding:12px 18px;border-radius:10px;background:#dcfce7;border:1px solid #86efac;color:#15803d;margin-bottom:20px;font-size:13.5px;font-weight:600;">
                ✓ {{ session('sukses') }}
            </div>
        @endif

        {{-- Breadcrumb --}}
        <div style="margin-bottom:20px;font-size:13px;color:#94a3b8;">
            <a href="{{ route('admin.laporan') }}" style="color:var(--blue);text-decoration:none;">Semua Laporan</a>
            <span style="margin:0 6px;">›</span>
            <span>Detail #{{ $laporan->id }}</span>
        </div>

        <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

            {{-- ── Kolom kiri: info laporan ───────────────────────────── --}}
            <div>
                {{-- Foto --}}
                @if ($laporan->foto)
                    <section class="content-panel" style="margin-bottom:20px;padding:0;overflow:hidden;">
                        <img src="{{ $laporan->foto_url }}"
                             alt="Foto laporan"
                             style="width:100%;max-height:360px;object-fit:cover;display:block;border-radius:14px;">
                    </section>
                @endif

                {{-- Info utama --}}
                <section class="content-panel" style="margin-bottom:20px;">
                    <div class="panel-heading" style="margin-bottom:16px;">
                        <h2>Informasi Laporan</h2>
                        @php
                            $bs = match($laporan->status) {
                                'baru'     => 'background:#fef9c3;color:#854d0e;',
                                'diproses' => 'background:#dbeafe;color:#1d4ed8;',
                                'selesai'  => 'background:#dcfce7;color:#15803d;',
                                'ditolak'  => 'background:#fee2e2;color:#dc2626;',
                                default    => 'background:#f1f5f9;color:#64748b;',
                            };
                        @endphp
                        <span style="padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;{{ $bs }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>

                    <table style="width:100%;border-collapse:collapse;font-size:13.5px;">
                        <tbody>
                            <tr>
                                <th style="padding:10px 0;width:130px;text-align:left;color:#64748b;font-weight:600;vertical-align:top;">Kategori</th>
                                <td style="padding:10px 0;color:#1e293b;">{{ $laporan->kategori }}</td>
                            </tr>
                            <tr>
                                <th style="padding:10px 0;text-align:left;color:#64748b;font-weight:600;vertical-align:top;border-top:1px solid #f1f5f9;">Lokasi</th>
                                <td style="padding:10px 0;color:#1e293b;border-top:1px solid #f1f5f9;">{{ $laporan->lokasi }}</td>
                            </tr>
                            <tr>
                                <th style="padding:10px 0;text-align:left;color:#64748b;font-weight:600;vertical-align:top;border-top:1px solid #f1f5f9;">Deskripsi</th>
                                <td style="padding:10px 0;color:#1e293b;border-top:1px solid #f1f5f9;line-height:1.7;">{{ $laporan->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th style="padding:10px 0;text-align:left;color:#64748b;font-weight:600;border-top:1px solid #f1f5f9;">Dilaporkan</th>
                                <td style="padding:10px 0;color:#1e293b;border-top:1px solid #f1f5f9;">{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            @if ($laporan->catatan_admin)
                            <tr>
                                <th style="padding:10px 0;text-align:left;color:#64748b;font-weight:600;vertical-align:top;border-top:1px solid #f1f5f9;">Catatan Admin</th>
                                <td style="padding:10px 0;color:#1e293b;border-top:1px solid #f1f5f9;line-height:1.7;">{{ $laporan->catatan_admin }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </section>

                {{-- Riwayat penanganan --}}
                @if ($laporan->riwayatPenanganan->isNotEmpty())
                <section class="content-panel">
                    <h2 style="font-size:16px;margin-bottom:16px;">Riwayat Penanganan</h2>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        @foreach ($laporan->riwayatPenanganan->sortByDesc('created_at') as $riwayat)
                        <div style="padding:14px;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                                <span style="padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#e2e8f0;color:#475569;">
                                    {{ ucfirst($riwayat->status_sebelumnya ?? '—') }}
                                </span>
                                <span style="color:#94a3b8;font-size:13px;">→</span>
                                <span style="padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;background:var(--blue-light);color:var(--blue);">
                                    {{ ucfirst($riwayat->status_baru) }}
                                </span>
                                <span style="margin-left:auto;color:#94a3b8;font-size:12px;">
                                    {{ $riwayat->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                            @if ($riwayat->catatan)
                            <p style="margin:0;font-size:13px;color:#475569;line-height:1.6;">{{ $riwayat->catatan }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            {{-- ── Kolom kanan: form ubah status ─────────────────────── --}}
            <div>
                <section class="content-panel">
                    <h2 style="font-size:16px;margin-bottom:20px;">Kelola Laporan</h2>

                    <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div style="margin-bottom:16px;">
                            <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;">
                                Status Laporan
                            </label>
                            <select name="status"
                                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;background:white;cursor:pointer;">
                                <option value="baru"      {{ $laporan->status === 'baru'      ? 'selected' : '' }}>🟡 Baru</option>
                                <option value="diproses"  {{ $laporan->status === 'diproses'  ? 'selected' : '' }}>🔵 Diproses</option>
                                <option value="selesai"   {{ $laporan->status === 'selesai'   ? 'selected' : '' }}>🟢 Selesai</option>
                                <option value="ditolak"   {{ $laporan->status === 'ditolak'   ? 'selected' : '' }}>🔴 Ditolak</option>
                            </select>
                            @error('status')
                                <p style="color:#dc2626;font-size:12px;margin-top:5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="margin-bottom:20px;">
                            <label style="display:block;font-size:13px;font-weight:700;color:#374151;margin-bottom:8px;">
                                Catatan Admin
                                <span style="font-weight:400;color:#94a3b8;">(opsional)</span>
                            </label>
                            <textarea name="catatan_admin" rows="5"
                                      placeholder="Tulis catatan atau keterangan penanganan..."
                                      style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:13.5px;outline:none;resize:vertical;font-family:inherit;line-height:1.6;">{{ old('catatan_admin', $laporan->catatan_admin) }}</textarea>
                        </div>

                        <button type="submit"
                                style="width:100%;padding:12px;border:none;border-radius:10px;background:var(--blue);color:white;font-size:14px;font-weight:700;cursor:pointer;">
                            Simpan Perubahan
                        </button>
                    </form>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('admin.laporan') }}"
                       style="display:block;margin-top:12px;text-align:center;padding:10px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;">
                        ← Kembali ke Daftar
                    </a>

                    {{-- Tombol hapus --}}
                    <form action="{{ route('admin.laporan.destroy', $laporan) }}" method="POST"
                          id="form-hapus" style="margin-top:10px;">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="konfirmasiHapus()"
                                style="width:100%;padding:10px;border:1.5px solid #fca5a5;border-radius:10px;background:white;color:#dc2626;font-size:13px;font-weight:600;cursor:pointer;">
                            🗑️ Hapus Laporan Ini
                        </button>
                    </form>
                </section>
            </div>

        </div>

        <footer class="admin-footer">
            © {{ date('Y') }} LingkunganKu · Panel Administrator
        </footer>
    </main>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
<script>
    const hamburger = document.getElementById('hamburger');
    const sidebar   = document.getElementById('sidebar');
    const overlay   = document.getElementById('sidebarOverlay');
    if (hamburger) {
        hamburger.addEventListener('click', () => { sidebar.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow='hidden'; });
        overlay.addEventListener('click',   () => { sidebar.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow=''; });
    }

    function konfirmasiHapus() {
        if (confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak bisa dibatalkan.')) {
            document.getElementById('form-hapus').submit();
        }
    }
</script>
</body>
</html>
