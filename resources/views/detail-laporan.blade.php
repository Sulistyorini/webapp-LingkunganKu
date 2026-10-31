<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Detail Laporan</title>
  <meta name="description" content="Halaman detail laporan masalah lingkungan beserta informasi lokasi dan status.">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/detail-laporan.css?v=1">
  <link rel="stylesheet" href="/css/proses-penanganan.css?v=1">
  <style>
    /* ── Detail Laporan — Desktop Layout ── */

    body {
      background-color: var(--color-bg);
    }

    /* Header */
    body > header {
      background-color: transparent;
      border-bottom: none;
      padding-top: var(--space-4);
      padding-bottom: var(--space-4);
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: none;
      display: flex;
      align-items: center;
      gap: var(--space-4);
    }

    body > header nav a {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-medium);
      color: var(--color-primary);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: var(--space-1);
    }

    body > header nav a:hover { text-decoration: underline; }

    body > header h1 {
      font-size: var(--font-size-lg);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary);
      margin-bottom: 0;
    }

    /* Main container — desktop dua kolom dengan flex independen */
    body > main {
      max-width: 1100px;
      margin: 0 auto;
      padding: var(--space-8) var(--space-6);
      display: grid;
      grid-template-columns: 1fr 380px;
      grid-template-rows: 1fr;
      gap: var(--space-6);
      align-items: start;
    }

    /* Kolom kiri: foto + deskripsi + tombol — susun vertical sendiri */
    .kolom-kiri {
      display: flex;
      flex-direction: column;
      gap: var(--space-6);
    }

    /* Kolom kanan: judul+status + info detail — susun vertical sendiri dari atas */
    .kolom-kanan {
      display: flex;
      flex-direction: column;
      gap: var(--space-6);
    }

    /* ── Foto Laporan ── */
    section[aria-labelledby="foto-laporan-heading"] h2 {
      display: none;
    }

    section[aria-labelledby="foto-laporan-heading"] figure {
      margin: 0;
    }

    section[aria-labelledby="foto-laporan-heading"] figure img {
      width: 100%;
      height: 500px;
      max-height: none;
      object-fit: cover;
      object-position: center;
      border-radius: var(--radius-xl);
      display: block;
    }

    section[aria-labelledby="foto-laporan-heading"] figcaption {
      font-size: var(--font-size-xs);
      color: var(--color-text-muted);
      margin-top: var(--space-2);
      text-align: left;
    }

    /* ── Info Utama (kanan atas) ── */
    section[aria-labelledby="info-utama-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="info-utama-heading"] h2 {
      font-size: var(--font-size-xl);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-3);
    }

    section[aria-labelledby="info-utama-heading"] p {
      display: flex;
      align-items: center;
      gap: var(--space-2);
      font-size: var(--font-size-sm);
      color: var(--color-text-secondary);
      margin-bottom: var(--space-2);
    }

    section[aria-labelledby="info-utama-heading"] p strong {
      color: var(--color-text);
      font-weight: var(--font-weight-semibold);
    }

    section[aria-labelledby="info-utama-heading"] mark {
      padding: var(--space-1) var(--space-3);
      border-radius: var(--radius-full);
      font-size: var(--font-size-xs);
      font-weight: var(--font-weight-semibold);
    }

    .mark-diproses { background-color: var(--color-diproses-bg); color: var(--color-diproses); }
    .mark-selesai  { background-color: var(--color-selesai-bg);  color: var(--color-selesai); }
    .mark-menunggu { background-color: var(--color-menunggu-bg); color: var(--color-menunggu); }
    .mark-ditolak  { background-color: var(--color-ditolak-bg);  color: var(--color-ditolak); }

    /* ── Deskripsi ── */
    section[aria-labelledby="deskripsi-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="deskripsi-heading"] h2 {
      font-size: var(--font-size-md);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-3);
    }

    section[aria-labelledby="deskripsi-heading"] p {
      font-size: var(--font-size-base);
      color: var(--color-text-secondary);
      line-height: 1.7;
      margin-bottom: 0;
    }

    /* ── Info Detail (kanan bawah) ── */
    section[aria-labelledby="info-detail-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="info-detail-heading"] h2 {
      font-size: var(--font-size-md);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-4);
    }

    section[aria-labelledby="info-detail-heading"] table {
      box-shadow: none;
      border: none;
      border-radius: 0;
      margin-bottom: 0;
    }

    section[aria-labelledby="info-detail-heading"] caption {
      display: none;
    }

    section[aria-labelledby="info-detail-heading"] th[scope="row"] {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-semibold);
      color: var(--color-text-muted);
      background: transparent;
      width: 40%;
      padding: var(--space-2) var(--space-3) var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-detail-heading"] td {
      font-size: var(--font-size-sm);
      color: var(--color-text);
      padding: var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-detail-heading"] tr:last-child th,
    section[aria-labelledby="info-detail-heading"] tr:last-child td {
      border-bottom: none;
    }

    /* ── Tombol Aksi ── */
    section[aria-label="Aksi Laporan"] {
      display: flex;
      align-items: center;
    }

    section[aria-label="Aksi Laporan"] a {
      display: block;
      width: 100%;
    }

    section[aria-label="Aksi Laporan"] button {
      width: 100%;
      padding: var(--space-4) var(--space-6);
      font-size: var(--font-size-base);
      font-weight: var(--font-weight-bold);
      background-color: var(--color-primary);
      color: var(--color-white);
      border: none;
      border-radius: var(--radius-full);
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(37,99,235,0.35);
      transition: background-color 0.2s, box-shadow 0.2s;
      margin-top: 0;
    }

    section[aria-label="Aksi Laporan"] button:hover {
      background-color: var(--color-primary-dark);
      box-shadow: 0 6px 20px rgba(37,99,235,0.45);
    }

    /* ── Responsif HP/tablet ── */
    @media (max-width: 768px) {
      body > main {
        grid-template-columns: minmax(0, 1fr);
        padding: var(--space-4);
        gap: var(--space-4);
      }

      .kolom-kiri,
      .kolom-kanan {
        min-width: 0;
        gap: var(--space-4);
      }

      section[aria-labelledby="foto-laporan-heading"] figure img {
        height: auto;
        aspect-ratio: 4 / 3;
        max-height: 320px;
      }

      body > main section {
        min-width: 0;
        overflow-wrap: anywhere;
      }

      body > main table {
        width: 100%;
        table-layout: fixed;
      }

      body > main td,
      body > main th {
        overflow-wrap: anywhere;
      }
    }

    /* ── Header: judul di atas, tombol < di bawahnya ── */
    body > header {
      flex-direction: column;
      align-items: flex-start;
      gap: var(--space-1);
    }

    body > header h1 {
      order: -1;
    }

    /* ── Foto tampil utuh sesuai aslinya ── */
    section[aria-labelledby="foto-laporan-heading"] figure img {
      width: 100%;
      height: auto;
      aspect-ratio: auto;
      max-height: 70vh;
      object-fit: contain;
      background: var(--color-bg);
    }

    /* ── Rapatkan judul dan tombol < ── */
    body > header {
      gap: 0;
      padding-bottom: var(--space-2);
    }

    body > header h1,
    body > header nav {
      margin: 0;
      line-height: 1.2;
    }

    /* ── Foto detail mengikuti bingkai cover kartu (rasio 2:1, crop tengah) ── */
    section[aria-labelledby="foto-laporan-heading"] figure img {
      width: 100%;
      height: auto;
      aspect-ratio: 2 / 1;
      max-height: none;
      object-fit: cover;
      object-position: center;
      background: linear-gradient(135deg, #dbeafe 0%, #dcfce7 100%);
    }
  
    /* ── Header gaya halaman Akun: ‹ Detail Laporan dalam satu baris ── */
    body > header {
      flex-direction: row;
      align-items: center;
      gap: 0;
      background: #fff;
      border-bottom: 1px solid var(--color-border);
      padding: 14px 16px;
    }

    body > header nav {
      margin: 0;
    }

    body > header nav a {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      color: var(--color-primary);
      font-weight: 700;
      text-decoration: none;
    }

    body > header nav a h1 {
      order: 0;
      margin: 0;
      font-size: 1.125rem;
      line-height: 1.2;
      color: inherit;
    }

    body > header nav a svg {
      flex-shrink: 0;
    }
  
    /* Header penuh selebar layar, isi sejajar dengan konten */
    body > header {
      width: 100%;
      max-width: none;
      margin: 0;
      box-sizing: border-box;
      padding: 14px max(var(--space-6), calc((100% - 1100px) / 2 + var(--space-6)));
    }
  
    /* Header seragam: selebar layar, tinggi sama dengan navbar menu (54px) */
    body > header {
      width: 100%;
      max-width: none;
      margin: 0;
      box-sizing: border-box;
      height: 54px;
      padding-top: 0;
      padding-bottom: 0;
      padding-left: max(var(--space-6), calc((100% - 1100px) / 2 + var(--space-6)));
      padding-right: max(var(--space-6), calc((100% - 1100px) / 2 + var(--space-6)));
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    body > header nav a h1 {
      font-size: 1.05rem;
      line-height: 1.2;
    }
  </style>
  <script src="/js/clarity.js"></script>
<script>(function(c,l,a,r,i,t,y){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};t=l.createElement(r);t.async=1;t.src='https://www.clarity.ms/tag/'+i;y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);})(window,document,'clarity','script','z4r4xbuiu3');</script>
</head>
<body>

  @if (isset($laporan))
    @php
      $labelStatus = [
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
      ];
      $kelasStatus = [
        'baru' => 'mark-menunggu',
        'diproses' => 'mark-diproses',
        'selesai' => 'mark-selesai',
        'ditolak' => 'mark-ditolak',
      ];
      $namaPelapor = $laporan->nama_pelapor ?: ($laporan->user?->name ?? 'Warga');
      $koordinat = 'Tidak tersedia';
      if (preg_match('/\((-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)\)/', $laporan->lokasi, $matches)) {
        $koordinat = $matches[1] . ', ' . $matches[2];
      }
    @endphp
  @endif

  <header>
    <nav aria-label="Navigasi Kembali">
      <a href="/laporan" id="link-kembali" aria-label="Kembali">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        <h1>Detail Laporan</h1>
      </a>
    </nav>
  </header>

  <div id="area-detail">
  <main>
    <div class="kolom-kiri">
      <!-- Foto Laporan -->
      <section aria-labelledby="foto-laporan-heading">
        <h2 id="foto-laporan-heading">Foto Laporan</h2>
        <figure>
          @if (isset($laporan))
            @if ($laporan->foto)
              <img id="foto-laporan" src="{{ $laporan->foto_url }}"
                   alt="Foto laporan {{ $laporan->judul }}" width="360">
              <figcaption id="foto-caption">Foto dokumentasi laporan.</figcaption>
            @else
              <p>Foto tidak disertakan pada laporan ini.</p>
            @endif
          @else
            <img id="foto-laporan" src="" alt="" width="360">
            <figcaption id="foto-caption"></figcaption>
          @endif
        </figure>
      </section>

      <!-- Deskripsi Laporan -->
      <section aria-labelledby="deskripsi-heading">
        <h2 id="deskripsi-heading">Deskripsi Laporan</h2>
        <p id="deskripsi-laporan">@isset($laporan){{ $laporan->deskripsi }}@endisset</p>
      </section>

      <!-- Tombol Aksi -->
      <section aria-label="Aksi Laporan">
        <a href="/detail-penanganan{{ isset($laporan) ? '?id=' . $laporan->id : '' }}" id="link-penanganan">
          <button type="button">Lihat Detail Penanganan</button>
        </a>
      </section>
    </div>

    <div class="kolom-kanan">
      <!-- Judul dan Status -->
      <section aria-labelledby="info-utama-heading">
        <h2 id="info-utama-heading">@isset($laporan){{ $laporan->judul }}@endisset</h2>
        <p><strong>Status:</strong>
          <mark id="status-laporan" @isset($laporan) class="{{ $kelasStatus[$laporan->status] ?? 'mark-menunggu' }}" @endisset>
            @isset($laporan){{ $labelStatus[$laporan->status] ?? ucfirst($laporan->status) }}@endisset
          </mark>
        </p>
        <p id="lokasi-laporan">@isset($laporan)Lokasi: {{ $laporan->lokasi }}@endisset</p>
        <p id="waktu-laporan">@isset($laporan)Waktu: {{ $laporan->created_at->diffForHumans() }}@endisset</p>
      </section>

      <!-- Informasi Detail -->
      <section aria-labelledby="info-detail-heading">
        <h2 id="info-detail-heading">Informasi Detail</h2>
        <table>
          <caption>Detail informasi laporan</caption>
          <tbody>
            <tr>
              <th scope="row">Kategori</th>
              <td id="detail-kategori">@isset($laporan){{ $laporan->kategori }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">ID Laporan</th>
              <td id="detail-id">@isset($laporan)#{{ $laporan->id }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Dilaporkan</th>
              <td id="detail-dilaporkan">@isset($laporan){{ $namaPelapor }}, {{ $laporan->created_at->diffForHumans() }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Lokasi GPS</th>
              <td id="detail-gps">@isset($laporan){{ $koordinat }}@endisset</td>
            </tr>
          </tbody>
        </table>
      </section>
    </div>
  </main>
    <aside id="panel-proses" aria-label="Proses penanganan laporan">
      @include('partials.proses-penanganan')
    </aside>
  </div>

  @unless (isset($laporan))
  <script>
    // ── Data semua laporan ──
    var DATA_LAPORAN = {
      'jalan-berlubang': {
        judul:       'Jalan Berlubang',
        foto:        './assets/images/laporan-jalan-berlubang.jpg',
        fotoAlt:     'Foto jalan berlubang di Jl. Kemanggisan Raya, Palmerah',
        fotoCaption: 'Kondisi jalan berlubang yang membahayakan pengguna jalan.',
        status:      'Diproses',
        statusKelas: 'mark-diproses',
        lokasi:      'Jl. Kemanggisan Raya, Palmerah',
        waktu:       '2 Jam yang lalu',
        deskripsi:   'Terdapat lubang besar di tengah jalan sepanjang kurang lebih 1 meter dengan kedalaman 20 cm. Kondisi ini sangat membahayakan pengendara motor dan mobil yang melintas, terutama pada malam hari karena minimnya penerangan di lokasi tersebut.',
        kategori:    'Infrastruktur',
        id:          '#LK-12.037',
        dilaporkan:  'Budi Santoso, 2 Jam yang lalu',
        gps:         '-6.1702, 106.8137',
        sumberHalaman: '/laporan'
      },
      'jalan-berlubang-selesai': {
        judul:       'Jalan Berlubang',
        foto:        './assets/images/laporan-jalan-berlubang.jpg',
        fotoAlt:     'Foto jalan berlubang di Jl. Kemanggisan Raya, Palmerah',
        fotoCaption: 'Kondisi jalan berlubang yang telah selesai diperbaiki.',
        status:      'Selesai',
        statusKelas: 'mark-selesai',
        lokasi:      'Jl. Kemanggisan Raya, Palmerah',
        waktu:       '3 Hari yang lalu',
        deskripsi:   'Laporan jalan berlubang telah ditangani dan kondisi jalan sudah diperbaiki.',
        kategori:    'Infrastruktur',
        id:          '#LK-12.043',
        dilaporkan:  'Warga Palmerah, 3 Hari yang lalu',
        gps:         '-6.1702, 106.8137',
        sumberHalaman: '/laporan?status=selesai'
      },
      'lampu-jalan-mati': {
        judul:       'Lampu Jalan Mati',
        foto:        './assets/images/laporan-lampu-jalan-mati.jpg',
        fotoAlt:     'Foto laporan lampu jalan mati di Jl. Sudirman',
        fotoCaption: 'Lampu jalan yang tidak menyala dan membahayakan pengguna jalan di malam hari.',
        status:      'Selesai',
        statusKelas: 'mark-selesai',
        lokasi:      'Jl. Sudirman, Menteng, Jakarta Pusat',
        waktu:       '3 Jam yang lalu',
        deskripsi:   'Terdapat 3 titik lampu jalan yang tidak menyala sejak 2 hari lalu. Kondisi ini menyebabkan jalan gelap dan berbahaya bagi pengendara maupun pejalan kaki pada malam hari.',
        kategori:    'Fasilitas Umum',
        id:          '#LK-12.038',
        dilaporkan:  'Siti Rahayu, 3 Jam yang lalu',
        gps:         '-6.2088, 106.8456',
        sumberHalaman: '/laporan'
      },
      'sampah-menumpuk': {
        judul:       'Sampah Menumpuk',
        foto:        './assets/images/laporan-sampah-menumpuk.jpg',
        fotoAlt:     'Foto laporan sampah menumpuk di pinggir jalan',
        fotoCaption: 'Tumpukan sampah yang tidak diangkut menyebabkan bau tidak sedap.',
        status:      'Diproses',
        statusKelas: 'mark-diproses',
        lokasi:      'Jl. Mangga Besar, Taman Sari, Jakarta Barat',
        waktu:       '6 Jam yang lalu',
        deskripsi:   'Sampah menumpuk di pinggir jalan sudah lebih dari 3 hari tidak diangkut oleh petugas kebersihan. Tumpukan sampah menyebabkan bau tidak sedap dan berpotensi menjadi sarang penyakit.',
        kategori:    'Kebersihan',
        id:          '#LK-12.039',
        dilaporkan:  'Ahmad Fauzi, 6 Jam yang lalu',
        gps:         '-6.1475, 106.8221',
        sumberHalaman: '/laporan'
      },
      'sampah-menumpuk-ditolak': {
        judul:       'Sampah Menumpuk',
        foto:        './assets/images/laporan-sampah-menumpuk.jpg',
        fotoAlt:     'Foto laporan sampah menumpuk yang ditolak',
        fotoCaption: 'Laporan ini ditolak karena foto tidak jelas.',
        status:      'Ditolak',
        statusKelas: 'mark-ditolak',
        lokasi:      'Jl. Cempaka Putih, Jakarta Pusat',
        waktu:       '2 Hari yang lalu',
        deskripsi:   'Sampah menumpuk di sekitar area perumahan. Laporan ditolak karena foto tidak jelas dan lokasi tidak dapat diverifikasi.',
        kategori:    'Kebersihan',
        id:          '#LK-12.040',
        dilaporkan:  'Dewi Lestari, 2 Hari yang lalu',
        gps:         '-6.1620, 106.8553',
        sumberHalaman: '/laporan'
      },
      'selokan-tersumbat': {
        judul:       'Selokan Tersumbat',
        foto:        './assets/images/laporan-selokan-tersumbat.jpg',
        fotoAlt:     'Foto laporan selokan tersumbat',
        fotoCaption: 'Selokan tersumbat yang menyebabkan genangan air.',
        status:      'Diproses',
        statusKelas: 'mark-diproses',
        lokasi:      'Jl. Kramat Jati, Jakarta Timur',
        waktu:       '12 Jam yang lalu',
        deskripsi:   'Selokan di depan rumah warga tersumbat oleh sampah dan lumpur sehingga air tidak dapat mengalir. Kondisi ini menyebabkan genangan air yang mengganggu aktivitas warga sekitar.',
        kategori:    'Sanitasi',
        id:          '#LK-12.041',
        dilaporkan:  'Rudi Hartono, 12 Jam yang lalu',
        gps:         '-6.2649, 106.8527',
        sumberHalaman: '/laporan'
      },
      'selokan-tersumbat-ditolak': {
        judul:       'Selokan Tersumbat',
        foto:        './assets/images/laporan-selokan-tersumbat.jpg',
        fotoAlt:     'Foto laporan selokan tersumbat yang ditolak',
        fotoCaption: 'Laporan ini ditolak karena merupakan duplikasi.',
        status:      'Ditolak',
        statusKelas: 'mark-ditolak',
        lokasi:      'Jl. Kramat Jati, Jakarta Timur',
        waktu:       '4 Hari yang lalu',
        deskripsi:   'Selokan tersumbat yang dilaporkan ternyata merupakan duplikasi dari laporan yang sudah ada sebelumnya.',
        kategori:    'Sanitasi',
        id:          '#LK-12.042',
        dilaporkan:  'Wati Sari, 4 Hari yang lalu',
        gps:         '-6.2649, 106.8527',
        sumberHalaman: '/laporan'
      }
    };

    // ── Baca parameter URL ──
    var params = new URLSearchParams(window.location.search);
    var idLaporan = params.get('id') || 'jalan-berlubang';
    var sumberHalaman = params.get('dari') || '/laporan';

    var laporan = DATA_LAPORAN[idLaporan] || DATA_LAPORAN['jalan-berlubang'];

    // ── Isi konten halaman ──
    document.getElementById('foto-laporan').src = laporan.foto;
    document.getElementById('foto-laporan').alt = laporan.fotoAlt;
    document.getElementById('foto-caption').textContent = laporan.fotoCaption;

    document.getElementById('info-utama-heading').textContent = laporan.judul;

    var markEl = document.getElementById('status-laporan');
    markEl.textContent = laporan.status;
    markEl.className = laporan.statusKelas;

    document.getElementById('lokasi-laporan').textContent = 'Lokasi: ' + laporan.lokasi;
    document.getElementById('waktu-laporan').textContent = 'Waktu: ' + laporan.waktu;
    document.getElementById('deskripsi-laporan').textContent = laporan.deskripsi;

    document.getElementById('detail-kategori').textContent = laporan.kategori;
    document.getElementById('detail-id').textContent = laporan.id;
    document.getElementById('detail-dilaporkan').textContent = laporan.dilaporkan;
    document.getElementById('detail-gps').textContent = laporan.gps;

    // ── Link kembali: ke halaman sumber ──
    document.getElementById('link-kembali').href = sumberHalaman;

    // ── Link penanganan: bawa id laporan ──
    document.getElementById('link-penanganan').href = '/detail-penanganan?id=' + idLaporan;

    // ── Update title halaman ──
    document.title = 'LingkunganKU - ' + laporan.judul;
  </script>
  @endunless

  <script src="/js/panel-penanganan.js?v=1"></script>
</body>
</html>
