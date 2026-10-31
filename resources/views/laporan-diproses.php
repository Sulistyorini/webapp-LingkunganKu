<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <link rel="stylesheet" href="/css/laporan.css">
  <title>LingkunganKU - Laporan Diproses</title>
  <meta name="description" content="Daftar laporan yang sedang dalam proses penanganan.">
  <script src="/js/clarity.js"></script>
</head>
<body class="page-laporan">

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>

  <main>
    <div class="laporan-page">

      <div class="laporan-page-header">
        <div class="laporan-page-header-text">
          <h1>Laporan Lingkungan</h1>
          <p>Laporan yang sedang dalam proses penanganan oleh petugas.</p>
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

      <div class="laporan-controls">
        <nav aria-label="Filter Status Laporan">
          <ul class="laporan-filter-tabs">
            <li><a href="/laporan">Semua</a></li>
            <li><a href="/laporan?status=diproses" aria-current="page">Diproses</a></li>
            <li><a href="/laporan?status=selesai">Selesai</a></li>
            <li><a href="/laporan?status=ditolak">Ditolak</a></li>
          </ul>
        </nav>
        <form class="laporan-search-form" action="#" method="get" role="search">
          <label for="cari-diproses" class="sr-only">Cari Laporan</label>
          <div class="laporan-search-wrap">
            <svg class="laporan-search-icon" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="search" id="cari-diproses" name="q" class="laporan-search-input"
                   placeholder="Cari laporan berdasarkan judul atau kata kunci...">
          </div>
          <button type="submit" class="laporan-search-btn">Cari</button>
        </form>
      </div>

      <ul class="laporan-list" aria-label="Daftar laporan yang sedang diproses">

        <li>
          <a href="/detail-laporan?id=jalan-berlubang" class="laporan-item-link">
            <article class="laporan-item-card">
              <div class="laporan-item-img-wrap">
                <img src="/assets/images/laporan-jalan-berlubang.jpg"
                     alt="Foto laporan jalan berlubang" class="laporan-item-img" loading="lazy"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="laporan-item-placeholder" aria-hidden="true">
                  <span class="laporan-item-placeholder-text">Foto Laporan</span>
                </div>
              </div>
              <div class="laporan-item-body">
                <h2 class="laporan-item-title">Jalan berlubang</h2>
                <p class="laporan-item-kategori">Infrastruktur, Jalan Raya</p>
                <p class="laporan-item-lokasi">Lokasi: Jl. Kemanggisan Raya, Palmerah</p>
                <p class="laporan-item-meta">2 jam yang lalu</p>
                <span class="laporan-item-badge badge--diproses">Diproses</span>
              </div>
            </article>
          </a>
        </li>

        <li>
          <a href="/detail-laporan?id=sampah-menumpuk" class="laporan-item-link">
            <article class="laporan-item-card">
              <div class="laporan-item-img-wrap">
                <img src="/assets/images/laporan-sampah-menumpuk.jpg"
                     alt="Foto laporan sampah menumpuk" class="laporan-item-img" loading="lazy"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="laporan-item-placeholder" aria-hidden="true">
                  <span class="laporan-item-placeholder-text">Foto Laporan</span>
                </div>
              </div>
              <div class="laporan-item-body">
                <h2 class="laporan-item-title">Sampah Menumpuk</h2>
                <p class="laporan-item-kategori">Kebersihan</p>
                <p class="laporan-item-lokasi">Lokasi: Jl. Mangga Besar, Taman Sari, Jakarta Barat</p>
                <p class="laporan-item-meta">6 jam yang lalu</p>
                <span class="laporan-item-badge badge--diproses">Diproses</span>
              </div>
            </article>
          </a>
        </li>

        <li>
          <a href="/detail-laporan?id=selokan-tersumbat" class="laporan-item-link">
            <article class="laporan-item-card">
              <div class="laporan-item-img-wrap">
                <img src="/assets/images/laporan-selokan-tersumbat.jpg"
                     alt="Foto laporan selokan tersumbat" class="laporan-item-img" loading="lazy"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="laporan-item-placeholder" aria-hidden="true">
                  <span class="laporan-item-placeholder-text">Foto Laporan</span>
                </div>
              </div>
              <div class="laporan-item-body">
                <h2 class="laporan-item-title">Selokan Tersumbat</h2>
                <p class="laporan-item-kategori">Sanitasi</p>
                <p class="laporan-item-lokasi">Lokasi: Jl. Kramat Jati, Jakarta Timur</p>
                <p class="laporan-item-meta">1 hari yang lalu</p>
                <span class="laporan-item-badge badge--diproses">Diproses</span>
              </div>
            </article>
          </a>
        </li>

      </ul>
    </div>
  </main>

  <script src="/js/laporan-search.js"></script>

</body>
</html>
