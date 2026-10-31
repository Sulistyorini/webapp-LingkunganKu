(function () {
  var form = document.getElementById('form-laporan');
  if (!form) return;

  function fokusKe(el) {
    if (!el) return;
    setTimeout(function () {
      el.focus({ preventScroll: true });
      el.scrollIntoView({ block: 'center', behavior: 'smooth' });
    }, 150);
  }

  form.addEventListener('change', function (e) {
    var t = e.target;
    // Pilih kategori -> langsung ke deskripsi
    if (t.matches('input[type="radio"]')) {
      fokusKe(form.querySelector('section:not([hidden]) textarea'));
      return;
    }
    // Pilih dropdown (kecamatan -> desa) -> ke isian berikutnya
    if (t.matches('select')) {
      var daftar = Array.prototype.slice.call(
        form.querySelectorAll('section:not([hidden]) select, section:not([hidden]) input:not([type="hidden"]):not([type="radio"]):not([type="file"]), section:not([hidden]) textarea')
      );
      var i = daftar.indexOf(t);
      setTimeout(function () {
        for (var j = i + 1; j < daftar.length; j++) {
          if (!daftar[j].disabled) { fokusKe(daftar[j]); break; }
        }
      }, 400);
    }
  });
})();

(function () {
  function sejajarkanTrack() {
    var form = document.getElementById('form-laporan');
    var track = document.querySelector('body > header:not(.site-header)');
    if (!form || !track) return;
    if (window.innerWidth < 900 || window.innerHeight < 600) {
      track.style.top = track.style.left = track.style.height = '';
      return;
    }
    var r = form.getBoundingClientRect();
    track.style.top = r.top + 'px';
    track.style.height = r.height + 'px';
    track.style.left = (r.right + 40) + 'px';
  }
  window.addEventListener('load', sejajarkanTrack);
  window.addEventListener('resize', sejajarkanTrack);
  setTimeout(sejajarkanTrack, 300);
})();

(function () {
  function mepetBawah() {
    var form = document.getElementById('form-laporan');
    if (!form) return;
    if (window.innerWidth < 900 || window.innerHeight < 600) {
      form.style.height = '';
      return;
    }
    form.style.height = '';
    var atas = form.getBoundingClientRect().top;
    var tinggi = window.innerHeight - atas - 12;
    form.style.setProperty('height', tinggi + 'px', 'important');
    // sejajarkan track dengan form
    var track = document.querySelector('body > header:not(.site-header)');
    if (track) {
      var r = form.getBoundingClientRect();
      track.style.top = r.top + 'px';
      track.style.height = r.height + 'px';
      track.style.left = (r.right + 40) + 'px';
    }
  }
  window.addEventListener('load', mepetBawah);
  window.addEventListener('resize', mepetBawah);
  setTimeout(mepetBawah, 300);
  setTimeout(mepetBawah, 800);
})();

(function () {
  function rapikanTrack() {
    var form = document.getElementById('form-laporan');
    var track = document.querySelector('body > header:not(.site-header)');
    if (!form || !track) return;
    if (window.innerWidth < 900 || window.innerHeight < 600) {
      ['top','left','height','width'].forEach(function (p) { track.style.removeProperty(p); });
      return;
    }
    var r = form.getBoundingClientRect();
    track.style.setProperty('position', 'fixed', 'important');
    track.style.setProperty('top', r.top + 'px', 'important');
    track.style.setProperty('height', r.height + 'px', 'important');
    track.style.setProperty('left', (r.right + 16) + 'px', 'important');
    track.style.setProperty('width', '170px', 'important');
  }
  window.addEventListener('load', rapikanTrack);
  window.addEventListener('resize', rapikanTrack);
  [100, 400, 900, 1500].forEach(function (t) { setTimeout(rapikanTrack, t); });
})();

(function () {
  function gambarGaris() {
    var track = document.querySelector('body > header:not(.site-header)');
    if (!track) return;
    var ol = track.querySelector('ol');
    if (!ol) return;
    var lama = ol.querySelectorAll('.garis-seg');
    lama.forEach(function (g) { g.remove(); });
    if (window.innerWidth < 900 || window.innerHeight < 600) return;

    var bulatan = ol.querySelectorAll('li strong');
    if (bulatan.length < 2) return;
    var induk = ol.getBoundingClientRect();
    var jarak = 8;

    for (var i = 0; i < bulatan.length - 1; i++) {
      var a = bulatan[i].getBoundingClientRect();
      var b = bulatan[i + 1].getBoundingClientRect();
      var atas = a.bottom - induk.top + jarak;
      var tinggi = (b.top - jarak) - (a.bottom + jarak);
      if (tinggi <= 0) continue;
      var g = document.createElement('span');
      g.className = 'garis-seg';
      g.style.cssText = 'position:absolute;left:' + (a.left - induk.left + a.width / 2 - 1) +
        'px;top:' + atas + 'px;width:2px;height:' + tinggi +
        'px;background:#cbd5e1;z-index:0;pointer-events:none;';
      ol.appendChild(g);
    }
  }
  window.addEventListener('load', gambarGaris);
  window.addEventListener('resize', gambarGaris);
  [200, 600, 1000, 1800].forEach(function (t) { setTimeout(gambarGaris, t); });
})();

(function () {
  function dekatkanTrack() {
    var form = document.getElementById('form-laporan');
    var track = document.querySelector('body > header:not(.site-header)');
    if (!form || !track) return;
    if (window.innerWidth < 900 || window.innerHeight < 600) return;
    var r = form.getBoundingClientRect();
    track.style.setProperty('left', (r.right + 12) + 'px', 'important');
  }
  window.addEventListener('load', dekatkanTrack);
  window.addEventListener('resize', dekatkanTrack);
  [150, 500, 1000, 1700, 2000].forEach(function (t) { setTimeout(dekatkanTrack, t); });
})();

(function () {
  var form = document.getElementById('form-laporan');
  var header = document.querySelector('body > header:not(.site-header)');
  if (!form || !header || document.getElementById('kartu-laporan')) return;
  var nav = header.querySelector('nav');
  if (!nav) return;

  var wrap = document.createElement('div');
  wrap.id = 'kartu-laporan';
  form.parentNode.insertBefore(wrap, form);
  wrap.appendChild(form);

  var aside = document.createElement('aside');
  aside.id = 'track-laporan';
  aside.appendChild(nav);
  wrap.appendChild(aside);
  header.remove();

  function tinggi() {
    if (window.innerWidth < 900 || window.innerHeight < 600) {
      wrap.style.removeProperty('height');
      form.style.removeProperty('height');
      return;
    }
    wrap.style.removeProperty('height');
    var h = window.innerHeight - wrap.getBoundingClientRect().top - 12;
    wrap.style.setProperty('height', h + 'px', 'important');
    form.style.setProperty('height', h + 'px', 'important');
  }
  window.addEventListener('load', tinggi);
  window.addEventListener('resize', tinggi);
  [100, 400, 900, 1500, 2100].forEach(function (t) { setTimeout(tinggi, t); });
})();

(function () {
  function garisPanel() {
    var ol = document.querySelector('#track-laporan ol');
    if (!ol) return;
    ol.querySelectorAll('.garis-seg').forEach(function (g) { g.remove(); });
    if (window.innerWidth < 900) return;
    var b = ol.querySelectorAll('li strong');
    var induk = ol.getBoundingClientRect();
    for (var i = 0; i < b.length - 1; i++) {
      var a = b[i].getBoundingClientRect(), c = b[i + 1].getBoundingClientRect();
      var atas = a.bottom - induk.top + 8;
      var tinggi = (c.top - 8) - (a.bottom + 8);
      if (tinggi <= 0) continue;
      var g = document.createElement('span');
      g.className = 'garis-seg';
      g.style.cssText = 'position:absolute;left:' + (a.left - induk.left + a.width / 2 - 1) +
        'px;top:' + atas + 'px;width:2px;height:' + tinggi + 'px;background:#cbd5e1;';
      ol.appendChild(g);
    }
  }
  window.addEventListener('load', garisPanel);
  window.addEventListener('resize', garisPanel);
  [200, 600, 1100, 1800, 2300].forEach(function (t) { setTimeout(garisPanel, t); });
})();

(function () {
  function tandaiProgres() {
    var ol = document.querySelector('#track-laporan ol');
    if (!ol) return;
    var items = Array.prototype.slice.call(ol.querySelectorAll('li'));
    var aktif = items.findIndex(function (li) { return li.getAttribute('aria-current') === 'step'; });
    if (aktif < 0) return;
    items.forEach(function (li, i) { li.classList.toggle('selesai', i < aktif); });
    ol.querySelectorAll('.garis-seg').forEach(function (g, i) {
      g.style.background = i < aktif ? '#2563EB' : '#cbd5e1';
    });
  }

  var ol = document.querySelector('#track-laporan ol');
  function pasang() {
    ol = document.querySelector('#track-laporan ol');
    if (!ol) return;
    new MutationObserver(function () { setTimeout(tandaiProgres, 0); })
      .observe(ol, { attributes: true, subtree: true, attributeFilter: ['aria-current'] });
    new MutationObserver(tandaiProgres)
      .observe(ol, { childList: true });
    tandaiProgres();
  }
  window.addEventListener('load', function () { setTimeout(pasang, 300); });
  [400, 900, 1500, 2400].forEach(function (t) { setTimeout(tandaiProgres, t); });
})();

(function () {
  var MAKS = 5;
  var form = document.getElementById('form-laporan');
  if (!form) return;
  var langkah1 = form.querySelector(':scope > section');
  var input = langkah1 && langkah1.querySelector('input[type="file"]');
  if (!input) return;
  input.multiple = true;

  var pesan = document.createElement('p');
  pesan.setAttribute('role', 'alert');
  pesan.style.cssText = 'color:#dc2626;font-size:.85rem;margin:6px 0 0;display:none;';
  input.parentNode.appendChild(pesan);
  function tampil(t) { pesan.textContent = t; pesan.style.display = t ? 'block' : 'none'; }

  input.addEventListener('change', function () {
    if (input.files.length > MAKS) {
      var dt = new DataTransfer();
      Array.prototype.slice.call(input.files, 0, MAKS).forEach(function (f) { dt.items.add(f); });
      input.files = dt.files;
      tampil('Maksimal ' + MAKS + ' foto. Hanya ' + MAKS + ' foto pertama yang dipakai.');
    } else {
      tampil('');
    }
  });

  document.addEventListener('click', function (e) {
    var tombol = e.target.closest && e.target.closest('[data-step-next]');
    if (!tombol || !langkah1.contains(tombol)) return;
    if (!input.files || input.files.length === 0) {
      e.preventDefault();
      e.stopImmediatePropagation();
      tampil('Foto wajib diunggah (minimal 1, maksimal ' + MAKS + ').');
      input.scrollIntoView({ block: 'center', behavior: 'smooth' });
    }
  }, true);
})();

(function () {
  function garisMobile() {
    var ol = document.querySelector('#track-laporan ol');
    if (!ol) return;
    ol.querySelectorAll('.garis-h').forEach(function (g) { g.remove(); });
    if (window.innerWidth >= 900) return;

    var b = ol.querySelectorAll('li strong');
    var items = ol.querySelectorAll('li');
    var aktif = -1;
    items.forEach(function (li, i) { if (li.getAttribute('aria-current') === 'step') aktif = i; });
    var induk = ol.getBoundingClientRect();

    for (var i = 0; i < b.length - 1; i++) {
      var a = b[i].getBoundingClientRect(), c = b[i + 1].getBoundingClientRect();
      var kiri = a.right - induk.left + 6;
      var lebar = (c.left - 6) - (a.right + 6);
      if (lebar <= 0) continue;
      var g = document.createElement('span');
      g.className = 'garis-h';
      g.style.cssText = 'position:absolute;left:' + kiri + 'px;top:' + (a.top - induk.top + a.height / 2 - 1) +
        'px;width:' + lebar + 'px;height:2px;border-radius:2px;background:' + (i < aktif ? '#2563EB' : '#cbd5e1') + ';';
      ol.appendChild(g);
    }
  }
  window.addEventListener('load', garisMobile);
  window.addEventListener('resize', garisMobile);
  [300, 700, 1200, 2000].forEach(function (t) { setTimeout(garisMobile, t); });

  var ol = document.querySelector('#track-laporan ol');
  if (ol) {
    new MutationObserver(function () { setTimeout(garisMobile, 0); })
      .observe(ol, { attributes: true, subtree: true, attributeFilter: ['aria-current'] });
  }
})();

(function () {
  var form = document.getElementById('form-laporan');
  if (!form) return;
  var langkah1 = form.querySelector(':scope > section');
  if (!langkah1) return;
  var radios = Array.prototype.slice.call(langkah1.querySelectorAll('input[type="radio"]'));
  if (radios.length === 0 || document.getElementById('kategori-dd')) return;

  // sembunyikan radio asli (tetap ada di DOM agar form & script lama jalan)
  var pembungkus = radios.map(function (r) { return r.closest('label') || r.parentElement; });
  pembungkus.forEach(function (el) { el.classList.add('kategori-asli'); });

  var dd = document.createElement('div');
  dd.id = 'kategori-dd';
  dd.innerHTML =
    '<button type="button" class="kategori-pemicu" aria-haspopup="listbox" aria-expanded="false">' +
      '<span class="kategori-teks">Pilih kategori aduan</span>' +
      '<svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true"><path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
    '</button>' +
    '<ul class="kategori-daftar" role="listbox" hidden></ul>';
  pembungkus[0].parentNode.insertBefore(dd, pembungkus[0]);

  var pemicu = dd.querySelector('.kategori-pemicu');
  var teks = dd.querySelector('.kategori-teks');
  var daftar = dd.querySelector('.kategori-daftar');

  function tutup() { daftar.hidden = true; pemicu.setAttribute('aria-expanded', 'false'); dd.classList.remove('buka'); }
  function buka() { daftar.hidden = false; pemicu.setAttribute('aria-expanded', 'true'); dd.classList.add('buka'); }

  radios.forEach(function (r, i) {
    var label = pembungkus[i].textContent.replace(/\s+/g, ' ').trim();
    var li = document.createElement('li');
    li.setAttribute('role', 'option');
    li.tabIndex = 0;
    li.textContent = label;
    function pilih() {
      r.checked = true;
      r.dispatchEvent(new Event('change', { bubbles: true }));
      teks.textContent = label;
      dd.classList.add('terisi');
      daftar.querySelectorAll('li').forEach(function (x) { x.setAttribute('aria-selected', 'false'); });
      li.setAttribute('aria-selected', 'true');
      tutup();
    }
    li.addEventListener('click', pilih);
    li.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); pilih(); }
    });
    daftar.appendChild(li);
    if (r.checked) { teks.textContent = label; dd.classList.add('terisi'); li.setAttribute('aria-selected', 'true'); }
  });

  pemicu.addEventListener('click', function () { daftar.hidden ? buka() : tutup(); });
  document.addEventListener('click', function (e) { if (!dd.contains(e.target)) tutup(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') tutup(); });
})();
