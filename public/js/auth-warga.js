(function () {
  // hapus akun lama yang menyimpan password terbuka di browser
  try { localStorage.removeItem('lingkunganku_accounts'); } catch (e) {}

  var form = document.getElementById('form-login') || document.getElementById('form-register');
  if (!form) return;
  var daftar = form.id === 'form-register';
  var meta = document.querySelector('meta[name="csrf-token"]');
  var token = meta ? meta.getAttribute('content') : '';
  var banner = document.getElementById('error-banner');
  var tombol = form.querySelector('button[type="submit"]');

  function ambil(id) { var el = document.getElementById(id); return el ? el.value.trim() : ''; }
  function galat(pesan) { banner.textContent = pesan; banner.classList.add('visible'); }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    banner.classList.remove('visible');
    var data = daftar
      ? { nama_lengkap: ambil('nama-lengkap'), email: ambil('email-telepon'),
          password: document.getElementById('password-baru').value,
          konfirmasi_password: document.getElementById('konfirmasi-password').value }
      : { email: ambil('email-atau-telepon'), password: document.getElementById('password').value };
    var teksAsli = tombol.textContent;
    tombol.disabled = true;
    tombol.textContent = 'Memuat...';

    fetch(daftar ? '/register' : '/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
      body: JSON.stringify(data)
    })
    .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, status: r.status, d: d }; }); })
    .then(function (h) {
      if (!h.ok || !h.d || h.d.errors || h.d.message || !h.d.email) {
        var pesan = h.d.message || 'Terjadi kesalahan. Coba lagi.';
        if (h.d.errors) { pesan = Object.values(h.d.errors)[0][0]; }
        if (h.status === 429) { pesan = 'Terlalu banyak percobaan. Tunggu sebentar lalu coba lagi.'; }
        galat(pesan);
        tombol.disabled = false; tombol.textContent = teksAsli;
        return;
      }
      localStorage.setItem('lingkunganku_logged_in', 'true');
      localStorage.setItem('lingkunganku_nama', h.d.nama);
      localStorage.setItem('lingkunganku_email', h.d.email);
      var tujuan = h.d.redirect || '/';
      var simpan = localStorage.getItem('lingkunganku_redirect');
      if (simpan && tujuan === '/') { localStorage.removeItem('lingkunganku_redirect'); tujuan = simpan; }
      window.location.href = tujuan;
    })
    .catch(function () { galat('Tidak dapat terhubung ke server.'); tombol.disabled = false; tombol.textContent = teksAsli; });
  });
})();
