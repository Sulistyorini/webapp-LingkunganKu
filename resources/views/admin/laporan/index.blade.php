
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Laporan - Admin LingkunganKu</title>
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
                    <h1>Semua Laporan</h1>
                </div>
            </div>
            <div class="topbar-user">
                <span class="status-dot"></span>
                <span>{{ session('admin_name', 'Admin LingkunganKu') }}</span>
            </div>
        </header>

        <div class="filter-tabs">
            @if (session('sukses'))
                <div style="width:100%;padding:11px 16px;margin-bottom:14px;border-radius:10px;background:#dcfce7;border:1px solid #86efac;color:#15803d;font-size:13.5px;font-weight:600;">
                    ✓ {{ session('sukses') }}
                </div>
            @endif
            <a href="{{ route('admin.laporan') }}"
               class="filter-tab {{ !request('status') ? 'active' : '' }}">
                Semua
            </a>
            <a href="{{ route('admin.laporan', ['status' => 'baru']) }}"
               class="filter-tab {{ request('status') === 'baru' ? 'active' : '' }}">
                Baru
            </a>
            <a href="{{ route('admin.laporan', ['status' => 'diproses']) }}"
               class="filter-tab {{ request('status') === 'diproses' ? 'active' : '' }}">
                Diproses
            </a>
            <a href="{{ route('admin.laporan', ['status' => 'selesai']) }}"
               class="filter-tab {{ request('status') === 'selesai' ? 'active' : '' }}">
                Selesai
            </a>
        </div>

        <section class="content-panel">
            <div class="panel-heading">
                <div>
                    <h2>Daftar Laporan Warga</h2>
                    <p>Seluruh laporan yang masuk ke sistem LingkunganKu.</p>
                </div>
                <span class="coming-soon">
                    {{ $laporan->total() }} Laporan
                </span>
            </div>

            @if ($laporan->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <h3>Belum ada laporan</h3>
                    <p>
                        @if (request('status'))
                            Belum ada laporan dengan status
                            {{ request('status') }}.
                        @else
                            Belum ada laporan warga yang tersimpan di database.
                        @endif
                    </p>
                </div>
            @else
                <div style="overflow-x:auto; padding:20px;">
                    <table style="width:100%;border-collapse:collapse;text-align:left;">
                        <thead>
                            <tr>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">No.</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">Judul Laporan</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">Kategori</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">Lokasi</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">Tanggal</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;">Status</th>
                                <th style="padding:12px;border-bottom:1px solid #e2e8f0;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $item)
                                <tr>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        {{ $laporan->firstItem() + $loop->index }}
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        <strong>{{ $item->judul }}</strong>
                                        <div style="margin-top:4px;color:#64748b;font-size:13px;">
                                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 90) }}
                                        </div>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        {{ $item->kategori }}
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        {{ $item->lokasi }}
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        {{ $item->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                        @php
                                            $bs = match($item->status) {
                                                'baru'     => 'background:#fef9c3;color:#854d0e;',
                                                'diproses' => 'background:#dbeafe;color:#1d4ed8;',
                                                'selesai'  => 'background:#dcfce7;color:#15803d;',
                                                'ditolak'  => 'background:#fee2e2;color:#dc2626;',
                                                default    => 'background:#f1f5f9;color:#64748b;',
                                            };
                                        @endphp
                                        <span style="padding:3px 10px;border-radius:20px;font-size:11.5px;font-weight:700;{{ $bs }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e2e8f0;text-align:center;">
                                        <a href="{{ route('admin.laporan.show', $item) }}"
                                           style="padding:5px 12px;border-radius:7px;background:var(--blue-light);color:var(--blue);font-size:12px;font-weight:600;text-decoration:none;margin-right:6px;">
                                            Detail
                                        </a>
                                        <form action="{{ route('admin.laporan.destroy', $item) }}" method="POST"
                                              style="display:inline;" onsubmit="return confirm('Hapus laporan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="padding:5px 12px;border-radius:7px;background:#fee2e2;color:#dc2626;font-size:12px;font-weight:600;border:none;cursor:pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="padding:0 20px 20px;">
                    {{ $laporan->links() }}
                </div>
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
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (hamburger && sidebar && overlay) {
        hamburger.addEventListener('click', () => {
            sidebar.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        });
    }
</script>
</body>
</html>
