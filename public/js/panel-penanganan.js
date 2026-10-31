(function () {
  var tautan = document.getElementById('link-penanganan');
  var panel = document.getElementById('panel-proses');
  if (!tautan || !panel) return;
  var tombol = tautan.querySelector('button');

  function hitungGaris() {
    panel.querySelectorAll('ol[aria-label="Tahapan proses penanganan"]').forEach(function (ol) {
      var ind = ol.querySelectorAll('.timeline-indicator');
      if (ind.length < 2) return;
      var atas = ol.getBoundingClientRect().top;
      var a = ind[0].getBoundingClientRect();
      var b = ind[ind.length - 1].getBoundingClientRect();
      var mulai = a.top + a.height / 2 - atas;
      var akhir = b.top + b.height / 2 - atas;
      ol.style.setProperty('--timeline-top', mulai + 'px');
      ol.style.setProperty('--timeline-height', Math.max(0, akhir - mulai) + 'px');
    });
  }

  tautan.addEventListener('click', function (e) {
    e.preventDefault();
    var buka = panel.classList.toggle('terbuka');
    if (tombol) {
      tombol.textContent = buka ? 'Sembunyikan Detail Penanganan' : 'Lihat Detail Penanganan';
      tombol.setAttribute('aria-expanded', buka ? 'true' : 'false');
    }
    hitungGaris();
    setTimeout(hitungGaris, 450);
  });
  window.addEventListener('resize', hitungGaris);
})();
