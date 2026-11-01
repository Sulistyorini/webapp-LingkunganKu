<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Baru - Admin LingkunganKu</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') . '?v=2' }}">
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
                    <p class="eyebrow">ADMINISTRATOR</p>
                    <h1>Laporan Baru</h1>
                </div>
            </div>
            <div class="topbar-user">
                <span class="status-dot"></span>
                <span>{{ session('admin_name', 'Admin LingkunganKu') }}</span>
            </div>
        </header>

        <section class="content-panel">
            <div class="panel-heading">
                <div>
                    <h2>Laporan Menunggu Pemeriksaan</h2>
                    <p>{{ $jumlahBaru }} laporan baru dari warga belum ditindaklanjuti.</p>
                </div>
                <span class="coming-soon">{{ $jumlahBaru }} Laporan</span>
            </div>

            @if ($laporan->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">🔔</div>
                    <h3>Tidak ada laporan baru</h3>
                    <p>Semua laporan sudah ditindaklanjuti.</p>
                </div>
            @else
                <div style="overflow-x:auto;padding:20px;">
                    <table style="width:100%;border-collapse:collapse;font-size:13.5px;text-align:left;">
                        <thead>
                            <tr style="background:#f8fafc;">
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;">No.</th>
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;">Judul Laporan</th>
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;">Kategori</th>
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;">Lokasi</th>
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;">Tanggal</th>
                                <th style="padding:10px 14px;border-bottom:1px solid #e2e8f0;font-weight:700;color:#475569;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                            <tr style="border-bottom:1px solid #f1f5f9;">
                                <td style="padding:10px 14px;color:#94a3b8;">{{ $laporan->firstItem() + $loop->index }}</td>
                                <td style="padding:10px 14px;">
                                    <strong>{{ $item->judul }}</strong>
                                    <div style="margin-top:3px;color:#64748b;font-size:12px;">
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}
                                    </div>
                                </td>
                                <td style="padding:10px 14px;color:#64748b;">{{ $item->kategori }}</td>
                                <td style="padding:10px 14px;color:#64748b;">{{ $item->lokasi }}</td>
                                <td style="padding:10px 14px;color:#94a3b8;white-space:nowrap;">
                                    {{ $item->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td style="padding:10px 14px;text-align:center;">
                                    <a href="{{ route('admin.laporan.show', $item) }}"
                                       style="padding:5px 14px;border-radius:7px;background:var(--blue);color:white;font-size:12px;font-weight:600;text-decoration:none;">
                                        Proses
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="padding:0 20px 20px;">{{ $laporan->links() }}</div>
            @endif
        </section>

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
</script>
</body>
</html>
