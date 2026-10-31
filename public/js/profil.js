var FOTO_DEFAULT = './assets/images/avatar-default.png';
var CSRF = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';
var KUNCI = ['lingkunganku_logged_in', 'lingkunganku_nama', 'lingkunganku_email', 'lingkunganku_foto'];

// Jika belum login, arahkan ke login
if (!localStorage.getItem('lingkunganku_nama')) {
  window.location.href = '/login';
}

var elNamaDepan = document.getElementById('nama-depan');
var elNamaBelakang = document.getElementById('nama-belakang');
var elEmail = document.getElementById('email');
var elStatus = document.getElementById('status');
var fotoTersimpan = localStorage.getItem('lingkunganku_foto');

function bersihkanLokal() {
  KUNCI.forEach(function (k) { try { localStorage.removeItem(k); } catch (e) {} });
}
function sesiHabis() {
  bersihkanLokal();
  window.location.href = '/login';
}

function tampilkanFoto(src) {
  var url = src || FOTO_DEFAULT;
  document.getElementById('foto-preview').src = url;
  document.getElementById('foto-sidebar').src = url;
}

function tampilkanPesan(teks, sukses) {
  elStatus.style.color = sukses ? '#1a8a4a' : '#c0392b';
  elStatus.textContent = teks;
}

function kirim(url, data) {
  return fetch(url, {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': CSRF,
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify(data || {})
  }).then(function (r) {
    if (r.status === 401) { sesiHabis(); throw new Error('Sesi berakhir.'); }
    if (r.status === 419) { throw new Error('Halaman kedaluwarsa. Muat ulang halaman ini.'); }
    return r.json().catch(function () { return {}; }).then(function (j) {
      if (!r.ok) {
        var m = j.message || (j.errors && j.errors[Object.keys(j.errors)[0]][0]) || 'Gagal menyimpan.';
        throw new Error(m);
      }
      return j;
    });
  });
}

function isiForm() {
  var n = localStorage.getItem('lingkunganku_nama') || '';
  var e = localStorage.getItem('lingkunganku_email') || '';
  var bagian = n.trim().split(' ');
  elNamaDepan.value = bagian.shift() || '';
  elNamaBelakang.value = bagian.join(' ');
  elEmail.value = e;
  elEmail.readOnly = true;
  fotoTersimpan = localStorage.getItem('lingkunganku_foto');
  tampilkanFoto(fotoTersimpan);
  document.getElementById('profil-nama').textContent = n || '-';
  document.getElementById('profil-kontak').textContent = e || '-';
}
isiForm();

// Muat data terbaru dari server (nama, email, foto)
fetch('/profil/data', { credentials: 'same-origin', headers: { 'Accept': 'application/json' } })
  .then(function (r) {
    if (r.status === 401) { sesiHabis(); return null; }
    return r.ok ? r.json() : null;
  })
  .then(function (p) {
    if (!p) return;
    try {
      localStorage.setItem('lingkunganku_nama', p.nama || '');
      localStorage.setItem('lingkunganku_email', p.email || '');
      if (p.foto) { localStorage.setItem('lingkunganku_foto', p.foto); }
      else { localStorage.removeItem('lingkunganku_foto'); }
    } catch (e) {}
    isiForm();
    window.dispatchEvent(new Event('lingkunganku:profil-update'));
  })
  .catch(function () {});

// Kecilkan foto (maks 512 px, JPEG) supaya ringan disimpan
function perkecil(file, cb) {
  var reader = new FileReader();
  reader.onload = function () {
    var img = new Image();
    img.onload = function () {
      var skala = Math.min(1, 512 / Math.max(img.width, img.height));
      var c = document.createElement('canvas');
      c.width = Math.max(1, Math.round(img.width * skala));
      c.height = Math.max(1, Math.round(img.height * skala));
      var ctx = c.getContext('2d');
      ctx.fillStyle = '#fff';
      ctx.fillRect(0, 0, c.width, c.height);
      ctx.drawImage(img, 0, 0, c.width, c.height);
      cb(c.toDataURL('image/jpeg', 0.85));
    };
    img.onerror = function () { cb(null); };
    img.src = reader.result;
  };
  reader.onerror = function () { cb(null); };
  reader.readAsDataURL(file);
}

// Simpan foto otomatis (dataUrl null = hapus foto)
function simpanFoto(dataUrl) {
  tampilkanPesan('Menyimpan foto...', true);
  kirim('/profil/foto', { foto: dataUrl })
    .then(function () {
      fotoTersimpan = dataUrl;
      try {
        if (dataUrl) { localStorage.setItem('lingkunganku_foto', dataUrl); }
        else { localStorage.removeItem('lingkunganku_foto'); }
      } catch (e) {}
      tampilkanFoto(dataUrl);
      tampilkanPesan(dataUrl ? 'Foto tersimpan.' : 'Foto dihapus.', true);
      window.dispatchEvent(new Event('lingkunganku:profil-update'));
    })
    .catch(function (err) {
      tampilkanFoto(fotoTersimpan);
      tampilkanPesan(err.message || 'Foto gagal disimpan.', false);
    });
}

// Unggah foto: langsung tersimpan setelah dipilih
document.getElementById('btn-unggah').addEventListener('click', function () {
  document.getElementById('input-foto').click();
});
document.getElementById('input-foto').addEventListener('change', function (e) {
  var input = e.target;
  var file = input.files[0];
  if (!file) return;
  if (file.size > 2 * 1024 * 1024) {
    tampilkanPesan('Ukuran foto melebihi 2 MB.', false);
    input.value = '';
    return;
  }
  perkecil(file, function (hasil) {
    input.value = '';
    if (!hasil) { tampilkanPesan('Foto tidak bisa dibaca. Coba foto lain.', false); return; }
    tampilkanFoto(hasil);
    simpanFoto(hasil);
  });
});

// Hapus foto: langsung tersimpan
document.getElementById('btn-hapus-foto').addEventListener('click', function () {
  simpanFoto(null);
});

// Ubah email
document.getElementById('btn-ubah-email').addEventListener('click', function () {
  alert('Perubahan email belum tersedia di halaman ini.');
});

// Ubah kata sandi (placeholder)
document.getElementById('btn-ubah-sandi').addEventListener('click', function () {
  alert('Fitur ubah kata sandi belum tersedia.');
});

// Batal: kembalikan ke data tersimpan
document.getElementById('btn-batal').addEventListener('click', function () {
  isiForm();
  elStatus.textContent = '';
});

// Simpan (nama saja, foto sudah tersimpan otomatis)
document.getElementById('form-akun').addEventListener('submit', function (e) {
  e.preventDefault();
  var depan = elNamaDepan.value.trim();
  var belakang = elNamaBelakang.value.trim();

  if (!depan) {
    tampilkanPesan('Nama depan wajib diisi.', false);
    elNamaDepan.focus();
    return;
  }

  var namaLengkap = (depan + ' ' + belakang).trim();
  tampilkanPesan('Menyimpan...', true);
  kirim('/profil/data', { nama: namaLengkap })
    .then(function (j) {
      try { localStorage.setItem('lingkunganku_nama', j.nama || namaLengkap); } catch (err) {}
      isiForm();
      tampilkanPesan('Perubahan tersimpan.', true);
      window.dispatchEvent(new Event('lingkunganku:profil-update'));
    })
    .catch(function (err) {
      tampilkanPesan(err.message || 'Gagal menyimpan.', false);
    });
});

// Keluar: akhiri sesi di server, lalu bersihkan data di browser
document.getElementById('link-keluar').addEventListener('click', function (e) {
  e.preventDefault();
  fetch('/logout-warga', {
    method: 'POST',
    credentials: 'same-origin',
    headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }
  }).catch(function () {}).then(function () {
    bersihkanLokal();
    window.location.href = '/';
  });
});


// Menu sidebar: tampilkan panel sesuai pilihan
(function () {
  var items  = document.querySelectorAll('.menu-item');
  var panels = document.querySelectorAll('.panel');
  var body   = document.body;
  var backBtn   = document.getElementById('profil-back-btn');
  var backLabel = document.getElementById('profil-back-label');

  var isMobile = function () { return window.innerWidth <= 767; };

  function tampil(id) {
    if (!document.getElementById('panel-' + id)) id = 'akun';

    // Tampilkan/sembunyikan panel
    panels.forEach(function (p) { p.hidden = (p.id !== 'panel-' + id); });

    // Update aktif di menu
    var namaPanel = 'Profil';
    items.forEach(function (i) {
      var aktif = i.getAttribute('data-panel') === id;
      i.classList.toggle('aktif', aktif);
      if (aktif) {
        i.setAttribute('aria-current', 'true');
        namaPanel = i.querySelector('b') ? i.querySelector('b').textContent : 'Profil';
      } else {
        i.removeAttribute('aria-current');
      }
    });

    // Mobile: switch tampilan sidebar ↔ panel
    if (isMobile()) {
      body.classList.remove('profil-show-menu');
      body.classList.add('profil-show-panel');
      if (backLabel) backLabel.textContent = namaPanel;
    }
  }

  function kembaliKeMenu() {
    body.classList.remove('profil-show-panel');
    body.classList.add('profil-show-menu');
    history.replaceState(null, '', location.pathname);
  }

  // Klik menu item
  items.forEach(function (i) {
    i.addEventListener('click', function (e) {
      e.preventDefault();
      var id = i.getAttribute('data-panel');
      history.replaceState(null, '', '#' + id);
      tampil(id);
    });
  });

  // Tombol back
  if (backBtn) {
    backBtn.addEventListener('click', function () {
      kembaliKeMenu();
    });
  }

  // Saat resize ke desktop, reset class
  window.addEventListener('resize', function () {
    if (!isMobile()) {
      body.classList.remove('profil-show-menu', 'profil-show-panel');
    }
  });

  // Hash awal
  var hashAwal = location.hash.slice(1);
  if (hashAwal && document.getElementById('panel-' + hashAwal)) {
    tampil(hashAwal);
  } else {
    // Mobile: mulai di tampilan menu
    if (isMobile()) {
      body.classList.add('profil-show-menu');
      panels.forEach(function (p) { p.hidden = true; });
    } else {
      tampil('akun');
    }
  }

  window.addEventListener('hashchange', function () {
    var id = location.hash.slice(1);
    if (id) tampil(id);
    else if (isMobile()) kembaliKeMenu();
  });

  // Panah di kartu profil membuka Akun
  var panah = document.querySelector('#info-profil > a');
  if (panah) {
    panah.addEventListener('click', function (e) {
      e.preventDefault();
      history.replaceState(null, '', '#akun');
      tampil('akun');
    });
  }
})();

// Bantuan: cari pertanyaan
(function () {
  var cari = document.getElementById('cari-bantuan');
  if (!cari) return;
  cari.addEventListener('input', function () {
    var kata = cari.value.trim().toLowerCase();
    var ada = 0;
    document.querySelectorAll('#faq .faq details').forEach(function (d) {
      var cocok = !kata || d.textContent.toLowerCase().indexOf(kata) !== -1;
      d.hidden = !cocok;
      if (cocok) ada++;
    });
    document.querySelectorAll('#faq .faq-grup').forEach(function (g) {
      g.hidden = !g.querySelector('details:not([hidden])');
    });
    document.getElementById('faq-kosong').hidden = ada > 0;
  });
})();

// Privasi dan Keamanan
document.getElementById('btn-sandi-privasi').addEventListener('click', function () {
  alert('Fitur ubah kata sandi belum tersedia.');
});
document.getElementById('btn-hapus-tampilan').addEventListener('click', function () {
  if (!confirm('Hapus penanda notifikasi dibaca dan posisi tombol asisten di perangkat ini?')) return;
  try {
    localStorage.removeItem('lingkunganku_notif_dibaca');
    localStorage.removeItem('lingkunganku_chatbot_pos');
  } catch (e) {}
  alert('Data tampilan dihapus.');
});
