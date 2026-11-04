(function () {
  if (window.__clarityKonsen) return;
  window.__clarityKonsen = true;

  var KUNCI = 'lingkunganku_cookie';
  var lokal = /^(localhost|127\.|192\.168\.)/.test(location.hostname);

  function muatClarity() {
    if (lokal) return;
    (function (c, l, a, r, i, t, y) {
      c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
      t = l.createElement(r); t.async = 1; t.src = 'https://www.clarity.ms/tag/' + i;
      y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
    })(window, document, 'clarity', 'script', 'z4r4xbuiu3');
  }

  var pilihan = null;
  try { pilihan = localStorage.getItem(KUNCI); } catch (e) {}
  if (pilihan === 'setuju') { muatClarity(); return; }
  if (pilihan === 'tolak') return;

  function tampilkanBanner() {
    var b = document.createElement('div');
    b.setAttribute('role', 'dialog');
    b.setAttribute('aria-label', 'Persetujuan cookie');
    b.style.cssText = 'position:fixed;left:12px;right:12px;bottom:12px;z-index:9999;max-width:520px;margin:0 auto;background:#0f172a;color:#fff;padding:14px 16px;border-radius:14px;font:13px/1.5 system-ui,sans-serif;box-shadow:0 8px 30px rgba(0,0,0,.3)';
    var tombol = 'padding:7px 16px!important;border-radius:999px!important;font:600 13px system-ui,sans-serif!important;cursor:pointer;width:auto!important;margin:0!important;color:#fff!important;';
    b.innerHTML = '<p style="margin:0 0 10px;color:#fff">Kami memakai cookie analitik (Microsoft Clarity) untuk memperbaiki tampilan situs. Boleh?</p>'
      + '<div style="display:flex;gap:8px;justify-content:flex-end">'
      + '<button type="button" data-p="tolak" style="' + tombol + 'background:transparent!important;border:1px solid #94a3b8!important">Tolak</button>'
      + '<button type="button" data-p="setuju" style="' + tombol + 'background:#2563eb!important;border:1px solid #2563eb!important">Setuju</button>'
      + '</div>';
    b.addEventListener('click', function (e) {
      var p = e.target.getAttribute('data-p');
      if (!p) return;
      try { localStorage.setItem(KUNCI, p); } catch (x) {}
      b.remove();
      if (p === 'setuju') muatClarity();
    });
    document.body.appendChild(b);
  }

  if (document.body) tampilkanBanner();
  else document.addEventListener('DOMContentLoaded', tampilkanBanner);
})();
