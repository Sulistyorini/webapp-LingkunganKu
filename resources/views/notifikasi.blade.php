<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Notifikasi</title>
  <meta name="description" content="Pantau perkembangan laporan dan informasi terbaru LingkunganKU.">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/notifikasi.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <script src="/js/clarity.js"></script>
</head>
<body>

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>

  <main class="notif-page">
    <p class="notif-sub">Pantau perkembangan laporan dan informasi terbaru.</p>

    {{-- Flash: laporan baru saja terkirim --}}
    @if (session('laporan_terkirim'))
    <div style="padding:14px 18px;border-radius:10px;background:#dcfce7;border:1px solid #86efac;color:#15803d;margin-bottom:20px;font-size:14px;font-weight:600;display:flex;align-items:center;gap:10px;">
      <span style="font-size:20px;">✅</span>
      <span>Laporan Anda berhasil dikirim! Pantau perkembangannya di sini.</span>
    </div>
    @endif

    <section class="notif-card" aria-label="Daftar notifikasi">

      <div class="toolbar">
        <div class="tabs" role="tablist" aria-label="Jenis notifikasi">
          <button type="button" class="tab aktif" role="tab" data-tab="semua">Semua</button>
          <button type="button" class="tab" role="tab" data-tab="laporan">Laporan</button>
          <button type="button" class="tab" role="tab" data-tab="info">Pemberitahuan</button>
        </div>

        <div class="tools">
          <select id="filter-status" aria-label="Filter status">
            <option value="semua">Semua status</option>
            <option value="baru">Baru</option>
            <option value="diterima">Diterima</option>
            <option value="diproses">Diproses</option>
            <option value="selesai">Selesai</option>
            <option value="ditolak">Ditolak</option>
            <option value="info">Info</option>
          </select>

          <label class="cari" for="cari">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
            <input type="search" id="cari" placeholder="Cari notifikasi...">
          </label>

          <button type="button" class="btn-baca" id="btn-baca-semua">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>
            Tandai semua dibaca
          </button>
        </div>
      </div>

      <div id="daftar"></div>
      <p class="kosong" id="kosong" hidden>Tidak ada notifikasi yang cocok.</p>

    </section>
  </main>

  <script>
  // ── Data contoh (pemberitahuan & laporan dummy) ────────────────────
  // tetap ditampilkan sebagai contoh tampilan
  var DATA_CONTOH = [
    { id: 'c1', kelompok: 'Kemarin', tipe: 'info', status: 'info', judul: 'Pemerintah',
      isi: 'Perubahan Jadwal Pengambilan Sampah di Desa Mulyorejo.', waktu: '18:30',
      href: '/pemberitahuan/jadwal-sampah', dari_db: false },
    { id: 'c2', kelompok: 'Kemarin', tipe: 'info', status: 'info', judul: 'App',
      isi: 'Upgrade Versi Terbaru v1.5', waktu: '14:13',
      href: '/pemberitahuan/update-app', dari_db: false },
    { id: 'c3', kelompok: 'Bulan Lalu', tipe: 'laporan', status: 'diproses', judul: 'Laporan Diproses',
      isi: 'Laporan Jalan Rusak di Jl. Diponegoro telah diterima oleh petugas.', waktu: '28-09-2026, 13:11',
      href: '/laporan?status=diproses', dari_db: false },
    { id: 'c4', kelompok: 'Bulan Lalu', tipe: 'laporan', status: 'diterima', judul: 'Laporan Diterima',
      isi: 'Laporan Lampu Jalan Mati di Jl. Diponegoro sedang dalam proses peninjauan.', waktu: '22-09-2026, 09:12',
      href: '/detail-laporan', dari_db: false },
    { id: 'c5', kelompok: 'Bulan Lalu', tipe: 'laporan', status: 'selesai', judul: 'Laporan Selesai',
      isi: 'Laporan Sampah Menumpuk telah selesai ditindaklanjuti.', waktu: '20-09-2026, 15:01',
      href: '/laporan?status=selesai', dari_db: false },
    { id: 'c6', kelompok: 'Bulan Lalu', tipe: 'laporan', status: 'ditolak', judul: 'Laporan Ditolak',
      isi: 'Laporan Drainase tidak bisa diproses karena diluar wilayah Kabupaten Nganjuk.', waktu: '18-09-2026, 14:54',
      href: '/laporan?status=ditolak', dari_db: false }
  ];

  // ── Ikon SVG ────────────────────────────────────────────────────────
  var IKON = {
    baru:     '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
    diproses: '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
    diterima: '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 13h6M9 17h6"/>',
    selesai:  '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
    ditolak:  '<path d="M6 6l12 12M18 6L6 18"/>',
    info:     '<path d="M3 11v2a1 1 0 0 0 1 1h2l5 4V6L6 10H4a1 1 0 0 0-1 1z"/><path d="M15 9a4 4 0 0 1 0 6M18 7a7 7 0 0 1 0 10"/>'
  };

  var KUNCI     = 'lingkunganku_notif_dibaca';
  var email     = localStorage.getItem('lingkunganku_email');
  var tabAktif  = new URLSearchParams(window.location.search).get('tab') || 'semua';
  var semuaData = [];   // gabungan DB + contoh

  if (['semua','laporan','info'].indexOf(tabAktif) === -1) tabAktif = 'semua';

  function ambilDibaca() {
    try { return JSON.parse(localStorage.getItem(KUNCI) || '[]'); } catch(e) { return []; }
  }
  function simpanDibaca(arr) {
    try { localStorage.setItem(KUNCI, JSON.stringify(arr)); } catch(e) {}
  }

  // ── Konversi notifikasi dari DB ke format tampilan ─────────────────
  function dbKeFormat(n) {
    var ikonKey = n.status in IKON ? n.status : 'baru';
    return {
      id:       n.id,
      kelompok: 'Laporan Saya',
      tipe:     'laporan',
      status:   n.status,
      judul:    n.judul,
      isi:      n.isi,
      waktu:    n.waktu,
      href:     '/detail-laporan?id=' + n.laporan_id,
      dari_db:  true
    };
  }

  // ── Render ──────────────────────────────────────────────────────────
  function render() {
    var dibaca    = ambilDibaca();
    var status    = document.getElementById('filter-status').value;
    var kata      = document.getElementById('cari').value.trim().toLowerCase();
    var html      = '';
    var kelTerakhir = '';
    var jumlah    = 0;

    semuaData.forEach(function(d) {
      if (tabAktif !== 'semua' && d.tipe !== tabAktif) return;
      if (status !== 'semua' && d.status !== status) return;
      if (kata && (d.judul + ' ' + d.isi).toLowerCase().indexOf(kata) === -1) return;

      if (d.kelompok !== kelTerakhir) {
        // Label "Laporan Saya" dengan warna biru untuk membedakan dari contoh
        var kelStyle = d.dari_db
          ? 'color:#2563eb;font-weight:800;'
          : '';
        html += '<h2 class="kelompok" style="' + kelStyle + '">'
              + escHtml(d.kelompok) + '</h2>';
        kelTerakhir = d.kelompok;
      }

      var baru     = dibaca.indexOf(String(d.id)) === -1 ? ' baru' : '';
      var ikonSvg  = IKON[d.status] || IKON['info'];
        if (['diproses','diterima','selesai','ditolak','info'].indexOf(d.status) === -1) {
          ikonSvg = '<line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>';
        }
      var dbBadge  = d.dari_db
        ? '<span style="font-size:10px;background:#dbeafe;color:#1d4ed8;padding:1px 7px;border-radius:20px;font-weight:700;margin-left:4px;">Saya</span>'
        : '';

      html +=
        '<a class="notif-item' + baru + '" href="' + escHtml(d.href) + '" data-id="' + escHtml(String(d.id)) + '">' +
          '<span class="ikon ' + escHtml(d.status) + '">' +
            '<svg viewBox="0 0 24 24" aria-hidden="true">' + ikonSvg + '</svg>' +
          '</span>' +
          '<span class="isi">' +
            '<strong>' + escHtml(d.judul) + dbBadge + '<i class="titik"></i></strong>' +
            '<p>' + escHtml(d.isi) + '</p>' +
          '</span>' +
          '<span class="waktu">' + escHtml(d.waktu) + '</span>' +
          '<svg class="panah" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>' +
        '</a>';
      jumlah++;
    });

    document.getElementById('daftar').innerHTML = html;
    document.getElementById('kosong').hidden = jumlah > 0;
  }

  function escHtml(s) {
    return String(s)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;')
      .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // ── Muat notifikasi dari DB (jika sudah login) ─────────────────────
  function muatDariDb(callback) {
    if (!email) { callback([]); return; }
    fetch('/api/notifikasi?email=' + encodeURIComponent(email))
      .then(function(r) { return r.json(); })
      .then(function(data) { callback(data.notifikasi || []); })
      .catch(function() { callback([]); });
  }

  function inisialisasi() {
    muatDariDb(function(dbNotif) {
      var dariDb = dbNotif.map(dbKeFormat);

      // Gabung: notifikasi DB di atas, contoh di bawah
      semuaData = dariDb.concat(DATA_CONTOH);

      // Inisialisasi status baca: contoh lama sebagian sudah "dibaca"
      if (localStorage.getItem(KUNCI) === null) {
        var awalDibaca = DATA_CONTOH.slice(2).map(function(d) { return String(d.id); });
        simpanDibaca(awalDibaca);
      }

      aktifkanTab();
      render();
    });
  }

  // ── Tab ────────────────────────────────────────────────────────────
  function aktifkanTab() {
    document.querySelectorAll('.tab').forEach(function(t) {
      t.classList.toggle('aktif', t.getAttribute('data-tab') === tabAktif);
    });
  }
  document.querySelectorAll('.tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
      tabAktif = tab.getAttribute('data-tab');
      aktifkanTab();
      render();
    });
  });

  document.getElementById('filter-status').addEventListener('change', render);
  document.getElementById('cari').addEventListener('input', render);

  // ── Tandai semua dibaca ────────────────────────────────────────────
  document.getElementById('btn-baca-semua').addEventListener('click', function() {
    simpanDibaca(semuaData.map(function(d) { return String(d.id); }));
    render();
  });

  // ── Klik notifikasi = tandai dibaca ───────────────────────────────
  document.getElementById('daftar').addEventListener('click', function(e) {
    var item = e.target.closest('.notif-item');
    if (!item) return;
    var id     = item.getAttribute('data-id');
    var dibaca = ambilDibaca();
    if (dibaca.indexOf(id) === -1) { dibaca.push(id); simpanDibaca(dibaca); }
  });

  // ── Mulai ──────────────────────────────────────────────────────────
  inisialisasi();

  // Auto-refresh notifikasi DB setiap 30 detik
  setInterval(function() {
    muatDariDb(function(dbNotif) {
      var dariDb = dbNotif.map(dbKeFormat);
      semuaData  = dariDb.concat(DATA_CONTOH);
      render();
    });
  }, 30000);
  </script>

</body>
</html>
