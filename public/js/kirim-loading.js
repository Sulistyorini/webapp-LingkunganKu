document.addEventListener('DOMContentLoaded', function () {
  var f = document.querySelector('form[action*="buat-laporan"]');
  if (!f) return;
  var o = document.createElement('div');
  o.style.cssText = 'display:none;position:fixed;inset:0;z-index:9999;background:rgba(15,23,42,.55);flex-direction:column;align-items:center;justify-content:center;gap:14px;color:#fff;font:600 16px system-ui,sans-serif';
  o.innerHTML = '<div style="width:44px;height:44px;border:4px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:kirim-putar .8s linear infinite"></div><span>Mengirim laporan...</span>';
  var s = document.createElement('style');
  s.textContent = '@keyframes kirim-putar{to{transform:rotate(360deg)}}';
  document.head.appendChild(s);
  document.body.appendChild(o);
  f.addEventListener('submit', function (e) {
    setTimeout(function () {
      if (e.defaultPrevented) return;
      o.style.display = 'flex';
      var b = f.querySelector('[type=submit]');
      if (b) b.disabled = true;
    }, 0);
  });
  window.addEventListener('pageshow', function () {
    o.style.display = 'none';
    var b = f.querySelector('[type=submit]');
    if (b) b.disabled = false;
  });
});
