<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Detail Penanganan</title>
  <meta name="description" content="Halaman detail proses penanganan laporan oleh petugas terkait.">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/detail-penanganan.css?v=1">
  <style>
    /* ── Detail Penanganan — Desktop Layout ── */

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
      grid-template-columns: 1fr 400px;
      gap: var(--space-6);
      align-items: start;
    }

    /* Kolom kiri dan kanan susun vertical sendiri */
    .kolom-kiri {
      display: flex;
      flex-direction: column;
      gap: var(--space-6);
    }

    .kolom-kanan {
      display: flex;
      flex-direction: column;
      gap: var(--space-6);
    }

    /* ── Foto Penanganan ── */
    section[aria-labelledby="foto-penanganan-heading"] h2 {
      display: none;
    }

    section[aria-labelledby="foto-penanganan-heading"] figure {
      margin: 0;
    }

    section[aria-labelledby="foto-penanganan-heading"] figure img {
      width: 100%;
      height: 480px;
      max-height: none;
      object-fit: cover;
      object-position: center;
      border-radius: var(--radius-xl);
      display: block;
    }

    section[aria-labelledby="foto-penanganan-heading"] figcaption {
      font-size: var(--font-size-xs);
      color: var(--color-text-muted);
      margin-top: var(--space-2);
    }

    /* ── Info Petugas ── */
    section[aria-labelledby="info-petugas-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="info-petugas-heading"] h2 {
      font-size: var(--font-size-md);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-4);
    }

    section[aria-labelledby="info-petugas-heading"] table {
      box-shadow: none; border: none; border-radius: 0; margin-bottom: 0;
    }

    section[aria-labelledby="info-petugas-heading"] caption { display: none; }

    section[aria-labelledby="info-petugas-heading"] th[scope="row"] {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-semibold);
      color: var(--color-text-muted);
      background: transparent;
      width: 38%;
      padding: var(--space-2) var(--space-3) var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-petugas-heading"] td {
      font-size: var(--font-size-sm);
      color: var(--color-text);
      padding: var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-petugas-heading"] tr:last-child th,
    section[aria-labelledby="info-petugas-heading"] tr:last-child td { border-bottom: none; }

    /* ── Info Laporan ── */
    section[aria-labelledby="info-laporan-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="info-laporan-heading"] h2 {
      font-size: var(--font-size-md);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-4);
    }

    section[aria-labelledby="info-laporan-heading"] table {
      box-shadow: none; border: none; border-radius: 0; margin-bottom: 0;
    }

    section[aria-labelledby="info-laporan-heading"] caption { display: none; }

    section[aria-labelledby="info-laporan-heading"] th[scope="row"] {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-semibold);
      color: var(--color-text-muted);
      background: transparent;
      width: 38%;
      padding: var(--space-2) var(--space-3) var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-laporan-heading"] td {
      font-size: var(--font-size-sm);
      color: var(--color-text);
      padding: var(--space-2) 0;
      border-bottom: 1px solid var(--color-border);
    }

    section[aria-labelledby="info-laporan-heading"] tr:last-child th,
    section[aria-labelledby="info-laporan-heading"] tr:last-child td { border-bottom: none; }

    /* ── Proses Penanganan ── */
    section[aria-labelledby="proses-heading"] {
      background: var(--color-white);
      border-radius: var(--radius-xl);
      border: 1px solid var(--color-border);
      padding: var(--space-6);
      box-shadow: var(--shadow-sm);
    }

    section[aria-labelledby="proses-heading"] h2 {
      font-size: var(--font-size-md);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-4);
    }

    section[aria-labelledby="proses-heading"] > p {
      font-size: var(--font-size-sm);
      color: var(--color-text-secondary);
      line-height: 1.7;
      margin-bottom: var(--space-5);
    }

    /* Timeline */
    ol[aria-label="Tahapan proses penanganan"] {
      list-style: none;
      position: relative;
      padding-left: 0;
      margin: 0;
    }

    ol[aria-label="Tahapan proses penanganan"] li {
      display: grid;
      grid-template-columns: 28px minmax(0, 1fr);
      align-items: center;
      column-gap: 12px;
      position: relative;
      margin-bottom: var(--space-5);
    }

    ol[aria-label="Tahapan proses penanganan"] li:last-child { margin-bottom: 0; }

    ol[aria-label="Tahapan proses penanganan"] li::before {
      content: none;
      display: none;
    }

    ol[aria-label="Tahapan proses penanganan"]::before {
      content: '';
      position: absolute;
      left: 13px;
      top: var(--timeline-top, 14px);
      height: var(--timeline-height, 0px);
      width: 2px;
      background: linear-gradient(to bottom, var(--color-selesai), var(--color-primary-light));
      border-radius: 2px;
      pointer-events: none;
    }

    ol[aria-label="Tahapan proses penanganan"] .timeline-indicator {
      grid-column: 1;
      grid-row: 1;
      width: 28px;
      height: 28px;
      background-color: var(--color-selesai);
      color: white;
      border-radius: var(--radius-full);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 700;
      border: 2px solid var(--color-white);
      box-shadow: 0 0 0 2px var(--color-selesai);
      z-index: 1;
    }

    ol[aria-label="Tahapan proses penanganan"] .timeline-indicator::before {
      content: '✓';
    }

    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--pending .timeline-indicator {
      background-color: #cbd5e1;
      box-shadow: 0 0 0 2px #cbd5e1;
    }

    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--pending .timeline-indicator::before,
    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--current .timeline-indicator::before {
      content: '';
    }

    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--pending h3 {
      color: #64748b;
    }

    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--current .timeline-indicator {
      background-color: #ffffff;
      box-shadow: 0 0 0 2px var(--color-primary);
    }

    ol[aria-label="Tahapan proses penanganan"] li.timeline-step--current h3 {
      color: var(--color-primary);
    }

    ol[aria-label="Tahapan proses penanganan"] article {
      grid-column: 2;
      grid-row: 1;
      background: var(--color-bg);
      border-radius: var(--radius-md);
      padding: var(--space-3) var(--space-4);
      border: 1px solid var(--color-border);
    }

    ol[aria-label="Tahapan proses penanganan"] h3 {
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-bold);
      color: var(--color-primary-dark);
      margin-bottom: var(--space-1);
    }

    ol[aria-label="Tahapan proses penanganan"] p {
      font-size: var(--font-size-xs);
      color: var(--color-text-secondary);
      margin-bottom: var(--space-1);
    }

    ol[aria-label="Tahapan proses penanganan"] time {
      font-size: var(--font-size-xs);
      color: var(--color-text-muted);
    }

    /* ── Tombol Kembali ── */
    section[aria-label="Navigasi Kembali"] {
      display: flex;
      align-items: center;
    }

    section[aria-label="Navigasi Kembali"] a {
      display: block;
      width: 100%;
    }

    section[aria-label="Navigasi Kembali"] button {
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

    section[aria-label="Navigasi Kembali"] button:hover {
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

      /* Lepas pembungkus kolom supaya urutan section bisa diatur satu aliran */
      .kolom-kiri,
      .kolom-kanan {
        display: contents;
      }

      body > main section {
        min-width: 0;
        overflow-wrap: anywhere;
      }

      /* Tombol kembali di bawah dipindah ke paling akhir */
      section[aria-label="Navigasi Kembali"] {
        order: 99;
      }

      /* Foto: bingkai 2:1 seperti cover */
      section[aria-labelledby="foto-penanganan-heading"] figure img {
        height: auto;
        aspect-ratio: 2 / 1;
        object-fit: cover;
        object-position: center;
      }

      body > main table {
        width: 100%;
        table-layout: fixed;
      }

      body > main th {
        width: 38%;
      }

      body > main th,
      body > main td {
        overflow-wrap: anywhere;
      }

      body > main li,
      body > main article {
        min-width: 0;
      }
    }
  
    /* ── Header gaya halaman Akun: ‹ Detail Penanganan, latar solid ── */
    body > header {
      flex-direction: row;
      align-items: center;
      gap: 0;
      background: #fff;
      background-color: #fff;
      border-bottom: 1px solid var(--color-border);
      box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
      padding: 14px 16px;
      position: sticky;
      top: 0;
      z-index: 100;
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
      margin: 0;
      font-size: 1.125rem;
      line-height: 1.2;
      color: inherit;
    }

    body > header nav a svg {
      display: block;
      flex-shrink: 0;
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

  <header>
    <nav aria-label="Navigasi Kembali ke Detail Laporan">
      <a href="/detail-laporan" id="link-kembali" aria-label="Kembali ke detail laporan">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
        <h1>Detail Penanganan</h1>
      </a>
    </nav>
  </header>

  <main>
    <div class="kolom-kiri">
      <!-- Foto Laporan -->
      <section aria-labelledby="foto-penanganan-heading">
        <h2 id="foto-penanganan-heading">Foto Laporan</h2>
        <figure>
          @if (isset($laporan) && $laporan->foto)
            <img id="foto-penanganan" src="{{ $laporan->foto_url }}" alt="Foto laporan {{ $laporan->judul }}">
            <figcaption id="foto-caption">Foto dokumentasi laporan.</figcaption>
          @elseif (isset($laporan))
            <p>Foto tidak disertakan pada laporan ini.</p>
          @else
            <img id="foto-penanganan" src="" alt="">
            <figcaption id="foto-caption"></figcaption>
          @endif
        </figure>
      </section>

      <!-- Informasi Laporan (deskripsi & GPS) -->
      <section aria-labelledby="info-laporan-heading">
        <h2 id="info-laporan-heading">Detail Laporan</h2>
        <table>
          <caption>Ringkasan detail laporan</caption>
          <tbody>
            <tr>
              <th scope="row">Deskripsi</th>
              <td id="laporan-deskripsi">@isset($laporan){{ $laporan->deskripsi }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Titik Lokasi</th>
              <td id="laporan-gps">
                @isset($laporan)
                  @if (preg_match('/\((-?\d+(?:\.\d+)?),\s*(-?\d+(?:\.\d+)?)\)/', $laporan->lokasi, $matches))
                    {{ $matches[1] }}, {{ $matches[2] }}
                  @else
                    {{ $laporan->lokasi }}
                  @endif
                @endisset
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Tombol Kembali -->
      <section aria-label="Navigasi Kembali">
        <a href="{{ isset($laporan) ? route('detail-laporan', ['id' => $laporan->id]) : '/detail-laporan' }}" id="link-kembali-bawah">
          <button type="button">Kembali</button>
        </a>
      </section>
    </div>

    <div class="kolom-kanan">
      <!-- Info Petugas -->
      <section aria-labelledby="info-petugas-heading">
        <h2 id="info-petugas-heading">Informasi Laporan</h2>
        <table>
          <caption>Informasi laporan yang ditangani</caption>
          <tbody>
            <tr>
              <th scope="row">Judul</th>
              <td id="petugas-judul">@isset($laporan){{ $laporan->judul }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Kategori</th>
              <td id="petugas-kategori">@isset($laporan){{ $laporan->kategori }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Lokasi</th>
              <td id="petugas-lokasi">@isset($laporan){{ $laporan->lokasi }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">Waktu</th>
              <td id="petugas-waktu">@isset($laporan){{ $laporan->created_at->diffForHumans() }}@endisset</td>
            </tr>
            <tr>
              <th scope="row">ID Laporan</th>
              <td id="petugas-id">@isset($laporan)#{{ $laporan->id }}@endisset</td>
            </tr>
          </tbody>
        </table>
      </section>

      <!-- Proses Penanganan -->
      <section aria-labelledby="proses-heading">
        <h2 id="proses-heading">Proses Penanganan</h2>
        <p id="proses-deskripsi">
          @isset($laporan)
            @if ($laporan->status === 'baru')
              Laporan ini baru diterima dan belum memiliki catatan penanganan dari petugas.
            @else
              Status laporan saat ini: {{ ucfirst($laporan->status) }}.
            @endif
          @endisset
        </p>

        @if (isset($laporan))
          @php
            $tahapAktif = match ($laporan->status) {
              'diproses' => 2,
              'selesai' => 3,
              'ditolak' => 1,
              default => 0,
            };
          @endphp
          <ol aria-label="Tahapan proses penanganan">
            <li class="timeline-step--complete">
              <span class="timeline-indicator" aria-hidden="true"></span>
              <article>
                <h3>Laporan Diterima</h3>
                <p>Laporan masuk dan tercatat di sistem.</p>
                <p><time datetime="{{ $laporan->created_at->timezone('Asia/Jakarta')->toIso8601String() }}">{{ $laporan->created_at->timezone('Asia/Jakarta')->format('d M Y, H.i') }} WIB</time></p>
              </article>
            </li>
            @foreach ([
              ['Survei Lokasi', 'Petugas akan memeriksa kondisi di lokasi laporan.'],
              [$laporan->status === 'ditolak' ? 'Laporan Ditolak' : 'Proses Penanganan', $laporan->status === 'ditolak' ? 'Laporan tidak dapat dilanjutkan.' : 'Petugas akan menindaklanjuti laporan.'],
              ['Selesai', 'Penanganan laporan telah selesai.'],
            ] as $index => [$judulTahap, $deskripsiTahap])
              @php
                $nomorTahap = $index + 1;
                $kelasTahap = $nomorTahap < $tahapAktif
                  ? 'timeline-step--complete'
                  : ($nomorTahap === $tahapAktif
                    ? ($laporan->status === 'selesai' ? 'timeline-step--complete' : 'timeline-step--current')
                    : 'timeline-step--pending');
              @endphp
              <li class="{{ $kelasTahap }}">
                <span class="timeline-indicator" aria-hidden="true"></span>
                <article>
                  <h3>{{ $judulTahap }}</h3>
                  <p>{{ $deskripsiTahap }}</p>
                  @if ($nomorTahap < $tahapAktif)
                    <p>Selesai</p>
                  @elseif ($nomorTahap === $tahapAktif)
                    <p>Sedang berlangsung</p>
                  @else
                    <p>Menunggu</p>
                  @endif
                </article>
              </li>
            @endforeach
          </ol>
        @else
        <ol aria-label="Tahapan proses penanganan">
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Laporan Diterima</h3>
              <p>Laporan masuk dan terverifikasi oleh sistem.</p>
              <p><time datetime="2026-10-07T08:00">07 Okt 2026, 08.00 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Survei Lokasi</h3>
              <p>Petugas melakukan survei kondisi lapangan di lokasi laporan.</p>
              <p><time datetime="2026-10-07T10:30">07 Okt 2026, 10.30 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Proses Penanganan</h3>
              <p>Tim penanganan mulai bekerja di lokasi.</p>
              <p><time datetime="2026-10-07T13:00">07 Okt 2026, 13.00 WIB</time></p>
            </article>
          </li>
          <li>
            <span class="timeline-indicator" aria-hidden="true"></span>
            <article>
              <h3>Selesai</h3>
              <p>Penanganan selesai dan lokasi siap digunakan kembali.</p>
              <p><time datetime="2026-10-08T16:00">08 Okt 2026, 16.00 WIB</time></p>
            </article>
          </li>
        </ol>
        @endif
      </section>
    </div>
  </main>

  @unless (isset($laporan))
  <script>
    // ── Data laporan (sama dengan detail-laporan.html) ──
    var DATA_LAPORAN = {
      'jalan-berlubang': {
        judul:      'Jalan Berlubang',
        foto:       './assets/images/laporan-jalan-berlubang.jpg',
        fotoAlt:    'Foto jalan berlubang',
        fotoCaption:'Kondisi jalan berlubang yang membahayakan pengguna jalan.',
        kategori:   'Infrastruktur',
        lokasi:     'Jl. Kemanggisan Raya, Palmerah',
        waktu:      '2 Jam yang lalu',
        id:         '#LK-12.037',
        deskripsi:  'Terdapat lubang besar di tengah jalan sepanjang kurang lebih 1 meter dengan kedalaman 20 cm. Kondisi ini sangat membahayakan pengendara motor dan mobil yang melintas.',
        gps:        '-6.1702, 106.8137',
        prosesDeskripsi: 'Tim petugas dari Dinas Pekerjaan Umum telah melakukan pengecekan lapangan dan memulai proses penambalan jalan berlubang menggunakan aspal hotmix.'
      },
      'lampu-jalan-mati': {
        judul:      'Lampu Jalan Mati',
        foto:       './assets/images/laporan-lampu-jalan-mati.jpg',
        fotoAlt:    'Foto lampu jalan mati',
        fotoCaption:'Lampu jalan yang tidak menyala dan berbahaya di malam hari.',
        kategori:   'Fasilitas Umum',
        lokasi:     'Jl. Sudirman, Menteng, Jakarta Pusat',
        waktu:      '3 Jam yang lalu',
        id:         '#LK-12.038',
        deskripsi:  'Terdapat 3 titik lampu jalan yang tidak menyala sejak 2 hari lalu, menyebabkan jalan gelap dan berbahaya bagi pengendara maupun pejalan kaki.',
        gps:        '-6.2088, 106.8456',
        prosesDeskripsi: 'Tim PLN dan Dinas Penerangan Jalan telah melakukan pengecekan dan penggantian lampu di 3 titik yang bermasalah.'
      },
      'sampah-menumpuk': {
        judul:      'Sampah Menumpuk',
        foto:       './assets/images/laporan-sampah-menumpuk.jpg',
        fotoAlt:    'Foto sampah menumpuk',
        fotoCaption:'Tumpukan sampah yang tidak diangkut selama beberapa hari.',
        kategori:   'Kebersihan',
        lokasi:     'Jl. Mangga Besar, Taman Sari, Jakarta Barat',
        waktu:      '6 Jam yang lalu',
        id:         '#LK-12.039',
        deskripsi:  'Sampah menumpuk di pinggir jalan sudah lebih dari 3 hari tidak diangkut oleh petugas kebersihan, menyebabkan bau tidak sedap.',
        gps:        '-6.1475, 106.8221',
        prosesDeskripsi: 'Tim kebersihan dari Dinas Lingkungan Hidup telah ditugaskan untuk membersihkan area tumpukan sampah.'
      },
      'sampah-menumpuk-ditolak': {
        judul:      'Sampah Menumpuk',
        foto:       './assets/images/laporan-sampah-menumpuk.jpg',
        fotoAlt:    'Foto sampah menumpuk',
        fotoCaption:'Laporan ini ditolak karena foto tidak jelas.',
        kategori:   'Kebersihan',
        lokasi:     'Jl. Cempaka Putih, Jakarta Pusat',
        waktu:      '2 Hari yang lalu',
        id:         '#LK-12.040',
        deskripsi:  'Laporan ditolak karena foto tidak jelas dan lokasi tidak dapat diverifikasi.',
        gps:        '-6.1620, 106.8553',
        prosesDeskripsi: 'Laporan ini tidak dapat diproses karena tidak memenuhi syarat pelaporan.'
      },
      'selokan-tersumbat': {
        judul:      'Selokan Tersumbat',
        foto:       './assets/images/laporan-selokan-tersumbat.jpg',
        fotoAlt:    'Foto selokan tersumbat',
        fotoCaption:'Selokan tersumbat yang menyebabkan genangan air.',
        kategori:   'Sanitasi',
        lokasi:     'Jl. Kramat Jati, Jakarta Timur',
        waktu:      '12 Jam yang lalu',
        id:         '#LK-12.041',
        deskripsi:  'Selokan tersumbat oleh sampah dan lumpur sehingga air tidak dapat mengalir, menyebabkan genangan di area warga.',
        gps:        '-6.2649, 106.8527',
        prosesDeskripsi: 'Tim dari Dinas Pekerjaan Umum telah ditugaskan untuk membersihkan saluran air yang tersumbat.'
      },
      'selokan-tersumbat-ditolak': {
        judul:      'Selokan Tersumbat',
        foto:       './assets/images/laporan-selokan-tersumbat.jpg',
        fotoAlt:    'Foto selokan tersumbat',
        fotoCaption:'Laporan ditolak karena duplikasi.',
        kategori:   'Sanitasi',
        lokasi:     'Jl. Kramat Jati, Jakarta Timur',
        waktu:      '4 Hari yang lalu',
        id:         '#LK-12.042',
        deskripsi:  'Laporan ditolak karena merupakan duplikasi dari laporan yang sudah ada sebelumnya.',
        gps:        '-6.2649, 106.8527',
        prosesDeskripsi: 'Laporan ini tidak dapat diproses karena merupakan duplikasi.'
      }
    };

    // ── Baca parameter URL ──
    var params    = new URLSearchParams(window.location.search);
    var idLaporan = params.get('id') || 'jalan-berlubang';

    var laporan = DATA_LAPORAN[idLaporan] || DATA_LAPORAN['jalan-berlubang'];

    // ── Isi konten halaman ──
    document.getElementById('foto-penanganan').src = laporan.foto;
    document.getElementById('foto-penanganan').alt = laporan.fotoAlt;
    document.getElementById('foto-caption').textContent = laporan.fotoCaption;

    document.getElementById('petugas-judul').textContent    = laporan.judul;
    document.getElementById('petugas-kategori').textContent = laporan.kategori;
    document.getElementById('petugas-lokasi').textContent   = laporan.lokasi;
    document.getElementById('petugas-waktu').textContent    = laporan.waktu;
    document.getElementById('petugas-id').textContent       = laporan.id;

    document.getElementById('laporan-deskripsi').textContent = laporan.deskripsi;
    document.getElementById('laporan-gps').textContent       = laporan.gps;
    document.getElementById('proses-deskripsi').textContent  = laporan.prosesDeskripsi;

    // ── Tombol kembali: kembali ke detail laporan dengan id yang sama ──
    var urlKembali = '/detail-laporan?id=' + idLaporan;
    document.getElementById('link-kembali').href       = urlKembali;
    document.getElementById('link-kembali-bawah').href = urlKembali;

    // ── Update title halaman ──
    document.title = 'LingkunganKU - Penanganan ' + laporan.judul;
  </script>
  @endunless

  <script>
    const updateTimelineLines = () => {
      document.querySelectorAll('ol[aria-label="Tahapan proses penanganan"]').forEach((timeline) => {
        const indicators = timeline.querySelectorAll('.timeline-indicator');
        if (indicators.length < 2) return;

        const timelineTop = timeline.getBoundingClientRect().top;
        const first = indicators[0].getBoundingClientRect();
        const last = indicators[indicators.length - 1].getBoundingClientRect();
        const start = first.top + first.height / 2 - timelineTop;
        const end = last.top + last.height / 2 - timelineTop;

        timeline.style.setProperty('--timeline-top', `${start}px`);
        timeline.style.setProperty('--timeline-height', `${Math.max(0, end - start)}px`);
      });
    };

    updateTimelineLines();
    window.addEventListener('resize', updateTimelineLines);
    if ('ResizeObserver' in window) {
      document.querySelectorAll('ol[aria-label="Tahapan proses penanganan"]').forEach((timeline) => {
        new ResizeObserver(updateTimelineLines).observe(timeline);
      });
    }
  </script>

  <script>
    // Tombol kembali di header: samakan tujuannya dengan tombol kembali di bawah
    (function () {
      var atas  = document.getElementById('link-kembali');
      var bawah = document.getElementById('link-kembali-bawah');
      if (!atas) { return; }
      if (bawah && bawah.getAttribute('href')) {
        atas.setAttribute('href', bawah.getAttribute('href'));
      } else {
        var id = new URLSearchParams(window.location.search).get('id');
        atas.setAttribute('href', '/detail-laporan' + (id ? '?id=' + encodeURIComponent(id) : ''));
      }
    })();
  </script>
</body>
</html>
