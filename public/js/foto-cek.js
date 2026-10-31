document.addEventListener('DOMContentLoaded', function () {
  var input = document.getElementById('foto-laporan');
  if (!input) return;
  var BATAS = Infinity;
  var BOLEH = ['image/jpeg', 'image/png', 'image/webp'];

  var kotak = document.createElement('div');
  kotak.setAttribute('role', 'alert');
  kotak.style.cssText = 'display:none;position:fixed;left:50%;top:70px;transform:translateX(-50%);z-index:100000;max-width:92vw;width:420px;padding:14px 44px 14px 16px;border-radius:12px;background:#fef2f2;border:1px solid #fca5a5;color:#b91c1c;font:600 14px/1.5 system-ui,sans-serif;box-shadow:0 10px 30px rgba(0,0,0,.2)';
  var teks = document.createElement('span');
  var tutup = document.createElement('button');
  tutup.type = 'button';
  tutup.textContent = '\u00d7';
  tutup.setAttribute('aria-label', 'Tutup');
  tutup.style.cssText = 'position:absolute;top:8px;right:12px;border:0;background:transparent;color:#b91c1c;font-size:22px;line-height:1;cursor:pointer;padding:0';
  kotak.appendChild(teks);
  kotak.appendChild(tutup);
  document.body.appendChild(kotak);

  var timer;
  function tampil(pesan) {
    teks.textContent = pesan;
    kotak.style.display = 'block';
    clearTimeout(timer);
    timer = setTimeout(function () { kotak.style.display = 'none'; }, 7000);
    if (navigator.vibrate) navigator.vibrate(150);
  }
  tutup.addEventListener('click', function () { kotak.style.display = 'none'; });

  input.addEventListener('change', function () {
    var dt = new DataTransfer();
    var ditolak = [];
    Array.prototype.forEach.call(input.files, function (f) {
      if (BOLEH.indexOf(f.type) === -1) {
        ditolak.push(f.name + ' (format tidak didukung)');
      } else if (f.size > BATAS) {
        ditolak.push(f.name + ' (' + (f.size / 1048576).toFixed(1) + ' MB)');
      } else {
        dt.items.add(f);
      }
    });
    if (ditolak.length) {
      input.files = dt.files;
      tampil('Foto tidak bisa diunggah, maksimal 5 MB per foto (JPG, PNG, atau WebP): ' + ditolak.join(', ') + '. Silakan pilih foto yang lebih kecil.');
    }
  });
});
