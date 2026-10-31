<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Pengaturan</title>
  <meta name="description" content="Halaman pengaturan profil pengguna LingkunganKU.">
  <link rel="stylesheet" href="/css/base.css">
  <link rel="stylesheet" href="/css/profil.css">
  <link rel="stylesheet" href="/css/navbar.css?v=8">
  <link rel="stylesheet" href="/css/chatbot.css">
  <script src="/js/clarity.js"></script>
  <meta name="csrf-token" content="<?= csrf_token() ?>">
</head>
<body>

  <header class="site-header"></header>
  <script src="/js/navbar.js?v=12"></script>


<main>

    <!-- ===== Kolom kiri ===== -->
    <aside class="sidebar">

      <!-- Info Profil -->
      <section id="info-profil" aria-labelledby="profil-heading">
        <h2 id="profil-heading">Profil Pengguna</h2>
        <table>
          <tr>
            <td>
              <img id="foto-sidebar" src="/assets/images/avatar-default.png" alt="Foto profil" width="52" height="52">
            </td>
            <td>
              <strong id="profil-nama">-</strong><br>
              <small id="profil-kontak">-</small>
            </td>
          </tr>
        </table>
        <a href="#akun" aria-label="Lihat profil">&rsaquo;</a>
      </section>

      <!-- Menu Pengaturan -->
      <nav class="menu" aria-label="Menu Pengaturan">
        <a href="#akun" class="menu-item aktif" data-panel="akun" aria-current="true"><div><b>Akun</b><small>Kelola akun</small></div></a>
        <a href="#bantuan" class="menu-item" data-panel="bantuan"><div><b>Bantuan</b><small>Pusat bantuan dan FAQ</small></div></a>
        <a href="#syarat" class="menu-item" data-panel="syarat"><div><b>Syarat dan ketentuan</b><small>Ketentuan penggunaan aplikasi</small></div></a>
        <a href="#tentang" class="menu-item" data-panel="tentang"><div><b>Tentang Lingkunganku</b><small>Versi aplikasi 1.0.0</small></div></a>
        <a href="#privasi" class="menu-item" data-panel="privasi"><div><b>Privasi dan Keamanan</b><small>Ubah informasi akun</small></div></a>
      </nav>



      <!-- Tombol Keluar -->
      <section class="keluar" aria-label="Keluar Akun">
        <a href="/login" id="link-keluar">Keluar</a>
        <p>Versi 1.0.0</p>
      </section>

    </aside>

    <!-- ===== Kolom kanan: form akun ===== -->
    <section class="content">

    <!-- Tombol Back (mobile only) -->
    <button type="button" class="profil-back-btn" id="profil-back-btn" aria-label="Kembali ke menu">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
           fill="none" stroke="currentColor" stroke-width="2.5"
           stroke-linecap="round" stroke-linejoin="round">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      <span id="profil-back-label">Profil</span>
    </button>
    <div class="panel" id="panel-akun">
      <h2 class="judul-akun" id="akun-heading">Akun</h2>

      <form id="form-akun" novalidate>

        <div class="blok">
          <div class="foto">
            <img id="foto-preview" src="/assets/images/avatar-default.png" alt="Foto profil saat ini">
            <div>
              <h3>Foto profil</h3>
              <div class="aksi">
                <input type="file" id="input-foto" accept="image/png,image/jpeg,image/gif" hidden>
                <button type="button" class="btn utama" id="btn-unggah">Unggah foto</button>
                <button type="button" class="btn" id="btn-hapus-foto">Hapus</button>
              </div>
              <small>Format PNG, JPEG, atau GIF, maksimal 2 MB. Foto tersimpan otomatis setelah dipilih.</small>
            </div>
          </div>

          <div class="baris">
            <div>
              <label for="nama-depan">Nama depan</label>
              <input type="text" id="nama-depan" autocomplete="given-name">
            </div>
            <div>
              <label for="nama-belakang">Nama belakang</label>
              <input type="text" id="nama-belakang" autocomplete="family-name">
            </div>
          </div>

          <div class="baris satu">
            <div>
              <label for="email">Email</label>
              <div class="email-wrap">
                <input type="email" id="email" readonly autocomplete="email">
                <button type="button" class="btn" id="btn-ubah-email">Ubah email</button>
              </div>
              <p class="hint">Dipakai untuk masuk ke akunmu.</p>
            </div>
          </div>
        </div>

        <div class="blok sandi">
          <div>
            <h3>Kata sandi</h3>
            <p>Masuk dengan kata sandi, tanpa kode login sementara.</p>
          </div>
          <button type="button" class="btn" id="btn-ubah-sandi">Ubah kata sandi</button>
        </div>

        <div class="footer-form">
          <span id="status" role="status" aria-live="polite"></span>
          <button type="button" class="btn" id="btn-batal">Batal</button>
          <button type="submit" class="btn utama">Simpan</button>
        </div>

      </form>
    </div>

    <!-- ===== Bantuan ===== -->
    <div class="panel" id="panel-bantuan" hidden>
      <h2 class="judul-akun">Bantuan</h2>

      <div class="blok">
        <label for="cari-bantuan">Cari bantuan</label>
        <input type="search" id="cari-bantuan" placeholder="Contoh: status laporan, foto, kata sandi">
      </div>

      <div class="blok">
        <h3 class="sub-judul">Panduan singkat</h3>
        <ol class="langkah">
          <li><div><b>Masuk atau daftar</b><span>Buat akun baru atau masuk dengan akun yang sudah ada.</span></div></li>
          <li><div><b>Buat laporan</b><span>Buka menu Buat Laporan, isi formulir, lalu lampirkan foto dan lokasi.</span></div></li>
          <li><div><b>Kirim laporan</b><span>Periksa kembali isinya, lalu kirim.</span></div></li>
          <li><div><b>Pantau perkembangan</b><span>Lihat status laporanmu di menu Notifikasi.</span></div></li>
        </ol>
      </div>

      <div class="blok" id="faq">
        <h3 class="sub-judul">Pertanyaan yang sering diajukan</h3>

        <div class="faq-grup">
          <h4>Akun dan masuk</h4>
          <div class="faq">
            <details><summary>Bagaimana cara mendaftar akun baru?</summary>
              <p>Pilih <b>Daftar</b> di bagian atas halaman, isi data yang diminta, lalu masuk dengan akun yang baru dibuat.</p></details>
            <details><summary>Bagaimana cara mengganti kata sandi?</summary>
              <p>Fitur ubah kata sandi masih dalam pengembangan dan akan tersedia pada versi berikutnya.</p></details>
            <details><summary>Bagaimana cara keluar dari akun?</summary>
              <p>Tekan tombol <b>Keluar</b> di bagian bawah menu sebelah kiri.</p></details>
          </div>
        </div>

        <div class="faq-grup">
          <h4>Membuat laporan</h4>
          <div class="faq">
            <details><summary>Bagaimana cara membuat laporan?</summary>
              <p>Buka menu <b>Buat Laporan</b>, isi formulir yang tersedia, tambahkan foto jika ada, lalu kirim.</p></details>
            <details><summary>Masalah apa saja yang bisa dilaporkan?</summary>
              <p>Masalah lingkungan di sekitarmu, misalnya jalan rusak, lampu jalan mati, sampah menumpuk, dan drainase.</p></details>
            <details><summary>Apakah laporan harus memakai foto?</summary>
              <p>Foto sangat dianjurkan agar petugas lebih mudah memahami kondisi di lapangan.</p></details>
          </div>
        </div>

        <div class="faq-grup">
          <h4>Status dan notifikasi</h4>
          <div class="faq">
            <details><summary>Apa arti status laporan?</summary>
              <p>Lihat tabel status di bawah. Setiap perubahan status akan muncul di menu <b>Notifikasi</b>.</p></details>
            <details><summary>Di mana saya melihat perkembangan laporan?</summary>
              <p>Buka menu <b>Notifikasi</b>. Gunakan tab Laporan atau filter status untuk mempersempit daftar.</p></details>
            <details><summary>Bagaimana menandai notifikasi sudah dibaca?</summary>
              <p>Klik notifikasinya, atau tekan <b>Tandai semua dibaca</b> di bagian atas daftar.</p></details>
          </div>
        </div>

        <div class="faq-grup">
          <h4>Profil dan wilayah layanan</h4>
          <div class="faq">
            <details><summary>Bagaimana mengubah nama, email, atau foto profil?</summary>
              <p>Buka menu <b>Akun</b> di halaman ini, ubah datanya, lalu tekan <b>Simpan</b>.</p></details>
            <details><summary>Kenapa laporan saya ditolak?</summary>
              <p>Salah satu penyebabnya lokasi laporan berada di luar wilayah layanan. Alasan lengkapnya selalu dicantumkan di notifikasi laporan.</p></details>
            <details><summary>Wilayah mana saja yang dilayani?</summary>
              <p>Saat ini layanan mencakup Kabupaten Nganjuk.</p></details>
          </div>
        </div>

        <p class="hint" id="faq-kosong" hidden>Tidak ada pertanyaan yang cocok. Coba kata kunci lain atau tanyakan ke asisten.</p>
      </div>

      <div class="blok">
        <h3 class="sub-judul">Arti status laporan</h3>
        <div class="tabel-bungkus">
          <table class="tabel-status">
            <tr><td><span class="lencana diterima">Diterima</span></td><td>Laporan masuk dan sedang ditinjau.</td></tr>
            <tr><td><span class="lencana diproses">Diproses</span></td><td>Petugas sudah menerima laporan dan sedang menanganinya.</td></tr>
            <tr><td><span class="lencana selesai">Selesai</span></td><td>Laporan sudah ditindaklanjuti.</td></tr>
            <tr><td><span class="lencana ditolak">Ditolak</span></td><td>Laporan tidak dapat diproses. Alasannya tertulis di notifikasi.</td></tr>
          </table>
        </div>
      </div>

      <div class="blok">
        <h3 class="sub-judul">Tips agar laporan cepat ditangani</h3>
        <ul class="tips">
          <li>Tulis lokasi sejelas mungkin, seperti nama jalan, desa, atau patokan.</li>
          <li>Lampirkan foto yang jelas dan tidak buram.</li>
          <li>Satu laporan untuk satu masalah.</li>
          <li>Pastikan lokasi berada di wilayah layanan.</li>
        </ul>
      </div>

      <div class="blok kontak">
        <div>
          <h3>Belum menemukan jawaban?</h3>
          <p>Tanyakan ke asisten atau hubungi kami lewat email.</p>
        </div>
        <div class="aksi-kontak">
          <button type="button" class="btn utama" data-buka-chatbot>Tanya asisten</button>
          <a class="btn" href="mailto:admin@lingkunganku.id">Kirim email</a>
        </div>
      </div>
    </div>

    <!-- ===== Syarat dan ketentuan ===== -->
    <div class="panel" id="panel-syarat" hidden>
      <h2 class="judul-akun">Syarat dan ketentuan</h2>
      <div class="blok teks">
        <h3>Penggunaan layanan</h3>
        <p>LingkunganKU adalah platform untuk melaporkan masalah lingkungan. Dengan memakai aplikasi ini, Anda menyetujui ketentuan di halaman ini.</p>
        <h3>Akun pengguna</h3>
        <p>Anda bertanggung jawab atas keamanan akun dan data yang Anda masukkan. Jangan membagikan kata sandi kepada orang lain.</p>
        <h3>Isi laporan</h3>
        <p>Laporan harus berisi informasi yang benar dan sesuai kejadian. Laporan yang palsu, menyinggung, atau tidak berkaitan dengan lingkungan dapat ditolak.</p>
        <h3>Wilayah layanan</h3>
        <p>Laporan diproses untuk wilayah Kabupaten Nganjuk. Laporan di luar wilayah tersebut tidak dapat ditindaklanjuti.</p>
        <h3>Penanganan laporan</h3>
        <p>Status laporan diperbarui oleh petugas dan dapat dilihat di menu Notifikasi. Waktu penanganan dapat berbeda untuk setiap laporan.</p>
        <h3>Perubahan ketentuan</h3>
        <p>Ketentuan ini dapat diperbarui sewaktu-waktu. Versi terbaru selalu tersedia di halaman ini.</p>
      </div>
    </div>

    <!-- ===== Tentang ===== -->
    <div class="panel" id="panel-tentang" hidden>
      <h2 class="judul-akun">Tentang Lingkunganku</h2>
      <div class="blok">
        <div class="tentang-kepala">
          <img src="/assets/images/logo.webp" alt="Logo LingkunganKU">
          <div>
            <h3>LingkunganKU</h3>
            <p>Platform pelaporan lingkungan</p>
          </div>
        </div>
        <p class="teks-isi">LingkunganKU membantu warga melaporkan masalah lingkungan di sekitarnya, seperti jalan rusak, lampu jalan mati, sampah menumpuk, dan drainase, lalu memantau penanganannya sampai selesai.</p>
        <dl class="info">
          <div><dt>Versi aplikasi</dt><dd>1.0.0</dd></div>
          <div><dt>Wilayah layanan</dt><dd>Kabupaten Nganjuk</dd></div>
          <div><dt>Kontak</dt><dd>admin@lingkunganku.id</dd></div>
        </dl>
      </div>
    </div>

    <!-- ===== Privasi dan Keamanan ===== -->
    <div class="panel" id="panel-privasi" hidden>
      <h2 class="judul-akun">Privasi dan Keamanan</h2>
      <div class="blok teks">
        <h3>Data yang disimpan</h3>
        <p>Aplikasi menyimpan nama, email, dan foto profil Anda, serta laporan yang Anda buat, untuk menampilkan akun dan memantau laporan.</p>
        <h3>Tips keamanan</h3>
        <p>Gunakan kata sandi yang sulit ditebak, jangan membagikannya, dan selalu tekan <b>Keluar</b> setelah memakai perangkat bersama.</p>
      </div>
      <div class="blok sandi">
        <div>
          <h3>Kata sandi</h3>
          <p>Ubah kata sandi untuk menjaga keamanan akun.</p>
        </div>
        <button type="button" class="btn" id="btn-sandi-privasi">Ubah kata sandi</button>
      </div>
      <div class="blok sandi">
        <div>
          <h3>Data tampilan di perangkat ini</h3>
          <p>Hapus penanda notifikasi dibaca dan posisi tombol asisten.</p>
        </div>
        <button type="button" class="btn" id="btn-hapus-tampilan">Hapus data tampilan</button>
      </div>
    </div>
  </section>

  </main>

    <script src="/js/foto-crop.js"></script>
  <script src="/js/profil.js"></script>
  <script src="/js/faq-data.js"></script>
  <script src="/js/chatbot.js?v=2"></script>
  <script src="/js/chatbot-drag.js"></script>
</body>
</html>