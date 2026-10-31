<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perubahan Jadwal Sampah - LingkunganKU</title>
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <style>
    .pb-page {
      max-width: 720px;
      margin: 32px auto;
      padding: 0 20px 60px;
    }

    /* Tombol kembali */
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

    /* Header artikel */
    .pb-header {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 28px;
    }
    .pb-header-ikon {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      background: #fef9c3;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 26px;
      flex-shrink: 0;
    }
    .pb-header-meta { flex: 1; }
    .pb-sumber {
      font-size: 12px;
      font-weight: 700;
      color: #f59e0b;
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
      line-height: 1.3;
    }
    .pb-waktu {
      font-size: 12.5px;
      color: #94a3b8;
    }

    /* Kartu perubahan jadwal */
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
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .pb-jadwal-wrap {
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .pb-jadwal-box {
      flex: 1;
      padding: 16px;
      border-radius: 10px;
      text-align: center;
    }
    .pb-jadwal-box.lama {
      background: #fef2f2;
      border: 1px solid #fecaca;
    }
    .pb-jadwal-box.baru {
      background: #f0fdf4;
      border: 1px solid #bbf7d0;
    }
    .pb-jadwal-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .8px;
      text-transform: uppercase;
      margin-bottom: 8px;
    }
    .pb-jadwal-box.lama .pb-jadwal-label { color: #ef4444; }
    .pb-jadwal-box.baru .pb-jadwal-label { color: #22c55e; }
    .pb-jadwal-tanggal {
      font-size: 18px;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 4px;
    }
    .pb-jadwal-hari {
      font-size: 12.5px;
      color: #64748b;
    }
    .pb-panah {
      font-size: 24px;
      color: #94a3b8;
      flex-shrink: 0;
    }

    /* Daftar wilayah */
    .pb-wilayah-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .pb-wilayah-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 20px;
      border-bottom: 1px solid #f1f5f9;
      font-size: 13.5px;
      color: #334155;
    }
    .pb-wilayah-item:last-child { border-bottom: none; }
    .pb-wilayah-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #f59e0b;
      flex-shrink: 0;
    }

    /* Catatan */
    .pb-catatan {
      background: #fffbeb;
      border: 1px solid #fde68a;
      border-radius: 10px;
      padding: 16px 18px;
      font-size: 13.5px;
      color: #78350f;
      line-height: 1.7;
    }
    .pb-catatan strong { display: block; margin-bottom: 4px; }

    /* Body teks */
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
      <div class="pb-header-ikon">🗑️</div>
      <div class="pb-header-meta">
        <p class="pb-sumber">Pemerintah Kabupaten Nganjuk</p>
        <h1 class="pb-judul">Perubahan Jadwal Pengambilan Sampah<br>di Desa Mulyorejo</h1>
        <span class="pb-waktu">📅 Kemarin, 18:30 &nbsp;·&nbsp; Dinas Kebersihan dan Lingkungan Hidup</span>
      </div>
    </div>

    {{-- Isi pemberitahuan --}}
    <p class="pb-body">
      Kepada seluruh warga Desa Mulyorejo, Kecamatan Nganjuk, diberitahukan bahwa terdapat
      perubahan jadwal pengambilan sampah oleh petugas Dinas Kebersihan dan Lingkungan Hidup
      Kabupaten Nganjuk. Perubahan ini dilakukan karena perawatan armada kendaraan pengangkut sampah.
    </p>

    {{-- Kartu perubahan jadwal --}}
    <div class="pb-card">
      <div class="pb-card-head">
        🗓️ &nbsp; Perubahan Jadwal Pengambilan
      </div>
      <div class="pb-jadwal-wrap">
        <div class="pb-jadwal-box lama">
          <div class="pb-jadwal-label">Jadwal Lama</div>
          <div class="pb-jadwal-tanggal">23 Mei 2026</div>
          <div class="pb-jadwal-hari">Sabtu</div>
        </div>
        <div class="pb-panah">→</div>
        <div class="pb-jadwal-box baru">
          <div class="pb-jadwal-label">Jadwal Baru</div>
          <div class="pb-jadwal-tanggal">29 Mei 2026</div>
          <div class="pb-jadwal-hari">Jumat</div>
        </div>
      </div>
    </div>

    {{-- Wilayah yang terdampak --}}
    <h2 class="pb-section-title">📍 Wilayah yang Terdampak</h2>
    <div class="pb-card">
      <ul class="pb-wilayah-list">
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot"></span>
          RT 01, RT 02, RT 03 — Dusun Mulyorejo Utara
        </li>
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot"></span>
          RT 04, RT 05 — Dusun Mulyorejo Selatan
        </li>
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot"></span>
          Jl. Raya Mulyorejo dan sekitarnya
        </li>
      </ul>
    </div>

    {{-- Instruksi --}}
    <h2 class="pb-section-title">📋 Yang Perlu Diperhatikan</h2>
    <p class="pb-body">
      Warga diharapkan untuk menyiapkan sampah rumah tangga pada:
    </p>
    <div class="pb-card">
      <ul class="pb-wilayah-list">
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot" style="background:#22c55e;"></span>
          Letakkan sampah di depan rumah pada <strong>Jumat, 29 Mei 2026 pukul 05.00–07.00 WIB</strong>
        </li>
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot" style="background:#22c55e;"></span>
          Pastikan sampah sudah terbungkus rapat untuk menghindari bau
        </li>
        <li class="pb-wilayah-item">
          <span class="pb-wilayah-dot" style="background:#22c55e;"></span>
          Pisahkan sampah organik dan anorganik jika memungkinkan
        </li>
      </ul>
    </div>

    {{-- Catatan --}}
    <div class="pb-catatan">
      <strong>⚠️ Catatan Penting</strong>
      Jadwal pengambilan sampah minggu berikutnya kembali ke jadwal normal setiap hari Sabtu.
      Mohon maaf atas ketidaknyamanan yang ditimbulkan. Untuk informasi lebih lanjut, hubungi
      Dinas Kebersihan dan Lingkungan Hidup Kab. Nganjuk di <strong>0358-321XXX</strong>.
    </div>

  </main>

</body>
</html>
