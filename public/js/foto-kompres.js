document.addEventListener('DOMContentLoaded', function () {
  var input = document.getElementById('foto-laporan');
  if (!input || !window.DataTransfer) return;
  var MAKS_SISI = 1280, KUALITAS = 0.72, proses = false;

  function kecilkan(file) {
    return new Promise(function (ok) {
      if (file.type === 'image/webp' && file.size < 400 * 1024) return ok(file);
      var url = URL.createObjectURL(file), img = new Image();
      img.onload = function () {
        var r = Math.min(1, MAKS_SISI / Math.max(img.width, img.height));
        var c = document.createElement('canvas');
        c.width = Math.round(img.width * r); c.height = Math.round(img.height * r);
        c.getContext('2d').drawImage(img, 0, 0, c.width, c.height);
        c.toBlob(function (b) {
          URL.revokeObjectURL(url);
          if (!b || b.size >= file.size) return ok(file);
          ok(new File([b], file.name.replace(/\.\w+$/, '') + '.jpg', { type: 'image/jpeg' }));
        }, 'image/jpeg', KUALITAS);
      };
      img.onerror = function () { URL.revokeObjectURL(url); ok(file); };
      img.src = url;
    });
  }

  input.addEventListener('change', function () {
    if (proses) return;
    var files = Array.prototype.slice.call(input.files);
    if (!files.length) return;
    proses = true;
    Promise.all(files.map(kecilkan)).then(function (hasil) {
      var dt = new DataTransfer();
      hasil.forEach(function (f) { dt.items.add(f); });
      input.files = dt.files;
      proses = false;
    });
  });
});
