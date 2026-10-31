document.addEventListener('DOMContentLoaded', function () {
  var f = document.getElementById('form-laporan');
  if (!f) return;

  var css = document.createElement('style');
  css.textContent =
    '#kirim-ov{position:fixed;inset:0;z-index:100001;display:none;align-items:center;justify-content:center;padding:16px;background:rgba(8,30,70,.55);-webkit-backdrop-filter:blur(5px);backdrop-filter:blur(5px)}' +
    '#kirim-ov.buka{display:flex}' +
    '#kirim-card{width:100%;max-width:360px;padding:28px 24px 24px;text-align:center;color:#fff;background:rgba(37,99,235,.38);-webkit-backdrop-filter:blur(16px);backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.35);border-radius:22px;box-shadow:0 24px 60px rgba(0,0,0,.45);font-family:system-ui,sans-serif}' +
    '#kirim-card h2{margin:14px 0 6px;font-size:1.25rem;font-weight:800;color:#fff}' +
    '#kirim-card p{margin:0 0 18px;font-size:.88rem;line-height:1.5;color:rgba(255,255,255,.88)}' +
    '#kirim-card ul{margin:0 0 18px;padding:0 0 0 18px;text-align:left;font-size:.85rem;line-height:1.5}' +
    '.kirim-spin{width:46px;height:46px;margin:0 auto;border:4px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:kirim-putar .8s linear infinite}' +
    '.kirim-ikon{width:56px;height:56px;margin:0 auto;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:30px;font-weight:700;color:#fff}' +
    '.kirim-ikon.ok{background:#16a34a}.kirim-ikon.gagal{background:#dc2626}' +
    '.kirim-btn{display:block;width:100%;box-sizing:border-box;padding:11px 16px;margin-top:10px;border-radius:999px;font:700 .9rem system-ui,sans-serif;cursor:pointer;text-decoration:none;border:1.5px solid rgba(255,255,255,.7);background:transparent;color:#fff}' +
    '.kirim-btn.utama{background:#fff;color:#0f172a;border-color:#fff}' +
    '.kirim-btn:hover{opacity:.9}' +
    '@keyframes kirim-putar{to{transform:rotate(360deg)}}';
  document.head.appendChild(css);

  var ov = document.createElement('div');
  ov.id = 'kirim-ov';
  ov.setAttribute('role', 'dialog');
  ov.setAttribute('aria-modal', 'true');
  var card = document.createElement('div');
  card.id = 'kirim-card';
  ov.appendChild(card);
  document.body.appendChild(ov);

  function el(tag, cls, txt) {
    var e = document.createElement(tag);
    if (cls) e.className = cls;
    if (txt) e.textContent = txt;
    return e;
  }
  function tombol(txt, cls, aksi) {
    var b = el('button', 'kirim-btn ' + cls, txt);
    b.type = 'button';
    b.addEventListener('click', aksi);
    return b;
  }
  function buka() { ov.classList.add('buka'); document.documentElement.style.overflow = 'hidden'; }
  function tutup() { ov.classList.remove('buka'); document.documentElement.style.overflow = ''; }

  function tampilLoading() {
    card.textContent = '';
    card.appendChild(el('div', 'kirim-spin'));
    card.appendChild(el('h2', '', 'Mengirim laporan...'));
    card.appendChild(el('p', '', 'Mohon tunggu dan jangan tutup halaman ini.'));
    buka();
  }
  function tampilBerhasil() {
    card.textContent = '';
    card.appendChild(el('div', 'kirim-ikon ok', '\u2713'));
    card.appendChild(el('h2', '', 'Laporan terkirim'));
    card.appendChild(el('p', '', 'Terima kasih, laporanmu sudah masuk dan akan segera ditinjau.'));
    card.appendChild(tombol('Lihat Notifikasi', 'utama', function () { location.href = '/notifikasi'; }));
    card.appendChild(tombol('Tutup', '', function () { location.href = '/buat-laporan'; }));
    buka();
  }
  function tampilGagal(daftar) {
    card.textContent = '';
    card.appendChild(el('div', 'kirim-ikon gagal', '\u00d7'));
    card.appendChild(el('h2', '', 'Laporan belum terkirim'));
    var ul = el('ul');
    daftar.forEach(function (t) { ul.appendChild(el('li', '', t)); });
    card.appendChild(ul);
    card.appendChild(tombol('Kembali ke formulir', 'utama', tutup));
    buka();
  }

  var sedang = false;
  f.addEventListener('submit', function (e) {
    if (e.defaultPrevented) return;
    e.preventDefault();
    if (sedang) return;
    sedang = true;
    tampilLoading();

    var ctl = new AbortController();
    var batas = setTimeout(function () { ctl.abort(); }, 90000);

    fetch(f.action, {
      method: 'POST',
      body: new FormData(f),
      headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
      signal: ctl.signal
    })
    .then(function (r) { return r.text().then(function (t) { return { s: r.status, t: t }; }); })
    .then(function (h) {
      var t = h.t, d = null;
      try { d = JSON.parse(t); } catch (err) {}
      if (d && d.ok === true) return tampilBerhasil();
      var pesan = [];
      if (d && d.errors) {
        Object.keys(d.errors).forEach(function (k) {
          d.errors[k].forEach(function (m) { pesan.push(m); });
        });
      }
      if (!pesan.length && d && d.message) pesan.push(d.message);
      if (!pesan.length) pesan.push('Balasan server tidak dikenali (status ' + h.s + '): ' + t.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim().slice(0, 160));
      tampilGagal(pesan);
    })
    .catch(function (err) {
      tampilGagal([err && err.name === 'AbortError'
        ? 'Pengiriman terlalu lama. Periksa koneksi lalu coba lagi.'
        : 'Gagal terhubung ke server. Periksa koneksi lalu coba lagi.']);
    })
    .then(function () { clearTimeout(batas); sedang = false; });
  });
});
