<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <link rel="stylesheet" href="/css/laporan.css">
  <title>LingkunganKU - Laporan</title>
  <meta name="description" content="Daftar semua laporan masalah lingkungan.">
  <script src="/js/clarity.js"></script>
</head>
<body class="page-laporan">

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>

  <main>
    <div class="laporan-page">

      {{-- Header halaman --}}
      <div class="laporan-page-header">
        <div class="laporan-page-header-text">
          <h1>Laporan Lingkungan</h1>
          <p>Lihat, cari, dan pantau laporan masalah lingkungan di sekitar Anda.</p>
        </div>
        <a href="/buat-laporan" class="laporan-btn-buat">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2.5"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
          </svg>
          Buat Laporan
        </a>
      </div>

      {{-- Filter + Pencarian --}}
      <div class="laporan-controls">
        <nav aria-label="Filter Status Laporan">
          <ul class="laporan-filter-tabs">
            <li>
              <a href="/laporan"
                 {{ $statusAktif === '' ? 'aria-current=page' : '' }}>
                Semua
              </a>
            </li>
            <li>
              <a href="/laporan?status=baru"
                 {{ $statusAktif === 'baru' ? 'aria-current=page' : '' }}>
                Baru
              </a>
            </li>
            <li>
              <a href="/laporan?status=diproses"
                 {{ $statusAktif === 'diproses' ? 'aria-current=page' : '' }}>
                Diproses
              </a>
            </li>
            <li>
              <a href="/laporan?status=selesai"
                 {{ $statusAktif === 'selesai' ? 'aria-current=page' : '' }}>
                Selesai
              </a>
            </li>
            <li>
              <a href="/laporan?status=ditolak"
                 {{ $statusAktif === 'ditolak' ? 'aria-current=page' : '' }}>
                Ditolak
              </a>
            </li>
          </ul>
        </nav>

        <form class="laporan-search-form" action="/laporan" method="get" role="search">
          @if ($statusAktif)
            <input type="hidden" name="status" value="{{ $statusAktif }}">
          @endif
          <label for="cari-laporan" class="sr-only">Cari Laporan</label>
          <div class="laporan-search-wrap">
            <svg class="laporan-search-icon" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="search" id="cari-laporan" name="q" class="laporan-search-input"
                   value="{{ $cariAktif }}"
                   placeholder="Cari laporan...">
          </div>
          <button type="submit" class="laporan-search-btn">Cari</button>
        </form>
      </div>

      {{-- Daftar Laporan dari Database --}}
      @if ($laporan->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:#94a3b8;">
          <div style="font-size:48px;margin-bottom:16px;">📋</div>
          <h3 style="font-size:18px;color:#475569;margin-bottom:8px;">
            @if ($cariAktif)
              Tidak ada laporan untuk "{{ $cariAktif }}"
            @elseif ($statusAktif)
              Belum ada laporan dengan status "{{ ucfirst($statusAktif) }}"
            @else
              Belum ada laporan
            @endif
          </h3>
          <p style="font-size:14px;">
            @if ($cariAktif || $statusAktif)
              <a href="/laporan" style="color:#3b82f6;">Lihat semua laporan</a>
            @else
              Jadilah yang pertama melaporkan masalah lingkungan.
              <a href="/buat-laporan" style="color:#3b82f6;">Buat laporan</a>
            @endif
          </p>
        </div>
      @else
        <ul class="laporan-list" aria-label="Daftar semua laporan">
          @foreach ($laporan as $item)
          <li>
            <a href="/detail-laporan?id={{ $item->id }}" class="laporan-item-link">
              <article class="laporan-item-card">
                <div class="laporan-item-img-wrap">
                  @if ($item->foto)
                    <img src="{{ $item->foto_url }}"
                         alt="Foto laporan {{ $item->judul }}"
                         class="laporan-item-img" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                  @else
                    {{-- Ikon placeholder berdasarkan kategori --}}
                    @php
                      $ikon = match(strtolower($item->kategori)) {
                        'jalan', 'jalan raya', 'infrastruktur' => '🛣️',
                        'sampah', 'kebersihan'                 => '🗑️',
                        'lampu jalan', 'fasilitas umum'        => '💡',
                        'selokan', 'sanitasi', 'drainase'      => '🌊',
                        'taman', 'ruang terbuka'               => '🌳',
                        default                                => '📍',
                      };
                    @endphp
                    <div class="laporan-item-img" style="display:flex;align-items:center;justify-content:center;font-size:48px;background:#f1f5f9;">
                      {{ $ikon }}
                    </div>
                  @endif
                  <div class="laporan-item-placeholder" aria-hidden="true"
                       style="{{ $item->foto ? 'display:none' : '' }}">
                    <span class="laporan-item-placeholder-text">Foto Laporan</span>
                  </div>
                </div>

                <div class="laporan-item-body">
                  <h2 class="laporan-item-title">{{ $item->judul }}</h2>
                  <p class="laporan-item-kategori">{{ $item->kategori }}</p>
                  <p class="laporan-item-lokasi">Lokasi: {{ $item->lokasi }}</p>
                  <p class="laporan-item-meta">
                    {{ $item->created_at->diffForHumans() }}
                  </p>
                  <span class="laporan-item-badge badge--{{ $item->status }}">
                    @php
                      $labelStatus = [
                        'baru'     => '🔔 Baru',
                        'diproses' => '⏳ Diproses',
                        'selesai'  => '✅ Selesai',
                        'ditolak'  => '❌ Ditolak',
                      ];
                    @endphp
                    {{ $labelStatus[$item->status] ?? ucfirst($item->status) }}
                  </span>
                </div>
              </article>
            </a>
          </li>
          @endforeach
        </ul>

        {{-- Pagination --}}
        @if ($laporan->hasPages())
          <div style="margin-top:32px;display:flex;justify-content:center;gap:8px;flex-wrap:wrap;">
            {{-- Previous --}}
            @if ($laporan->onFirstPage())
              <span style="padding:8px 14px;border-radius:8px;background:#f1f5f9;color:#94a3b8;font-size:13px;">← Sebelumnya</span>
            @else
              <a href="{{ $laporan->previousPageUrl() }}"
                 style="padding:8px 14px;border-radius:8px;background:white;border:1px solid #e2e8f0;color:#374151;font-size:13px;text-decoration:none;">
                ← Sebelumnya
              </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($laporan->getUrlRange(1, $laporan->lastPage()) as $page => $url)
              @if ($page == $laporan->currentPage())
                <span style="padding:8px 14px;border-radius:8px;background:#3b82f6;color:white;font-size:13px;font-weight:700;">{{ $page }}</span>
              @else
                <a href="{{ $url }}"
                   style="padding:8px 14px;border-radius:8px;background:white;border:1px solid #e2e8f0;color:#374151;font-size:13px;text-decoration:none;">
                  {{ $page }}
                </a>
              @endif
            @endforeach

            {{-- Next --}}
            @if ($laporan->hasMorePages())
              <a href="{{ $laporan->nextPageUrl() }}"
                 style="padding:8px 14px;border-radius:8px;background:white;border:1px solid #e2e8f0;color:#374151;font-size:13px;text-decoration:none;">
                Selanjutnya →
              </a>
            @else
              <span style="padding:8px 14px;border-radius:8px;background:#f1f5f9;color:#94a3b8;font-size:13px;">Selanjutnya →</span>
            @endif
          </div>
          <p style="text-align:center;margin-top:12px;font-size:12.5px;color:#94a3b8;">
            Menampilkan {{ $laporan->firstItem() }}–{{ $laporan->lastItem() }} dari {{ $laporan->total() }} laporan
          </p>
        @endif
      @endif

    </div>
  </main>

</body>
</html>
