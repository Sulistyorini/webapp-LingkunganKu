<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <link rel="stylesheet" href="/css/laporan.css">
  <link rel="stylesheet" href="/css/cari-laporan.css">
  <title>LingkunganKU - Cari Laporan</title>
  <meta name="description" content="Cari laporan masalah lingkungan berdasarkan kata kunci atau alamat. Tidak perlu login.">
  <script src="/js/clarity.js"></script>
</head>
<body class="page-cari">

  <main class="cari-main">
    <div class="laporan-page">
      <a href="/" class="cari-back-link">&larr; Kembali</a>

      <div class="laporan-page-header">
        <div class="laporan-page-header-text">
          <h1>Cari Laporan</h1>
          <p>Temukan dan pantau laporan masalah lingkungan di sekitar Anda.</p>
        </div>
      </div>

      <div class="laporan-controls">
        <form class="laporan-search-form" action="/cari-laporan" method="get" role="search">
          <label for="kata-kunci" class="sr-only">Cari berdasarkan judul, kategori, atau lokasi</label>
          <div class="laporan-search-wrap">
            <svg class="laporan-search-icon" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="search" id="kata-kunci" name="q" class="laporan-search-input"
                   placeholder="Cari judul, kategori, atau lokasi laporan...">
          </div>
          <button type="submit" class="laporan-search-btn">Cari</button>
        </form>
      </div>

      <section aria-labelledby="hasil-heading">
        <div class="cari-results-heading">
          <h2 id="hasil-heading">Hasil Pencarian</h2>
          <p id="hasil-info" aria-live="polite"></p>
        </div>

        <ul class="laporan-list" id="daftar-hasil" aria-label="Hasil pencarian laporan">
          <li data-searchable="jalan berlubang infrastruktur jalan raya diproses jl kemanggisan raya palmerah">
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
                  <p class="laporan-item-lokasi">Jl. Kemanggisan Raya, Palmerah</p>
                  <p class="laporan-item-meta">2 jam yang lalu</p>
                  <span class="laporan-item-badge badge--diproses">Diproses</span>
                </div>
              </article>
            </a>
          </li>
          <li data-searchable="lampu jalan mati fasilitas umum selesai jl sudirman menteng jakarta pusat">
            <a href="/detail-laporan?id=lampu-jalan-mati" class="laporan-item-link">
              <article class="laporan-item-card">
                <div class="laporan-item-img-wrap">
                  <img src="/assets/images/laporan-lampu-jalan-mati.jpg"
                       alt="Foto laporan lampu jalan mati" class="laporan-item-img" loading="lazy"
                       onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                  <div class="laporan-item-placeholder" aria-hidden="true">
                    <span class="laporan-item-placeholder-text">Foto Laporan</span>
                  </div>
                </div>
                <div class="laporan-item-body">
                  <h2 class="laporan-item-title">Lampu Jalan Mati</h2>
                  <p class="laporan-item-kategori">Fasilitas Umum</p>
                  <p class="laporan-item-lokasi">Jl. Sudirman, Menteng, Jakarta Pusat</p>
                  <p class="laporan-item-meta">3 jam yang lalu</p>
                  <span class="laporan-item-badge badge--selesai">Selesai</span>
                </div>
              </article>
            </a>
          </li>
          <li data-searchable="sampah menumpuk kebersihan diproses jl mangga besar taman sari jakarta barat">
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
                  <p class="laporan-item-lokasi">Jl. Mangga Besar, Taman Sari, Jakarta Barat</p>
                  <p class="laporan-item-meta">6 jam yang lalu</p>
                  <span class="laporan-item-badge badge--diproses">Diproses</span>
                </div>
              </article>
            </a>
          </li>
          <li data-searchable="selokan tersumbat sanitasi diproses jl kramat jati jakarta timur">
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
                  <p class="laporan-item-lokasi">Jl. Kramat Jati, Jakarta Timur</p>
                  <p class="laporan-item-meta">12 jam yang lalu</p>
                  <span class="laporan-item-badge badge--diproses">Diproses</span>
                </div>
              </article>
            </a>
          </li>
          <li data-searchable="sampah menumpuk kebersihan ditolak jl cempaka putih jakarta pusat">
            <a href="/detail-laporan?id=sampah-menumpuk-ditolak" class="laporan-item-link">
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
                  <p class="laporan-item-lokasi">Jl. Cempaka Putih, Jakarta Pusat</p>
                  <p class="laporan-item-meta">2 hari yang lalu</p>
                  <span class="laporan-item-badge badge--ditolak">Ditolak</span>
                </div>
              </article>
            </a>
          </li>
        </ul>
        <p id="hasil-kosong" class="cari-empty-state" hidden>Tidak ada laporan yang cocok. Coba kata kunci atau lokasi lain.</p>
      </section>

    </div>
  </main>

  <script src="/js/cari-laporan.js" defer></script>

</body>
</html>
