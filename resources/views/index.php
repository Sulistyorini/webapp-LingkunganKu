<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/index.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <title>LingkunganKU - Beranda</title>
  <meta name="description" content="Aplikasi pelaporan dan pemantauan masalah lingkungan masyarakat.">
  <link rel="stylesheet" href="/css/chatbot.css">
  <script src="/js/clarity.js"></script>
</head>
<body class="page-beranda">

  <!-- NAVBAR — diisi oleh navbar.js -->
  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>

  <main id="main-content">

    <!-- ═══════════════════════════════════ HERO ═══════════════════════════════════ -->
    <section class="hero" aria-labelledby="sambutan-heading">

      <!-- Konten tengah -->
      <div class="hero-content">

        <span class="hero-label">Bersama Menjaga Lingkungan</span>

        <h1 class="hero-title" id="sambutan-heading">
          Selamat Datang di<br>
          <span class="hero-title-accent">LingkunganKU</span>
        </h1>

        <p class="hero-desc" id="sambutan-sub">
          Bersama kita wujudkan lingkungan yang lebih bersih, sehat, dan nyaman.
        </p>

        <!-- Form pencarian -->
        <form class="hero-search" action="/cari-laporan" method="get" role="search">
          <label for="cari-beranda" class="sr-only">Cari laporan</label>
          <div class="hero-search-wrap">
            <input
              type="search"
              id="cari-beranda"
              name="q"
              class="hero-search-input"
              placeholder="Cari laporan, misal: jalan berlubang, sampah, Palmerah..."
              autocomplete="off">
            <button type="submit" class="hero-search-btn" aria-label="Cari laporan">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2.5"
                   stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              </svg>
            </button>
          </div>
        </form>


      </div>
    </section>


    <!-- ═══════════════════════════════ LAPORAN DI SEKITAR ═══════════════════════════════ -->
    <section class="laporan-section" aria-labelledby="laporan-sekitar-heading">

      <div class="laporan-header">
        <div>
          <h2 class="laporan-title" id="laporan-sekitar-heading">Laporan di Sekitar</h2>
          <p class="laporan-meta">Temukan dan pantau masalah lingkungan di sekitar Anda.</p>
        </div>
        <a href="#" id="link-lihat-semua" class="laporan-lihat-semua">Lihat Semua →</a>
      </div>

      <ul class="laporan-grid" aria-label="Daftar laporan terkini">

        <!-- Kartu 1 -->
        <li>
          <article class="laporan-card">
            <div class="laporan-card-img-wrap">
              <img
                src="/assets/images/laporan-jalan-berlubang.jpg"
                alt="Foto jalan berlubang di Palmerah"
                class="laporan-card-img"
                loading="lazy"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <div class="laporan-card-img-fallback" aria-hidden="true">
                <span class="laporan-card-img-fallback-icon">🛣️</span>
                <span class="laporan-card-img-fallback-text">Foto Laporan</span>
              </div>
            </div>
            <div class="laporan-card-body">
              <h3 class="laporan-card-title">Jalan Berlubang</h3>
              <p class="laporan-card-lokasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                  <circle cx="12" cy="9" r="2.5"/>
                </svg>
                Jl. Kemanggisan Utama, Palmerah
              </p>
              <p class="laporan-card-waktu">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                2 Jam yang lalu
              </p>
              <p class="laporan-card-desc">Terdapat lubang cukup besar di tengah jalan yang membahayakan pengendara.</p>
              <a href="/detail-laporan?id=jalan-berlubang" class="laporan-card-badge badge--diproses">⏳ Diproses</a>
            </div>
          </article>
        </li>

        <!-- Kartu 2 -->
        <li>
          <article class="laporan-card">
            <div class="laporan-card-img-wrap">
              <img
                src="/assets/images/laporan-sampah-menumpuk.jpg"
                alt="Foto sampah menumpuk di Slipi"
                class="laporan-card-img"
                loading="lazy"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <div class="laporan-card-img-fallback" aria-hidden="true">
                <span class="laporan-card-img-fallback-icon">🗑️</span>
                <span class="laporan-card-img-fallback-text">Foto Laporan</span>
              </div>
            </div>
            <div class="laporan-card-body">
              <h3 class="laporan-card-title">Sampah Menumpuk</h3>
              <p class="laporan-card-lokasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                  <circle cx="12" cy="9" r="2.5"/>
                </svg>
                Jl. Anggrek No.7, Slipi
              </p>
              <p class="laporan-card-waktu">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                5 Jam yang lalu
              </p>
              <p class="laporan-card-desc">Sampah menumpuk di pinggir jalan sudah beberapa hari dan menimbulkan bau.</p>
              <a href="/detail-laporan?id=sampah-menumpuk" class="laporan-card-badge badge--diproses">⏳ Diproses</a>
            </div>
          </article>
        </li>

        <!-- Kartu 3 -->
        <li>
          <article class="laporan-card">
            <div class="laporan-card-img-wrap">
              <img
                src="/assets/images/laporan-lampu-jalan-mati.jpg"
                alt="Foto lampu jalan mati di Kebon Jeruk"
                class="laporan-card-img"
                loading="lazy"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <div class="laporan-card-img-fallback" aria-hidden="true">
                <span class="laporan-card-img-fallback-icon">💡</span>
                <span class="laporan-card-img-fallback-text">Foto Laporan</span>
              </div>
            </div>
            <div class="laporan-card-body">
              <h3 class="laporan-card-title">Lampu Jalan Mati</h3>
              <p class="laporan-card-lokasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                  <circle cx="12" cy="9" r="2.5"/>
                </svg>
                Jl. Panjang, Kebon Jeruk
              </p>
              <p class="laporan-card-waktu">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                8 Jam yang lalu
              </p>
              <p class="laporan-card-desc">Lampu jalan di depan komplek tidak menyala sejak malam kemarin.</p>
              <a href="/detail-laporan?id=lampu-jalan-mati" class="laporan-card-badge badge--selesai">✅ Selesai</a>
            </div>
          </article>
        </li>

        <!-- Kartu 4 -->
        <li>
          <article class="laporan-card">
            <div class="laporan-card-img-wrap">
              <img
                src="/assets/images/laporan-selokan-tersumbat.jpg"
                alt="Foto selokan tersumbat di Palmerah"
                class="laporan-card-img"
                loading="lazy"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
              <div class="laporan-card-img-fallback" aria-hidden="true">
                <span class="laporan-card-img-fallback-icon">🌊</span>
                <span class="laporan-card-img-fallback-text">Foto Laporan</span>
              </div>
            </div>
            <div class="laporan-card-body">
              <h3 class="laporan-card-title">Selokan Tersumbat</h3>
              <p class="laporan-card-lokasi">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                  <circle cx="12" cy="9" r="2.5"/>
                </svg>
                Jl. Rawa Belong, Palmerah
              </p>
              <p class="laporan-card-waktu">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="12" r="10"/>
                  <polyline points="12 6 12 12 16 14"/>
                </svg>
                12 Jam yang lalu
              </p>
              <p class="laporan-card-desc">Selokan tersumbat oleh sampah dan daun kering sehingga air meluap.</p>
              <a href="/detail-laporan?id=selokan-tersumbat" class="laporan-card-badge badge--menunggu">⏰ Menunggu</a>
            </div>
          </article>
        </li>

      </ul>
    </section>

  </main>

  <!-- Beranda JS -->
  <script>
    // Personalisasi setelah login
    var nama = localStorage.getItem('lingkunganku_nama');
    if (nama) {
      var el = document.getElementById('sambutan-heading');
      if (el) {
        el.innerHTML = 'Halo, <span class="hero-title-accent">' + nama + '!</span>';
      }
      var sub = document.getElementById('sambutan-sub');
      if (sub) sub.textContent = 'Selamat datang kembali di LingkunganKU.';
    }

    // Lihat Semua — cek login
    var linkSemua = document.getElementById('link-lihat-semua');
    if (linkSemua) {
      linkSemua.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = localStorage.getItem('lingkunganku_nama')
          ? '/laporan'
          : '/login';
      });
    }
  </script>
  <script src="/js/faq-data.js"></script>
  <script src="/js/chatbot.js?v=2"></script>
  <script src="/js/chatbot-drag.js"></script>
  <script>
    // Seluruh kartu laporan bisa diklik -> detail laporan
    (function () {
      var kartu = document.querySelectorAll('.laporan-card');
      for (var i = 0; i < kartu.length; i++) {
        (function (card) {
          var tautan = card.querySelector('a[href*="detail-laporan"]');
          if (!tautan) { return; }
          card.style.cursor = 'pointer';
          card.addEventListener('click', function (e) {
            if (e.target.closest('a, button')) { return; }
            var tujuan = tautan.getAttribute('href');
            tujuan += (tujuan.indexOf('?') === -1 ? '?' : '&') + 'dari=' + encodeURIComponent(window.location.pathname);
            window.location.href = tujuan;
          });
        })(kartu[i]);
      }
    })();
  </script>
</body>
</html>
