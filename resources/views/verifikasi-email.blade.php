<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Email - LingkunganKU</title>
  <link rel="stylesheet" href="/css/style.css">
  <script src="/js/clarity.js"></script>
</head>
<body style="background:#eff4ff;">
  <main style="max-width:480px;margin:10vh auto;padding:36px 32px;background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(15,23,42,.10);text-align:center;">
    <h1 style="font-size:1.4rem;margin:0 0 12px;">Cek email Anda</h1>
    <p>Kami mengirim tautan verifikasi ke <strong>{{ auth()->user()->email }}</strong>. Klik tautan itu untuk mengaktifkan akun sebelum membuat laporan.</p>
    @if (session('terkirim'))
      <p style="color:#15803d;">Tautan baru sudah dikirim.</p>
    @endif
    <form method="POST" action="{{ route('verification.send') }}" style="margin-top:16px;">
      @csrf
      <button type="submit">Kirim ulang tautan</button>
    </form>
    <form method="POST" action="{{ route('logout.warga') }}" style="margin-top:10px;">
      @csrf
      <button type="submit">Keluar</button>
    </form>
  </main>
</body>
</html>
