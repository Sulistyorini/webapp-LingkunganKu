<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  <title>LingkunganKU - Buat Laporan</title>
  <meta name="description" content="Formulir pembuatan laporan masalah lingkungan dalam 3 langkah: Jenis Laporan, Lokasi, dan Konfirmasi.">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/buat-laporan.css?v=2">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""
  >
  <script src="/js/clarity.js"></script>
</head>
<body>

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>


  <header>
    <!-- Stepper / Indikator Langkah -->
    <nav aria-label="Langkah pengisian laporan">
      <ol>
        <li aria-current="step">
          <strong>1</strong>
          <span>Jenis Laporan</span>
        </li>
        <li>
          <strong>2</strong>
          <span>Lokasi</span>
        </li>
        <li>
          <strong>3</strong>
          <span>Konfirmasi</span>
        </li>
      </ol>
    </nav>
  </header>

  <main>

    <section id="akses-laporan" aria-labelledby="akses-laporan-heading" role="alert" hidden>
      <h1 id="akses-laporan-heading">Masuk untuk Membuat Laporan</h1>
      <p>Anda harus masuk atau mendaftar akun terlebih dahulu sebelum membuat laporan.</p>
      <a href="/login" id="link-masuk">Masuk</a>
      <a href="/register" id="link-daftar">Daftar Akun</a>
    </section>

    <form
    id="form-laporan"
    action="{{ route('buat-laporan.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @if ($errors->any())
    <div role="alert" style="margin:0 0 16px;padding:14px 16px;border-radius:12px;background:#fef2f2;border:1px solid #fca5a5;color:#b91c1c;font-size:14px;font-weight:600;line-height:1.5;">
      Laporan belum terkirim:
      <ul style="margin:6px 0 0 18px;padding:0;font-weight:500;">
        @foreach ($errors->all() as $pesan)
          <li>{{ $pesan }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <input type="hidden" id="hidden-nama-pelapor"  name="nama_pelapor">
    <input type="hidden" id="hidden-email-pelapor" name="email_pelapor">

      <!-- ==================== LANGKAH 1: JENIS LAPORAN ==================== -->
      <section aria-labelledby="step1-heading">
        <h1 id="step1-heading" tabindex="-1">Langkah 1: Jenis Laporan</h1>

        <!-- Pilih Kategori -->
        <fieldset>
          <legend>Pilih Kategori</legend>

          <ul>
            <li>
              <label>
                <input type="radio" name="kategori" value="jalan" required>
                Jalan
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="kategori" value="lampu-jalan">
                Lampu Jalan
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="kategori" value="sampah">
                Sampah
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="kategori" value="selokan">
                Selokan
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="kategori" value="taman">
                Taman
              </label>
            </li>
            <li>
              <label>
                <input type="radio" name="kategori" value="lainnya">
                Lainnya
              </label>
            </li>
          </ul>
        </fieldset>

        <!-- Deskripsi Laporan -->
        <fieldset>
          <legend>Deskripsi Laporan</legend>
          <label for="deskripsi">Tulis deskripsi masalah <abbr title="wajib diisi">*</abbr></label>
          <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan permasalahan secara detail..." required></textarea>
        </fieldset>

        <!-- Foto / Dokumentasi -->
        <fieldset>
          <legend>Foto / Dokumentasi</legend>
          <label for="foto-laporan">Tambah Foto</label>
          <input type="file" id="foto-laporan" name="foto_laporan[]" accept="image/webp, image/png, image/jpeg">
          <p>Format: WebP, PNG, JPG. Minimal 1 foto, maksimal 3 foto (maks. 2 MB per foto).</p>
          <!-- Preview langsung di langkah 1 -->
          <div id="preview-step1" style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px;"></div>
        </fieldset>

        <button type="button" data-step-next>Selanjutnya</button>
      </section>

      <!-- ==================== LANGKAH 2: LOKASI ==================== -->
      <section aria-labelledby="step2-heading" hidden>
        <h2 id="step2-heading" tabindex="-1">Langkah 2: Lokasi</h2>

        <fieldset>
          <legend>Pilih Lokasi</legend>

          <ol>
            <li>
              <label for="kecamatan">Pilih Lokasi Kecamatan <abbr title="wajib diisi">*</abbr></label>
              <select id="kecamatan" name="kecamatan" required>
                <option value="">-- Pilih Kecamatan --</option>
                <option value="bagor">Bagor</option>
                <option value="baron">Baron</option>
                <option value="berbek">Berbek</option>
                <option value="gondang">Gondang</option>
                <option value="jatikalen">Jatikalen</option>
                <option value="kertosono">Kertosono</option>
                <option value="lengkong">Lengkong</option>
                <option value="loceret">Loceret</option>
                <option value="nganjuk">Nganjuk</option>
                <option value="ngetos">Ngetos</option>
                <option value="ngluyu">Ngluyu</option>
                <option value="ngronggot">Ngronggot</option>
                <option value="pace">Pace</option>
                <option value="patianrowo">Patianrowo</option>
                <option value="prambon">Prambon</option>
                <option value="rejoso">Rejoso</option>
                <option value="sawahan">Sawahan</option>
                <option value="sukomoro">Sukomoro</option>
                <option value="tanjunganom">Tanjunganom</option>
                <option value="wilangan">Wilangan</option>
              </select>
            </li>

            <li>
              <label for="kelurahan">Pilih Lokasi Desa/Kelurahan <abbr title="wajib diisi">*</abbr></label>
              <select id="kelurahan" name="kelurahan" required>
                <option value="">-- Pilih Desa/Kelurahan --</option>
              </select>
            </li>


            <li>
              <label for="alamat-lokasi">Alamat / Keterangan Lokasi</label>
              <input type="text" id="alamat-lokasi" name="alamat_lokasi" maxlength="150" placeholder="Contoh: Jl. Raya Kediri No. 5, depan balai desa" value="{{ old('alamat_lokasi') }}">
              <p>Terisi otomatis dari titik di peta. Tambahkan RT/RW atau patokan jika tahu, misalnya: RT 03 RW 05, depan balai desa.</p>
            </li>
            <li>
              <label for="titik-maps">Arahkan Titik Maps</label>
              <input type="text" id="titik-maps" name="titik_maps" placeholder="Contoh: -7.6150, 111.9465">
              <button type="button" id="gunakan-lokasi-saya">Gunakan lokasi saya</button>
              <p>Geser penanda untuk menentukan titik lokasi. Koordinat terisi otomatis.</p>
            </li>
          </ol>
          <div id="peta-lokasi" role="region" aria-label="Peta lokasi laporan di Kabupaten Nganjuk"></div>
          <p id="peta-status" aria-live="polite">Peta menampilkan Kabupaten Nganjuk.</p>
        </fieldset>

        <button type="button" data-step-previous>Kembali</button>
        <button type="button" data-step-next>Selanjutnya</button>
      </section>

      <!-- ==================== LANGKAH 3: KONFIRMASI ==================== -->
      <section aria-labelledby="step3-heading" hidden>
        <h2 id="step3-heading" tabindex="-1">Langkah 3: Konfirmasi Laporan</h2>

        <!-- Pratinjau Foto -->
        <section aria-labelledby="konfirmasi-foto-heading">
          <h3 id="konfirmasi-foto-heading">Foto / Dokumentasi</h3>
          <figure id="pratinjau-foto-wrap">
            <div id="pratinjau-foto-grid" style="display:flex;flex-wrap:wrap;gap:10px;min-height:80px;align-items:center;justify-content:center;">
              <figcaption id="pratinjau-foto-label" style="color:#94a3b8;font-size:0.9rem;">Pratinjau foto laporan yang diunggah</figcaption>
            </div>
          </figure>
        </section>

        <!-- Ringkasan Data -->
        <section aria-labelledby="konfirmasi-data-heading">
          <h3 id="konfirmasi-data-heading">Ringkasan Laporan</h3>
          <table>
            <caption>Data laporan yang akan dikirimkan</caption>
            <tbody>
              <tr>
                <th scope="row">Kategori</th>
                <td id="ringkasan-kategori">—</td>
              </tr>
              <tr>
                <th scope="row">Deskripsi</th>
                <td id="ringkasan-deskripsi">—</td>
              </tr>
              <tr>
                <th scope="row">Kecamatan</th>
                <td id="ringkasan-kecamatan">—</td>
              </tr>
              <tr>
                <th scope="row">Desa/Kelurahan</th>
                <td id="ringkasan-kelurahan">—</td>
              </tr>
              <tr>
                <th scope="row">Koordinat</th>
                <td id="ringkasan-koordinat">—</td>
              </tr>
              <tr>
                <th scope="row">Foto</th>
                <td id="ringkasan-foto">—</td>
              </tr>
            </tbody>
          </table>
        </section>

        <!-- Lokasi Peta -->
        <section aria-labelledby="konfirmasi-lokasi-heading">
          <h3 id="konfirmasi-lokasi-heading">Lokasi pada Peta</h3>
          <p id="ringkasan-lokasi-peta">Pilih kecamatan dan desa pada langkah sebelumnya.</p>
        </section>

        <!-- Persetujuan -->
        <fieldset>
          <legend>Pernyataan</legend>
          <input type="checkbox" id="persetujuan" name="persetujuan" required>
          <label for="persetujuan">
            Saya menyatakan bahwa informasi yang saya berikan adalah benar dan dapat dipertanggungjawabkan.
          </label>
        </fieldset>

        <button type="button" data-step-previous>Kembali</button>
        <button type="submit">Kirim</button>

      </section>

    </form>

  </main>

  <script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""
  ></script>
  <script>
    var formLaporan = document.getElementById('form-laporan');
    var aksesLaporan = document.getElementById('akses-laporan');
    var laporanBerhasil = null; // redirect ke /notifikasi sekarang
    var kecamatanSelect = document.getElementById('kecamatan');
    var kelurahanSelect = document.getElementById('kelurahan');
    var koordinatInput = document.getElementById('titik-maps');
    var tombolLokasiSaya = document.getElementById('gunakan-lokasi-saya');
    var petaStatus = document.getElementById('peta-status');
    var navigasiLangkah = document.querySelector(
      'nav[aria-label="Langkah pengisian laporan"]'
    );
    var langkahLaporan = Array.from(formLaporan.querySelectorAll(':scope > section'));
    var indikatorLangkah = Array.from(document.querySelectorAll(
      'nav[aria-label="Langkah pengisian laporan"] li'
    ));
    var langkahAktif = 0;
    var petaLokasi;
    var penandaLokasi;

    // Simpan data URL foto agar tidak hilang saat section di-hidden
    var fotoDataURLs = [];
    var koordinatKabupatenNganjuk = [-7.6150161, 111.9465075];

    // ── Data lengkap kecamatan Kabupaten Nganjuk ─────────────────────
    var lokasiKecamatan = {
      bagor:       { nama: 'Kecamatan Bagor',       koordinat: [-7.574,  111.881] },
      baron:       { nama: 'Kecamatan Baron',        koordinat: [-7.518,  111.987] },
      berbek:      { nama: 'Kecamatan Berbek',       koordinat: [-7.645,  111.864] },
      gondang:     { nama: 'Kecamatan Gondang',      koordinat: [-7.548,  111.838] },
      jatikalen:   { nama: 'Kecamatan Jatikalen',    koordinat: [-7.506,  111.923] },
      kertosono:   { nama: 'Kecamatan Kertosono',    koordinat: [-7.588,  112.100] },
      lengkong:    { nama: 'Kecamatan Lengkong',     koordinat: [-7.530,  111.875] },
      loceret:     { nama: 'Kecamatan Loceret',      koordinat: [-7.708,  111.925] },
      nganjuk:     { nama: 'Kecamatan Nganjuk',      koordinat: [-7.605,  111.903] },
      ngetos:      { nama: 'Kecamatan Ngetos',       koordinat: [-7.680,  111.875] },
      ngluyu:      { nama: 'Kecamatan Ngluyu',       koordinat: [-7.482,  111.822] },
      ngronggot:   { nama: 'Kecamatan Ngronggot',    koordinat: [-7.671,  112.056] },
      pace:        { nama: 'Kecamatan Pace',         koordinat: [-7.682,  111.936] },
      patianrowo:  { nama: 'Kecamatan Patianrowo',   koordinat: [-7.601,  112.063] },
      prambon:     { nama: 'Kecamatan Prambon',      koordinat: [-7.720,  112.025] },
      rejoso:      { nama: 'Kecamatan Rejoso',       koordinat: [-7.663,  111.998] },
      sawahan:     { nama: 'Kecamatan Sawahan',      koordinat: [-7.712,  111.849] },
      sukomoro:    { nama: 'Kecamatan Sukomoro',     koordinat: [-7.562,  111.952] },
      tanjunganom: { nama: 'Kecamatan Tanjunganom',  koordinat: [-7.629,  112.019] },
      wilangan:    { nama: 'Kecamatan Wilangan',     koordinat: [-7.605,  111.820] }
    };

    // ── Desa/kelurahan per kecamatan ─────────────────────────────────
    // Sumber: https://wilayah.id/api/villages/35.18.{kode-kecamatan}.json
    var desaPerKecamatan = {
      bagor:       ['Guyangan','Kedondong','Balongrejo','Girirejo','Pesudukuh','Sekarputih','Buduran','Ngumpul','Bagor Kulon','Petak','Paron','Karang Tengah','Selorejo','Gandu','Kerepkidul','Kutorejo','Sugihwaras','Gemenggeng','Kendalrejo','Banaran Kulon','Banaran Wetan'],
      baron:       ['Sambiroto','Gebangkerep','Baron','Waung','Kemlokolegi','Kemaduh','Garu','Jekek','Katerban','Mabung','Jambi'],
      berbek:      ['Salamrojo','Cepoko','Maguan','Semare','Berbek','Mlilir','Bendungrejo','Sengkut','Ngrawan','Sumberwindu','Kacangan','Sendangbumen','Patranrejo','Sumberurip','Bulu','Grojogan','Tiripan','Balongrejo','Sonopatik'],
      gondang:     ['Sumberjo','Nglinggo','Mojoseto','Karangsemi','Senjayan','Kedungglugu',"Ja'an",'Sumberagung','Ketawang','Ngujung','Sanggrahan','Balonggebang','Pandean','Campur','Gondangkulon','Senggowar','Losari'],
      jatikalen:   ['Perning','Ngasem','Gondang Wetan','Jatikalen','Begendeng','Lumpangkuwik','Dawuhan','Munung','Pulowetan','Pule','Dlururejo'],
      kertosono:   ['Banaran','Drenges','Juwono','Bangsri','Kalianyar','Tanjung','Nglawak','Kepuh','Tembarak','Pelem','Kutorejo','Lambangkuning','Pandantoyo','Kudu'],
      lengkong:    ['Banjardowo','Lengkong','Jegreg','Kedungmlaten','Prayungan','Sumbersono','Balongasem','Sawahan','Ngringin','Jatipunggur','Ketandan','Sumberkepuh','Ngepung','Pinggir','Bangle','Sumbermiri'],
      loceret:     ['Tanjungrejo','Sombron','Genjeng','Karangsono','Ngepeh','Godean','Patihan','Mungkung','Sekaran','Loceret','Jatirejo','Tempel Wetan','Tekenglagahan','Gejagan','Candirejo','Sukorejo','Kwagean','Kenep','Putukrejo','Nglaban','Macanan','Bajulan'],
      nganjuk:     ['Jatirejo','Ploso','Payaman','Kramat','Ganung Kidul','Werungotok','Mangundikaran','Kauman','Kartoharjo','Cangkringan','Bogo','Ringinanom','Begadung','Kedungdowo','Balongpacul'],
      ngetos:      ['Kuncir','Kepel','Suru','Ngetos','Klodan','Mojoduwur','Kweden','Blongko','Oro-oro Ombo'],
      ngluyu:      ['Sugihwaras','Ngluyu','Tempuran','Lengkong Lor','Gampeng','Bajang'],
      ngronggot:   ['Cengkok','Tanjungkalang','Juwet','Kelutan','Ngronggot','Mojokendil','Betet','Kaloran','Banjarsari','Dadapan','Trayang','Kalianyar','Klurahan'],
      pace:        ['Jampes','Mlandangan','Gondang','Jatigreges','Joho','Sanan','Pacekulon','Cerme','Babadan','Batembat','Banaran','Bodor','Pacewetan','Jetis','Gemenggeng','Kecubung','Plosoharjo','Kepanjen'],
      patianrowo:  ['Bukur','Babadan','Ngepung','Pisang','Lestari','Pecuk','Patianrowo','Pakuncen','Rowomarto','Ngrombot','Tirtobinangun'],
      prambon:     ['Gondanglegi','Singkalanyar','Mojoagung','Bandung','Nglawak','Baleturi','Tegaron','Tanjungtani','Sanggrahan','Rowoharjo','Sugihwaras','Watudandang','Sono Ageng','Kurungrejo'],
      rejoso:      ['Gempol','Mungkung','Setren','Sukorejo','Sidokare','Mojorembun','Ngadiboyo','Rejoso','Klagen','Jatirejo','Mlorah','Puhkerep','Talun','Ngangkatan','Talang','Banjarejo','Sambikerep','Musir Lor','Musir Kidul','Wengkal','Jintel','Kedungpadang','Tritik','Bendoasri'],
      sawahan:     ['Bendolo','Sawahan','Ngliman','Bareng','Sidorejo','Duren','Siwalan','Margopatut','Kebonagung'],
      sukomoro:    ['Kapas','Sukomoro','Sumengko','Blitaran','Kedungsoko','Nglundo','Bungur','Pehserut','Ngrami','Bagor Wetan','Putren','Ngrengket'],
      tanjunganom: ['Tanjunganom','Warujayeng','Kedungombo','Sumberkepuh','Wates','Malangsari','Getas','Sonobekel','Ngadirejo','Banjaranyar','Sidoharjo','Kampungbaru','Jogomerto','Kedungrejo','Sambirejo','Demangan'],
      wilangan:    ['Sudimoroharjo','Wilangan','Ngadipiro','Mancon','Ngudikan','Sukoharjo']
    };

    var lokasiKelurahan = {};
    var permintaanLokasiKelurahan = 0;

    function inisialisasiPetaLokasi() {
      if (petaLokasi) {
        petaLokasi.invalidateSize();
        return;
      }

      if (window.location.protocol === 'file:') {
        petaStatus.textContent = 'Peta OpenStreetMap tidak dapat dimuat langsung dari file. Jalankan situs melalui server lokal, misalnya VS Code Live Server, lalu buka lewat http://localhost.';
        return;
      }

      if (typeof L === 'undefined') {
        petaStatus.textContent = 'Peta tidak dapat dimuat. Periksa koneksi internet lalu muat ulang halaman.';
        return;
      }

      petaLokasi = L.map('peta-lokasi').setView(koordinatKabupatenNganjuk, 11);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
      }).addTo(petaLokasi);
      penandaLokasi = L.marker(koordinatKabupatenNganjuk, { draggable: true })
        .addTo(petaLokasi)
        .bindPopup('Kabupaten Nganjuk');
      penandaLokasi.on('dragend', function () {
        var koordinat = penandaLokasi.getLatLng();
        var koordinatTerpilih = [koordinat.lat, koordinat.lng];
        var koordinatTeks = koordinatTerpilih.map(function (nilai) {
          return nilai.toFixed(6);
        }).join(', ');

        koordinatInput.value = koordinatTeks;
        penandaLokasi.bindPopup('Titik terpilih: ' + koordinatTeks).openPopup();
        petaStatus.textContent = 'Titik lokasi dipilih pada koordinat ' + koordinatTeks + '.';
      });
    }

    function arahkanPeta(koordinat, zoom, namaLokasi) {
      if (!petaLokasi) {
        return;
      }

      koordinatInput.value = koordinat.map(function (nilai) {
        return nilai.toFixed(6);
      }).join(', ');
      petaLokasi.flyTo(koordinat, zoom);
      penandaLokasi.setLatLng(koordinat).bindPopup(namaLokasi).openPopup();
      petaStatus.textContent = 'Peta menampilkan ' + namaLokasi + '.';
    }

    function perbaruiPetaDariPilihan() {
      var kecamatanVal = kecamatanSelect.value;
      var kelurahanVal = kelurahanSelect.value;
      var kecamatan    = lokasiKecamatan[kecamatanVal];

      if (kecamatan) {
        var namaLokasi = kecamatan.nama;
        if (kelurahanVal) {
          var opsiKelurahan = kelurahanSelect.options[kelurahanSelect.selectedIndex];
          var namaKelurahan = opsiKelurahan ? opsiKelurahan.textContent : kelurahanVal;
          var kunciLokasi = kecamatanVal + ':' + kelurahanVal;
          namaLokasi = 'Desa/Kel. ' + namaKelurahan + ', ' + kecamatan.nama;

          if (lokasiKelurahan[kunciLokasi]) {
            arahkanPeta(lokasiKelurahan[kunciLokasi], 15, namaLokasi);
            petaStatus.textContent = 'Titik perkiraan ' + namaKelurahan + '. Geser penanda untuk menyesuaikan.';
            return;
          }

          arahkanPeta(kecamatan.koordinat, 14, namaLokasi);
          petaStatus.textContent = 'Mencari titik perkiraan Desa/Kel. ' + namaKelurahan + '...';
          cariKoordinatKelurahan(kecamatanVal, kelurahanVal, namaKelurahan, kecamatan);
          return;
        }
        permintaanLokasiKelurahan++;
        arahkanPeta(kecamatan.koordinat, 12, namaLokasi);
      } else {
        permintaanLokasiKelurahan++;
        arahkanPeta(koordinatKabupatenNganjuk, 11, 'Kabupaten Nganjuk');
      }
    }

    function cariKoordinatKelurahan(kecamatanVal, kelurahanVal, namaKelurahan, kecamatan) {
      var idPermintaan = ++permintaanLokasiKelurahan;
      var parameter = new URLSearchParams({
        q: namaKelurahan,
        lat: kecamatan.koordinat[0],
        lon: kecamatan.koordinat[1],
        bbox: [kecamatan.koordinat[1] - 0.12, kecamatan.koordinat[0] - 0.12,
               kecamatan.koordinat[1] + 0.12, kecamatan.koordinat[0] + 0.12].join(','),
        limit: 10
      });

      fetch('https://photon.komoot.io/api/?' + parameter.toString())
        .then(function (respons) {
          if (!respons.ok) {
            throw new Error('Layanan pencarian titik desa tidak merespons.');
          }
          return respons.json();
        })
        .then(function (hasil) {
          if (idPermintaan !== permintaanLokasiKelurahan
            || kecamatanSelect.value !== kecamatanVal
            || kelurahanSelect.value !== kelurahanVal) {
            return;
          }

          var lokasi = (hasil.features || []).find(function (fitur) {
            var properti = fitur.properties || {};
            var koordinat = fitur.geometry && fitur.geometry.coordinates;
            var kabupaten = normalisasiNamaWilayah(properti.county || '');
            var jarakLat = Number(koordinat && koordinat[1]) - kecamatan.koordinat[0];
            var jarakLon = Number(koordinat && koordinat[0]) - kecamatan.koordinat[1];
            var dekatKecamatan = Math.sqrt(jarakLat * jarakLat + jarakLon * jarakLon) <= 0.18;

            return koordinat
              && normalisasiNamaWilayah(properti.name || '') === normalisasiNamaWilayah(namaKelurahan)
              && properti.countrycode === 'ID'
              && kabupaten.indexOf('nganjuk') !== -1
              && dekatKecamatan;
          });

          if (!lokasi) {
            koordinatInput.value = '';
            petaStatus.textContent = 'Titik Desa/Kel. ' + namaKelurahan + ' belum tersedia di peta. Penanda tetap di pusat kecamatan; geser penanda ke lokasi yang benar.';
            return;
          }

          var koordinat = [
            Number(lokasi.geometry.coordinates[1]),
            Number(lokasi.geometry.coordinates[0])
          ];
          lokasiKelurahan[kecamatanVal + ':' + kelurahanVal] = koordinat;
          arahkanPeta(koordinat, 15, 'Perkiraan Desa/Kel. ' + namaKelurahan + ', ' + kecamatan.nama);
          petaStatus.textContent = 'Titik perkiraan ' + namaKelurahan + '. Geser penanda untuk menyesuaikan.';
        })
        .catch(function () {
          if (idPermintaan === permintaanLokasiKelurahan
            && kecamatanSelect.value === kecamatanVal
            && kelurahanSelect.value === kelurahanVal) {
            koordinatInput.value = '';
            petaStatus.textContent = 'Titik Desa/Kel. ' + namaKelurahan + ' tidak dapat dicari. Penanda tetap di pusat kecamatan; geser penanda ke lokasi yang benar.';
          }
        });
    }

    // ── Isi dropdown kelurahan berdasarkan kecamatan terpilih ────────
    function perbaruiDropdownKelurahan() {
      var kecamatanVal = kecamatanSelect.value;
      var daftar = desaPerKecamatan[kecamatanVal] || [];

      kelurahanSelect.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
      daftar.forEach(function(nama) {
        var opt = document.createElement('option');
        var val = nama.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-');
        opt.value = val;
        opt.textContent = nama;
        kelurahanSelect.appendChild(opt);
      });
      kelurahanSelect.disabled = daftar.length === 0;
    }

    function normalisasiNamaWilayah(nama) {
      return String(nama)
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/^(kecamatan|kec\.?|desa|kelurahan|kel\.?)\s+/i, '')
        .replace(/[^a-z0-9]/g, '');
    }

    function cariKecamatanDariAlamat(alamat) {
      var kunciAdministratif = [
        'city_district', 'district', 'municipality', 'suburb', 'town'
      ];
      var nilaiAlamat = kunciAdministratif
        .map(function (kunci) { return alamat[kunci]; })
        .filter(Boolean);

      return Array.from(kecamatanSelect.options).find(function (opsi) {
        return opsi.value && nilaiAlamat.some(function (nilai) {
          return normalisasiNamaWilayah(nilai) === normalisasiNamaWilayah(opsi.textContent);
        });
      });
    }

    function cariLokasiDesaDariAlamat(alamat, kecamatan) {
      var kunciAdministratif = [
        'village', 'town', 'suburb', 'hamlet', 'quarter', 'neighbourhood'
      ];
      var nilaiAlamat = kunciAdministratif
        .map(function (kunci) { return alamat[kunci]; })
        .filter(Boolean);

      function cariNamaDesa(daftar) {
        for (var i = 0; i < nilaiAlamat.length; i++) {
          var namaDesa = daftar.find(function (nama) {
            return normalisasiNamaWilayah(nilaiAlamat[i]) === normalisasiNamaWilayah(nama);
          });
          if (namaDesa) {
            return namaDesa;
          }
        }
        return null;
      }

      if (kecamatan) {
        return {
          kecamatan: kecamatan,
          kelurahan: cariNamaDesa(desaPerKecamatan[kecamatan.value] || [])
        };
      }

      var kecocokan = [];
      Object.keys(desaPerKecamatan).forEach(function (kecamatanVal) {
        var kelurahan = cariNamaDesa(desaPerKecamatan[kecamatanVal]);
        if (kelurahan) {
          var opsiKecamatan = Array.from(kecamatanSelect.options).find(function (opsi) {
            return opsi.value === kecamatanVal;
          });
          if (opsiKecamatan) {
            kecocokan.push({ kecamatan: opsiKecamatan, kelurahan: kelurahan });
          }
        }
      });

      return kecocokan.length === 1 ? kecocokan[0] : null;
    }

    var kolomAlamat = document.getElementById('alamat-lokasi');
    if (kolomAlamat) {
      // jika user mengetik sendiri, jangan ditimpa hasil peta
      kolomAlamat.addEventListener('input', function () {
        kolomAlamat.dataset.manual = kolomAlamat.value.trim() ? '1' : '0';
      });
    }

    function isiAlamatOtomatis(hasil) {
      if (!kolomAlamat || kolomAlamat.dataset.manual === '1') return;
      var a = hasil.address || {};
      var bagian = [
        (a.road ? a.road + (a.house_number ? ' No. ' + a.house_number : '') : null),
        a.neighbourhood || a.hamlet,
        a.village || a.suburb,
        a.city_district || a.county || a.municipality
      ].filter(Boolean);
      var teks = bagian.length
        ? bagian.join(', ')
        : (hasil.display_name || '').replace(/,\s*Indonesia$/, '').replace(/,\s*\d{5}/, '');
      var sumberRtRw = [a.neighbourhood, a.hamlet, a.quarter, a.residential, a.suburb, a.road, hasil.display_name]
        .filter(Boolean).join(' ');
      var rt = sumberRtRw.match(/\bRT\.?\s*0*(\d{1,3})\b/i);
      var rw = sumberRtRw.match(/\bRW\.?\s*0*(\d{1,3})\b/i);
      if ((rt || rw) && !/\bRT\b/i.test(teks)) {
        teks += ', ' + [rt ? 'RT ' + ('0' + rt[1]).slice(-2) : '', rw ? 'RW ' + ('0' + rw[1]).slice(-2) : '']
          .filter(Boolean).join(' ');
      }
      kolomAlamat.value = teks.slice(0, 150);
    }

    function perbaruiDropdownDariKoordinat(koordinat) {
      var parameter = new URLSearchParams({
        format: 'jsonv2',
        lat: koordinat[0],
        lon: koordinat[1],
        zoom: 18,
        addressdetails: 1,
        'accept-language': 'id'
      });

      return fetch('https://nominatim.openstreetmap.org/reverse?' + parameter.toString())
        .then(function (respons) {
          if (!respons.ok) {
            throw new Error('Layanan pencarian alamat tidak merespons.');
          }
          return respons.json();
        })
        .then(function (hasil) {
          var alamat = hasil.address || {};
          isiAlamatOtomatis(hasil);
          var kecamatan = cariKecamatanDariAlamat(alamat);
          var lokasiDesa = cariLokasiDesaDariAlamat(alamat, kecamatan);
          if (!kecamatan && lokasiDesa) {
            kecamatan = lokasiDesa.kecamatan;
          }
          kecamatanSelect.value = kecamatan ? kecamatan.value : '';
          perbaruiDropdownKelurahan();

          var kelurahan = lokasiDesa
            ? lokasiDesa.kelurahan
            : kecamatan
              ? cariLokasiDesaDariAlamat(alamat, kecamatan).kelurahan
              : null;
          kelurahanSelect.value = kelurahan
            ? Array.from(kelurahanSelect.options).find(function (opsi) {
                return normalisasiNamaWilayah(opsi.textContent) === normalisasiNamaWilayah(kelurahan);
              }).value
            : '';

          if (!kecamatan) {
            petaStatus.textContent = 'Lokasi ditemukan, tetapi kecamatan tidak cocok dengan data Kabupaten Nganjuk. Silakan pilih lokasi secara manual.';
          } else if (!kelurahan) {
            petaStatus.textContent = 'Kecamatan ' + kecamatan.textContent + ' terdeteksi. Kelurahan tidak dapat dikenali otomatis; silakan pilih kelurahan secara manual.';
          } else {
            petaStatus.textContent = 'Lokasi terdeteksi: ' + kelurahan + ', Kecamatan ' + kecamatan.textContent + '.';
          }
        });
    }

    // ── Isi ringkasan Langkah 3 dari data form ───────────────────────
    function isiRingkasan() {
      // Kategori
      var kategoriEl = document.querySelector('input[name="kategori"]:checked');
      var labelKategori = {
        'jalan': 'Jalan', 'lampu-jalan': 'Lampu Jalan', 'sampah': 'Sampah',
        'selokan': 'Selokan', 'taman': 'Taman', 'lainnya': 'Lainnya'
      };
      var rKategori = document.getElementById('ringkasan-kategori');
      if (rKategori) rKategori.textContent = kategoriEl
        ? (labelKategori[kategoriEl.value] || kategoriEl.value)
        : '—';

      // Deskripsi
      var deskripsiEl = document.getElementById('deskripsi');
      var rDeskripsi = document.getElementById('ringkasan-deskripsi');
      if (rDeskripsi && deskripsiEl) rDeskripsi.textContent = deskripsiEl.value || '—';

      // Kecamatan
      var kecamatanNama = kecamatanSelect.options[kecamatanSelect.selectedIndex]
        ? kecamatanSelect.options[kecamatanSelect.selectedIndex].textContent
        : '—';
      var rKecamatan = document.getElementById('ringkasan-kecamatan');
      if (rKecamatan) rKecamatan.textContent = kecamatanSelect.value ? kecamatanNama : '—';

      // Kelurahan
      var kelurahanNama = kelurahanSelect.options[kelurahanSelect.selectedIndex]
        ? kelurahanSelect.options[kelurahanSelect.selectedIndex].textContent
        : '—';
      var rKelurahan = document.getElementById('ringkasan-kelurahan');
      if (rKelurahan) rKelurahan.textContent = kelurahanSelect.value ? kelurahanNama : '—';

      // Koordinat
      var rKoordinat = document.getElementById('ringkasan-koordinat');
      if (rKoordinat) rKoordinat.textContent = koordinatInput.value || 'Tidak diisi';

      // Foto
      var rFoto = document.getElementById('ringkasan-foto');
      if (rFoto) rFoto.textContent = fotoDataURLs.length > 0
        ? fotoDataURLs.length + ' foto diunggah'
        : 'Tidak ada foto';

      // Teks lokasi peta
      var rLokasi = document.getElementById('ringkasan-lokasi-peta');
      if (rLokasi) {
        var lokasiTeks = [];
        if (kelurahanSelect.value) lokasiTeks.push(kelurahanNama);
        if (kecamatanSelect.value) lokasiTeks.push(kecamatanNama);
        rLokasi.textContent = lokasiTeks.length
          ? lokasiTeks.join(', ') + ', Kab. Nganjuk'
          : 'Pilih kecamatan dan desa pada langkah sebelumnya.';
      }
    }

    function tampilkanLangkah(index) {
      langkahAktif = index;

      langkahLaporan.forEach(function (langkah, langkahIndex) {
        langkah.hidden = langkahIndex !== langkahAktif;
        if (langkahIndex === langkahAktif) {
          langkah.querySelector('h1, h2').focus();
        }
      });

      if (langkahAktif === 1) {
        inisialisasiPetaLokasi();
        perbaruiPetaDariPilihan();
      }

      // Langkah 3: tampilkan pratinjau foto + isi ringkasan
      if (langkahAktif === 2) {
        tampilkanPratinjauFoto();
        isiRingkasan();
      }

      indikatorLangkah.forEach(function (indikator, langkahIndex) {
        if (langkahIndex === langkahAktif) {
          indikator.setAttribute('aria-current', 'step');
        } else {
          indikator.removeAttribute('aria-current');
        }
      });
    }

    formLaporan.addEventListener('click', function (event) {
      var tombol = event.target.closest('button');
      if (!tombol) {
        return;
      }

      if (tombol.hasAttribute('data-step-next')) {
        var langkah = langkahLaporan[langkahAktif];
        var inputTidakValid = Array.from(
          langkah.querySelectorAll('input, select, textarea')
        ).find(function (input) {
          return !input.checkValidity();
        });

        if (inputTidakValid) {
          inputTidakValid.reportValidity();
          return;
        }

        indikatorLangkah[langkahAktif].setAttribute('data-completed', 'true');
        tampilkanLangkah(langkahAktif + 1);
      } else if (tombol.hasAttribute('data-step-previous')) {
        tampilkanLangkah(langkahAktif - 1);
      }
    });

    kecamatanSelect.addEventListener('change', function () {
      perbaruiDropdownKelurahan();
      kelurahanSelect.value = '';
      perbaruiPetaDariPilihan();
    });
    kelurahanSelect.addEventListener('change', perbaruiPetaDariPilihan);
    tombolLokasiSaya.addEventListener('click', function () {
      if (!window.isSecureContext) {
        petaStatus.textContent = 'Fitur lokasi memerlukan koneksi aman. Buka situs melalui https:// atau http://localhost.';
        return;
      }

      if (!navigator.geolocation) {
        petaStatus.textContent = 'Browser ini tidak mendukung fitur lokasi.';
        return;
      }

      tombolLokasiSaya.disabled = true;
      petaStatus.textContent = 'Sedang mencari lokasi Anda... Izinkan akses lokasi pada browser jika diminta.';
      navigator.geolocation.getCurrentPosition(function (posisi) {
        var koordinat = [posisi.coords.latitude, posisi.coords.longitude];
        kecamatanSelect.value = '';
        perbaruiDropdownKelurahan();
        arahkanPeta(koordinat, 17, 'Lokasi Anda');
        perbaruiDropdownDariKoordinat(koordinat)
          .catch(function () {
            petaStatus.textContent = 'Koordinat ditemukan, tetapi alamat tidak dapat dicari. Periksa koneksi internet atau pilih kecamatan dan kelurahan secara manual.';
          })
          .finally(function () {
            tombolLokasiSaya.disabled = false;
          });
      }, function (kesalahan) {
        if (kesalahan.code === kesalahan.PERMISSION_DENIED) {
          petaStatus.textContent = 'Izin lokasi ditolak. Izinkan akses lokasi untuk situs ini melalui pengaturan browser.';
        } else if (kesalahan.code === kesalahan.POSITION_UNAVAILABLE) {
          petaStatus.textContent = 'Lokasi Anda tidak tersedia. Pastikan layanan lokasi perangkat aktif.';
        } else if (kesalahan.code === kesalahan.TIMEOUT) {
          petaStatus.textContent = 'Pencarian lokasi terlalu lama. Silakan coba lagi.';
        } else {
          petaStatus.textContent = 'Lokasi tidak dapat ditemukan. Silakan coba lagi.';
        }
        tombolLokasiSaya.disabled = false;
      }, {
        enableHighAccuracy: true,
        timeout: 15000,
        maximumAge: 0
      });
    });
    koordinatInput.addEventListener('change', function () {
      var koordinat = koordinatInput.value.split(',').map(function (nilai) {
        return Number(nilai.trim());
      });
      var valid = koordinat.length === 2
        && koordinatInput.value.split(',').every(function (nilai) {
          return nilai.trim() !== '';
        })
        && koordinat.every(Number.isFinite)
        && koordinat[0] >= -90 && koordinat[0] <= 90
        && koordinat[1] >= -180 && koordinat[1] <= 180;

      if (valid) {
        arahkanPeta(koordinat, 17, 'Koordinat ' + koordinat.join(', '));
      } else if (koordinatInput.value.trim()) {
        petaStatus.textContent = 'Format koordinat tidak valid. Gunakan latitude, longitude.';
      }
    });

    formLaporan.addEventListener('submit', function (event) {
      // Isi nama & email dari localStorage sebelum submit ke server
      var namaInput  = document.getElementById('hidden-nama-pelapor');
      var emailInput = document.getElementById('hidden-email-pelapor');
      if (namaInput)  namaInput.value  = localStorage.getItem('lingkunganku_nama')  || '';
      if (emailInput) emailInput.value = localStorage.getItem('lingkunganku_email') || '';
      // Biarkan form submit ke server (tidak preventDefault)
    });

    // sudahBerhasil tidak dipakai lagi (redirect ke /notifikasi)
    var sudahBerhasil = false;

    function periksaAksesLaporan() {
      var sudahLogin = localStorage.getItem('lingkunganku_logged_in') === 'true'
        && Boolean(localStorage.getItem('lingkunganku_nama'))
        && Boolean(localStorage.getItem('lingkunganku_email'));

      document.body.classList.toggle('laporan-perlu-login', !sudahLogin);
      formLaporan.hidden = !sudahLogin;
      aksesLaporan.hidden = sudahLogin;
      navigasiLangkah.setAttribute('aria-hidden', String(!sudahLogin));

      if (!sudahLogin) {
        localStorage.setItem('lingkunganku_redirect', '/buat-laporan');
      }
    }

    function tampilkanPratinjauFoto() {
      var grid = document.getElementById('pratinjau-foto-grid');
      if (!grid) return;

      grid.innerHTML = '';

      if (fotoDataURLs.length === 0) {
        var cap = document.createElement('figcaption');
        cap.style.cssText = 'color:#94a3b8;font-size:0.9rem;';
        cap.textContent = 'Tidak ada foto yang diunggah';
        grid.appendChild(cap);
        return;
      }

      fotoDataURLs.forEach(function(dataURL, index) {
        var wrapper = document.createElement('div');
        wrapper.style.cssText = 'width:160px;height:120px;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0;flex-shrink:0;';
        var img = document.createElement('img');
        img.src = dataURL;
        img.alt = 'Foto laporan ' + (index + 1);
        img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
        wrapper.appendChild(img);
        grid.appendChild(wrapper);
      });
    }

    // Tangkap foto segera saat dipilih & tampilkan preview di langkah 1
    document.getElementById('foto-laporan').addEventListener('change', function() {
      fotoDataURLs = [];
      var preview1 = document.getElementById('preview-step1');
      if (preview1) preview1.innerHTML = '';

      Array.from(this.files).forEach(function(file, index) {
        var reader = new FileReader();
        reader.onload = function(e) {
          fotoDataURLs.push(e.target.result);
          // Preview kecil di langkah 1
          if (preview1) {
            var thumb = document.createElement('img');
            thumb.src = e.target.result;
            thumb.alt = 'Preview ' + (index + 1);
            thumb.style.cssText = 'width:80px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;';
            preview1.appendChild(thumb);
          }
        };
        reader.readAsDataURL(file);
      });
    });

    periksaAksesLaporan();
    window.addEventListener('pageshow', periksaAksesLaporan);
    window.addEventListener('storage', periksaAksesLaporan);

    // Inisialisasi: kelurahan disabled sampai kecamatan dipilih
    kelurahanSelect.disabled = true;

    // Kunci isian lokasi lain sampai Kecamatan dipilih
    var kolomAlamatKunci = document.getElementById('alamat-lokasi');
    var elemenPeta = document.getElementById('peta-lokasi');
    function terapkanKunciLokasi() {
      var terkunci = !kecamatanSelect.value;
      [kolomAlamatKunci, koordinatInput].forEach(function (el) {
        if (el) el.disabled = terkunci;
      });
      if (elemenPeta) elemenPeta.classList.toggle('peta-terkunci', terkunci);
    }
    kecamatanSelect.addEventListener('change', terapkanKunciLokasi);
    setInterval(terapkanKunciLokasi, 400);
    tombolLokasiSaya.disabled = false;

    // Kosongkan titik awal: koordinat baru terisi setelah user memilih
    koordinatInput.value = '';
    if (penandaLokasi) { penandaLokasi.closePopup(); }
    petaStatus.textContent = 'Pilih kecamatan terlebih dahulu, lalu tentukan titik lokasi di peta.';
    terapkanKunciLokasi();

    // Pasang klik-di-peta begitu peta selesai dibuat (peta dibuat belakangan)
    var pemasangKlikPeta = setInterval(function () {
      if (!petaLokasi || !penandaLokasi) return;
      clearInterval(pemasangKlikPeta);
      if (petaLokasi._klikDipasang) return;
      petaLokasi._klikDipasang = true;
      petaLokasi.on('click', function (e) {
        pilihTitikDiPeta([e.latlng.lat, e.latlng.lng]);
      });
      penandaLokasi.on('dragend', function () {
        var k = penandaLokasi.getLatLng();
        perbaruiDropdownDariKoordinat([k.lat, k.lng]).catch(function () {
          petaStatus.textContent = 'Titik dipilih, tetapi alamat tidak dapat dicari. Isi alamat secara manual.';
        });
      });
    }, 300);

    // Klik di peta = pindahkan penanda ke titik itu; geser penanda tetap bisa
    function pilihTitikDiPeta(koordinat) {
      var teks = koordinat.map(function (n) { return n.toFixed(6); }).join(', ');
      koordinatInput.value = teks;
      penandaLokasi.setLatLng(koordinat).bindPopup('Titik terpilih: ' + teks).openPopup();
      petaStatus.textContent = 'Titik lokasi dipilih pada koordinat ' + teks + '. Mencari alamat...';
      perbaruiDropdownDariKoordinat(koordinat).catch(function () {
        petaStatus.textContent = 'Titik dipilih pada koordinat ' + teks + ', tetapi alamat tidak dapat dicari. Isi alamat secara manual.';
      });
    }
    if (petaLokasi && penandaLokasi) {
      petaLokasi.on('click', function (e) {
        pilihTitikDiPeta([e.latlng.lat, e.latlng.lng]);
      });
      penandaLokasi.on('dragend', function () {
        var k = penandaLokasi.getLatLng();
        perbaruiDropdownDariKoordinat([k.lat, k.lng]).catch(function () {
          petaStatus.textContent = 'Titik dipilih, tetapi alamat tidak dapat dicari. Isi alamat secara manual.';
        });
      });
    }
  </script>

@if (session('laporan_terkirim') || request()->query('terkirim'))
<style>#popup-terkirim[hidden]{display:none !important}</style>
<div id="popup-terkirim" role="dialog" aria-modal="true" aria-label="Laporan terkirim">
  <div class="pt-box">
    <button type="button" class="pt-x" id="pt-tutup" aria-label="Tutup"></button>
    <div class="pt-ikon">&#10003;</div>
    <h2>Laporan terkirim</h2>
    <p>Terima kasih, laporanmu sudah masuk dan akan segera ditinjau.</p>
    <a class="pt-link" href="/notifikasi">Lihat Notifikasi</a>
  </div>
</div>
<script>
  try { history.replaceState(null, '', location.pathname); } catch (e) {}
  document.getElementById('pt-tutup').addEventListener('click', function () {
    document.getElementById('popup-terkirim').hidden = true;
  });
</script>
@endif
<script src="/js/laporan-fokus.js?v=2"></script>
  <script src="/js/foto-cek.js?v=3"></script>
  <script src="/js/foto-kompres.js?v=1"></script>
  <script src="/js/foto-kirim.js?v=3"></script>
</body>
</html>
