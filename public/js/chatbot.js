/* Chatbot FAQ LingkunganKU (tanpa server, tanpa AI). Membutuhkan js/faq-data.js dimuat lebih dulu. */
(function () {
  if (typeof FAQ === 'undefined' || document.getElementById('cb-root')) return;

  function normal(teks) {
    return ' ' + teks.toLowerCase().replace(/[^a-z0-9\s]/g, ' ').replace(/\s+/g, ' ').trim() + ' ';
  }

  function cari(pertanyaan) {
    var q = normal(pertanyaan);
    var terbaik = null, skorTerbaik = 0;
    FAQ.forEach(function (f) {
      var skor = 0;
      f.kunci.forEach(function (k) {
        var kk = normal(k);
        if (q.indexOf(kk) !== -1) skor += kk.trim().split(' ').length;
      });
      skor *= (f.bobot || 1);
      if (skor > skorTerbaik) { skorTerbaik = skor; terbaik = f; }
    });
    return terbaik;
  }

  var root = document.createElement('div');
  root.id = 'cb-root';
  root.innerHTML =
    '<button type="button" class="cb-fab" id="cb-fab" aria-label="Buka asisten bantuan" aria-expanded="false" aria-controls="cb-panel">' +
        '<svg viewBox="0 -0.5 24 24" aria-hidden="true"><path d="M5.5 3h13A2.5 2.5 0 0 1 21 5.5v8a2.5 2.5 0 0 1-2.5 2.5H13l-4 4v-4H5.5A2.5 2.5 0 0 1 3 13.5v-8A2.5 2.5 0 0 1 5.5 3z"/></svg>' +
    '</button>' +
    '<section class="cb-panel" id="cb-panel" role="dialog" aria-label="Asisten bantuan LingkunganKU" hidden>' +
      '<header class="cb-head">' +
        '<div><strong>Asisten LingkunganKU</strong><span>Jawaban cepat seputar aplikasi</span></div>' +
        '<button type="button" class="cb-x" id="cb-x" aria-label="Tutup">' +
          '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>' +
        '</button>' +
      '</header>' +
      '<div class="cb-log" id="cb-log" role="log" aria-live="polite"></div>' +
      '<div class="cb-chips" id="cb-chips"></div>' +
      '<form class="cb-form" id="cb-form" autocomplete="off">' +
        '<label for="cb-input" class="cb-sr">Tulis pertanyaan</label>' +
        '<input id="cb-input" type="text" maxlength="200" placeholder="Tulis pertanyaan Anda...">' +
        '<button type="submit" aria-label="Kirim"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12l16-8-6 16-3-6.5z"/></svg></button>' +
      '</form>' +
    '</section>';
  document.body.appendChild(root);

  var fab = document.getElementById('cb-fab');
  var panel = document.getElementById('cb-panel');
  var log = document.getElementById('cb-log');
  var chips = document.getElementById('cb-chips');
  var form = document.getElementById('cb-form');
  var input = document.getElementById('cb-input');
  var sudahSapa = false;

  function gulir() { log.scrollTop = log.scrollHeight; }

  function tambah(peran, teks, link) {
    var el = document.createElement('div');
    el.className = 'cb-msg ' + peran;
    teks.split('\n').forEach(function (baris, i) {
      if (i > 0) el.appendChild(document.createElement('br'));
      el.appendChild(document.createTextNode(baris));
    });
    if (link) {
      var a = document.createElement('a');
      a.className = 'cb-link';
      a.href = link.href;
      a.textContent = link.teks;
      el.appendChild(a);
    }
    log.appendChild(el);
    gulir();
    return el;
  }

  function balas(f) {
    var ketik = document.createElement('div');
    ketik.className = 'cb-msg bot cb-ketik';
    ketik.innerHTML = '<i></i><i></i><i></i>';
    ketik.setAttribute('aria-label', 'Sedang menulis');
    log.appendChild(ketik);
    gulir();
    if (f) {
      setTimeout(function () {
        log.removeChild(ketik);
        tambah('bot', f.jawab, f.link);
        isiChip(f.id);
      }, 450);
      return;
    }
    tanyaAI(pertanyaanTerakhir).then(function (jawaban) {
      if (ketik.parentNode) log.removeChild(ketik);
      if (jawaban) tambah('bot', jawaban);
      else tambah('bot', FAQ_CADANGAN);
      isiChip(null);
    });
  }

  var pertanyaanTerakhir = '';

  function tanyaAI(teks) {
    var ctl = new AbortController();
    var batas = setTimeout(function () { ctl.abort(); }, 25000);
    return fetch('/api/chatbot', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({ pertanyaan: teks }),
      signal: ctl.signal
    })
    .then(function (r) { return r.text(); })
    .then(function (t) {
      var d = null;
      try { d = JSON.parse(t); } catch (e) {}
      return d && d.jawaban ? d.jawaban : null;
    })
    .catch(function () { return null; })
    .then(function (j) { clearTimeout(batas); return j; });
  }

  function isiChip(kecualiId) {
    chips.innerHTML = '';
    FAQ_CHIP.filter(function (id) { return id !== kecualiId; }).forEach(function (id) {
      var f = FAQ.filter(function (x) { return x.id === id; })[0];
      if (!f) return;
      var b = document.createElement('button');
      b.type = 'button';
      b.textContent = f.tanya;
      b.addEventListener('click', function () { kirim(f.tanya, f); });
      chips.appendChild(b);
    });
  }

  function kirim(teks, langsung) {
    teks = teks.trim();
    if (!teks) return;
    tambah('user', teks);
    pertanyaanTerakhir = teks;
    balas(langsung || cari(teks));
  }

  function buka() {
    panel.hidden = false;
    fab.setAttribute('aria-expanded', 'true');
    fab.classList.add('cb-sembunyi');
    if (!sudahSapa) { tambah('bot', FAQ_SAPAAN); isiChip(null); sudahSapa = true; }
    setTimeout(function () { input.focus(); }, 50);
  }
  function tutup() {
    panel.hidden = true;
    fab.setAttribute('aria-expanded', 'false');
    fab.classList.remove('cb-sembunyi');
    fab.focus();
  }

  fab.addEventListener('click', buka);
  document.getElementById('cb-x').addEventListener('click', tutup);
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !panel.hidden) tutup();
  });
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    kirim(input.value);
    input.value = '';
  });
  document.addEventListener('click', function (e) {
    var t = e.target.closest && e.target.closest('[data-buka-chatbot]');
    if (t) { e.preventDefault(); buka(); }
  });
})();