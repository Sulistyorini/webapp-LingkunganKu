(function () {
  var CLIENT_ID = '673630361649-r6lfu9qjfhm8h2qols73nrbqh9l7ont4.apps.googleusercontent.com';
  var box = document.getElementById('google-btn');
  if (!box) return;
  var banner = document.getElementById('error-banner');

  function galat(p) { if (banner) { banner.textContent = p; banner.classList.add('visible'); } }

  function onCred(resp) {
    if (banner) banner.classList.remove('visible');
    fetch('/login/google', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({ credential: resp.credential })
    })
    .then(function (r) { return r.text(); })
    .then(function (t) {
      var d = null;
      try { d = JSON.parse(t); } catch (e) {}
      if (!d || !d.email) { galat((d && d.message) || 'Login Google gagal. Coba lagi.'); return; }
      localStorage.setItem('lingkunganku_logged_in', 'true');
      localStorage.setItem('lingkunganku_nama', d.nama);
      localStorage.setItem('lingkunganku_email', d.email);
      if (d.foto) { localStorage.setItem('lingkunganku_foto', d.foto); } else { localStorage.removeItem('lingkunganku_foto'); }
      var tujuan = d.redirect || '/';
      var simpan = localStorage.getItem('lingkunganku_redirect');
      if (simpan) { localStorage.removeItem('lingkunganku_redirect'); tujuan = simpan; }
      if (window.top !== window.self) { window.top.location.href = tujuan; } else { window.location.href = tujuan; }
    })
    .catch(function () { galat('Tidak dapat terhubung ke server.'); });
  }

  function init() {
    if (!window.google || !google.accounts) { return setTimeout(init, 300); }
    google.accounts.id.initialize({ client_id: CLIENT_ID, callback: onCred });
    google.accounts.id.renderButton(box, {
      theme: 'outline', size: 'large', shape: 'pill', text: box.getAttribute('data-text') || 'continue_with',
      width: Math.min(400, box.clientWidth || 300), locale: 'id'
    });
  }
  init();
})();
