<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Aplikasi v1.5 - LingkunganKU</title>
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <style>
    .pb-page {
      max-width: 720px;
      margin: 32px auto;
      padding: 0 20px 60px;
    }
    .pb-back {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #64748b;
      font-size: 13.5px;
      text-decoration: none;
      margin-bottom: 28px;
      transition: color .15s;
    }
    .pb-back:hover { color: #2563eb; }

    .pb-header {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 28px;
    }
    .pb-header-ikon {
      width: 72px;
      height: 72px;
      border-radius: 16px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eff6ff;
    }
    .pb-header-ikon img {
      width: 72px;
      height: 72px;
      object-fit: contain;
    }
    .pb-sumber {
      font-size: 12px;
      font-weight: 700;
      color: #2563eb;
      letter-spacing: .8px;
      text-transform: uppercase;
      margin-bottom: 6px;
    }
    .pb-judul {
      font-size: 22px;
      font-weight: 800;
      color: #0f172a;
      letter-spacing: -.4px;
      margin: 0 0 8px;
    }
    .pb-waktu { font-size: 12.5px; color: #94a3b8; }

    /* Badge versi */
    .pb-versi-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      padding: 10px 18px;
      border-radius: 30px;
      margin-bottom: 24px;
    }
    .pb-versi-badge .from { font-size: 14px; color: #94a3b8; font-weight: 600; }
    .pb-versi-badge .arrow { color: #94a3b8; }
    .pb-versi-badge .to { font-size: 16px; color: #1d4ed8; font-weight: 800; }

    /* Kartu fitur */
    .pb-card {
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .pb-card-head {
      padding: 14px 20px;
      background: #f8fafc;
      border-bottom: 1px solid #e2e8f0;
      font-size: 13px;
      font-weight: 700;
      color: #475569;
    }
    .pb-fitur-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 16px 20px;
      border-bottom: 1px solid #f1f5f9;
    }
    .pb-fitur-item:last-child { border-bottom: none; }
    .pb-fitur-ikon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }
    .pb-fitur-body { flex: 1; }
    .pb-fitur-nama {
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 3px;
    }
    .pb-fitur-desc {
      font-size: 13px;
      color: #64748b;
      line-height: 1.6;
      margin: 0;
    }
    .pb-tag {
      display: inline-block;
      padding: 2px 8px;
      border-radius: 20px;
      font-size: 10.5px;
      font-weight: 700;
      margin-left: 6px;
      vertical-align: middle;
    }
    .pb-tag.baru    { background: #dcfce7; color: #15803d; }
    .pb-tag.perbaikan { background: #dbeafe; color: #1d4ed8; }
    .pb-tag.performa  { background: #f3e8ff; color: #7c3aed; }

    .pb-body {
      font-size: 14.5px;
      color: #334155;
      line-height: 1.8;
      margin-bottom: 20px;
    }
    .pb-section-title {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
      margin: 28px 0 12px;
    }

    /* Info app */
    .pb-about {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 20px;
      background: white;
      border: 1px solid #e2e8f0;
      border-radius: 14px;
      margin-bottom: 20px;
    }
    .pb-about-logo {
      width: 64px;
      height: 64px;
      border-radius: 14px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #eff6ff;
    }
    .pb-about-logo img { width: 64px; height: 64px; object-fit: contain; }
    .pb-about-nama {
      font-size: 16px;
      font-weight: 800;
      color: #2563eb;
      margin-bottom: 2px;
    }
    .pb-about-sub { font-size: 12.5px; color: #94a3b8; }
    .pb-about-desc {
      font-size: 13.5px;
      color: #475569;
      line-height: 1.7;
      margin: 12px 0 0;
    }
    .pb-info-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid #f1f5f9;
      font-size: 13.5px;
    }
    .pb-info-row:last-child { border-bottom: none; }
    .pb-info-row span:first-child { color: #64748b; }
    .pb-info-row span:last-child  { color: #0f172a; font-weight: 600; }
  </style>
  <script src="/js/clarity.js"></script>
</head>
<body>

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>

  <main class="pb-page">

    <a href="/notifikasi?tab=info" class="pb-back">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 18l-6-6 6-6"/>
      </svg>
      Kembali ke Notifikasi
    </a>

    {{-- Header --}}
    <div class="pb-header">
      <div class="pb-header-ikon">
        <img src="/assets/images/logo.webp" alt="Logo LingkunganKU"
             onerror="this.parentNode.innerHTML='📱'">
      </div>
      <div>
        <p class="pb-sumber">LingkunganKU App</p>
        <h1 class="pb-judul">Pembaruan Aplikasi v1.5</h1>
        <span class="pb-waktu">📅 Kemarin, 14:13 &nbsp;·&nbsp; Tim LingkunganKU</span>
      </div>
    </div>

    {{-- Badge versi --}}
    <div class="pb-versi-badge">
      <span class="from">v1.0.0</span>
      <span class="arrow">→</span>
      <span class="to">v1.5.0</span>
    </div>

    <p class="pb-body">
      Kami dengan bangga mempersembahkan pembaruan besar LingkunganKU versi 1.5.
      Pembaruan ini membawa fitur-fitur baru, perbaikan bug, dan peningkatan performa
      berdasarkan masukan dari warga pengguna setia LingkunganKU.
    </p>

    {{-- Fitur baru --}}
    <h2 class="pb-section-title">✨ Fitur Baru</h2>
    <div class="pb-card">
      <div class="pb-card-head">🆕 &nbsp; Ditambahkan di versi ini</div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#dcfce7;">🔔</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Notifikasi Real-time <span class="pb-tag baru">Baru</span></div>
          <p class="pb-fitur-desc">Halaman notifikasi kini terhubung langsung ke database. Perubahan status laporan dari admin langsung muncul tanpa perlu refresh manual.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#dbeafe;">📋</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Halaman Semua Laporan Dinamis <span class="pb-tag baru">Baru</span></div>
          <p class="pb-fitur-desc">Daftar laporan di halaman Laporan kini diambil langsung dari database dengan filter status dan pencarian yang berfungsi penuh.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#fef9c3;">📍</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Data Lokasi Lengkap Kabupaten Nganjuk <span class="pb-tag baru">Baru</span></div>
          <p class="pb-fitur-desc">Dropdown kecamatan dan desa/kelurahan di form Buat Laporan kini berisi 20 kecamatan dan ratusan desa sesuai data asli Kabupaten Nganjuk.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#f3e8ff;">🖼️</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Preview Foto di Langkah 3 <span class="pb-tag baru">Baru</span></div>
          <p class="pb-fitur-desc">Foto yang diunggah di Langkah 1 kini otomatis tampil sebagai pratinjau di Langkah 3 (Konfirmasi) sebelum laporan dikirim.</p>
        </div>
      </div>
    </div>

    {{-- Perbaikan --}}
    <h2 class="pb-section-title">🔧 Perbaikan & Peningkatan</h2>
    <div class="pb-card">
      <div class="pb-card-head">🛠️ &nbsp; Diperbaiki di versi ini</div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#dbeafe;">🔗</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Semua Tautan Sudah Berfungsi <span class="pb-tag perbaikan">Perbaikan</span></div>
          <p class="pb-fitur-desc">Link-link yang sebelumnya mengarah ke file .html statis kini sudah diarahkan ke route Laravel yang benar sehingga tidak ada halaman 404.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#dcfce7;">💾</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Laporan Tersimpan ke Database <span class="pb-tag perbaikan">Perbaikan</span></div>
          <p class="pb-fitur-desc">Form Buat Laporan sebelumnya hanya menampilkan animasi sukses tanpa menyimpan ke database. Sekarang data laporan benar-benar tersimpan.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#f3e8ff;">⚡</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Performa Halaman Lebih Cepat <span class="pb-tag performa">Performa</span></div>
          <p class="pb-fitur-desc">Penggunaan cache view Laravel dan optimasi query database untuk mengurangi waktu muat halaman laporan dan dashboard admin.</p>
        </div>
      </div>

      <div class="pb-fitur-item">
        <div class="pb-fitur-ikon" style="background:#fef9c3;">📱</div>
        <div class="pb-fitur-body">
          <div class="pb-fitur-nama">Tampilan Responsif Lebih Baik <span class="pb-tag perbaikan">Perbaikan</span></div>
          <p class="pb-fitur-desc">Dashboard admin kini memiliki hamburger menu untuk layar mobile, dan semua halaman frontend sudah diuji di berbagai ukuran layar.</p>
        </div>
      </div>
    </div>

    {{-- Tentang Aplikasi --}}
    <h2 class="pb-section-title">ℹ️ Tentang LingkunganKU</h2>
    <div class="pb-card" style="padding:20px;">
      <div class="pb-about" style="padding:0;border:none;margin:0;">
        <div class="pb-about-logo">
          <img src="/assets/images/logo.webp" alt="Logo"
               onerror="this.parentNode.style.background='#eff6ff';this.parentNode.innerHTML='<span style=font-size:32px>🌿</span>'">
        </div>
        <div>
          <div class="pb-about-nama">LingkunganKU</div>
          <div class="pb-about-sub">Platform pelaporan lingkungan</div>
        </div>
      </div>
      <p class="pb-about-desc">
        LingkunganKU membantu warga melaporkan masalah lingkungan di sekitarnya,
        seperti jalan rusak, lampu jalan mati, sampah menumpuk, dan drainase, lalu
        memantau penanganannya sampai selesai.
      </p>
      <div style="margin-top:16px;border-top:1px solid #f1f5f9;padding-top:4px;">
        <div class="pb-info-row">
          <span>Versi aplikasi</span>
          <span>1.5.0</span>
        </div>
        <div class="pb-info-row">
          <span>Wilayah layanan</span>
          <span>Kabupaten Nganjuk</span>
        </div>
        <div class="pb-info-row">
          <span>Kontak</span>
          <span>admin@lingkunganku.id</span>
        </div>
        <div class="pb-info-row">
          <span>Tanggal rilis</span>
          <span>23 Oktober 2026</span>
        </div>
      </div>
    </div>

  </main>

</body>
</html>
