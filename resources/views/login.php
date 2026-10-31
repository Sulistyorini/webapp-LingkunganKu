<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="<?= csrf_token() ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Masuk</title>
  <meta name="description" content="Halaman masuk akun LingkunganKU.">
  <link rel="stylesheet" href="/css/style.css">
  <style>
    .auth-page {
      min-height: 100vh;
      background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      font-family: var(--font-base);
    }

    .auth-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.18);
      width: 100%;
      max-width: 680px;
      padding: 3.5rem 4rem;
      animation: fadeUp 0.35s ease-out both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Header Card ── */
    .auth-card-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2.5rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid #f1f5f9;
    }

    .auth-card-logo {
      width: 60px;
      height: 60px;
      border-radius: 0;
      background: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .auth-card-logo img {
      width: 60px;
      height: 60px;
      object-fit: contain;
      border-radius: 0;
    }

    .auth-card-logo-fallback {
      font-size: 1.5rem;
    }

    .auth-card-title h1 {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--color-primary);
      margin-bottom: 2px;
    }

    .auth-card-title p {
      font-size: 0.8rem;
      color: var(--color-text-muted);
      margin-bottom: 0;
    }

    /* ── Judul Form ── */
    .auth-form-title {
      margin-bottom: 2rem;
    }

    .auth-form-title h2 {
      font-size: 1.75rem;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 0.4rem;
      letter-spacing: -0.5px;
    }

    .auth-form-title p {
      font-size: 0.9rem;
      color: #64748b;
      margin-bottom: 0;
    }

    /* ── Error Banner ── */
    .auth-error-banner {
      display: none;
      background: #fef2f2;
      border: 1px solid #fca5a5;
      border-radius: 10px;
      padding: 0.75rem 1rem;
      font-size: 0.875rem;
      color: #dc2626;
      margin-bottom: 1.5rem;
    }

    .auth-error-banner.visible { display: block; }

    /* ── Row dua kolom untuk field ── */
    .auth-fields-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0 1.5rem;
    }

    .auth-fields-row .auth-field {
      grid-column: span 1;
    }

    /* ── Field ── */
    .auth-field {
      margin-bottom: 1.25rem;
    }

    .auth-field label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 0.5rem;
    }

    .auth-field input {
      width: 100%;
      padding: 0.8rem 1rem;
      font-size: 0.9375rem;
      font-family: var(--font-base);
      color: #0f172a;
      background: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
      margin-bottom: 0;
    }

    .auth-field input:focus {
      border-color: var(--color-primary);
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .auth-field input.input-error {
      border-color: #ef4444;
      background: #fff8f8;
    }

    .field-error {
      display: none;
      font-size: 0.775rem;
      color: #ef4444;
      margin-top: 0.35rem;
    }

    .field-error.visible { display: block; }

    /* ── Input password dengan ikon mata ── */
    .pw-wrap {
      position: relative;
    }

    .pw-wrap input {
      width: 100%;
      padding-right: 2.75rem;
      box-sizing: border-box;
    }

    .pw-wrap input[type="password"]::-ms-reveal,
    .pw-wrap input[type="password"]::-ms-clear {
      display: none;
    }

    /* Override style.css global button[type="button"] untuk tombol mata */
    .pw-toggle {
      position: absolute !important;
      right: 12px !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      width: 20px !important;
      height: 20px !important;
      padding: 0 !important;
      margin: 0 !important;
      background: transparent !important;
      border: none !important;
      box-shadow: none !important;
      outline: none !important;
      cursor: pointer !important;
      color: #2563eb !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      z-index: 2 !important;
      font-size: 0 !important;
      line-height: 0 !important;
      min-width: 0 !important;
      min-height: 0 !important;
    }

    .pw-toggle:hover { color: #475569 !important; background: transparent !important; }
    .pw-toggle:active { transform: translateY(-50%) scale(1) !important; }
    .pw-toggle svg { width: 20px !important; height: 20px !important; pointer-events: none !important; }

    /* ── Lupa password ── */
    .auth-forgot {
      text-align: right;
      margin-bottom: 1.75rem;
    }

    .auth-forgot a {
      font-size: 0.8125rem;
      color: var(--color-primary);
      font-weight: 500;
      text-decoration: none;
    }

    .auth-forgot a:hover { text-decoration: underline; }

    /* ── Tombol Masuk ── */
    .auth-btn-primary {
      display: block;
      width: 100%;
      padding: 0.9rem 1rem;
      font-size: 1rem;
      font-weight: 700;
      font-family: var(--font-base);
      color: #ffffff;
      background: var(--color-primary);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
      box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
      letter-spacing: 0.2px;
    }

    .auth-btn-primary:hover {
      background: var(--color-primary-dark);
      box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
    }

    .auth-btn-primary:active { transform: scale(0.99); }

    /* ── Divider ── */
    .auth-divider {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin: 1.5rem 0;
    }

    .auth-divider::before,
    .auth-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #e2e8f0;
    }

    .auth-divider span {
      font-size: 0.8rem;
      color: #94a3b8;
      white-space: nowrap;
    }

    /* ── Tombol Daftar ── */
    .auth-btn-secondary {
      display: block;
      width: 100%;
      padding: 0.9rem 1rem;
      font-size: 1rem;
      font-weight: 600;
      font-family: var(--font-base);
      color: var(--color-primary);
      background: transparent;
      border: 1.5px solid var(--color-primary);
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.2s, transform 0.15s;
      text-align: center;
      text-decoration: none;
      letter-spacing: 0.2px;
    }

    .auth-btn-secondary:hover { background: #eff6ff; text-decoration: none; }
    .auth-btn-secondary:active { transform: scale(0.99); }

    /* ── Link kembali ── */
    .auth-back {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      font-size: 0.8125rem;
      color: #94a3b8;
      text-decoration: none;
      margin-bottom: 2rem;
      transition: color 0.2s;
    }

    .auth-back:hover { color: var(--color-primary); text-decoration: none; }

    /* ── Responsive Mobile ── */
    @media (max-width: 600px) {
      .auth-page {
        padding: 1rem;
        align-items: flex-start;
        padding-top: 2rem;
      }

      .auth-card {
        padding: 1.75rem 1.25rem;
        border-radius: 16px;
        max-width: 100%;
      }

      .auth-card-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1.25rem;
      }

      .auth-card-logo {
        width: 44px;
        height: 44px;
      }

      .auth-card-logo img {
        width: 44px;
        height: 44px;
      }

      .auth-card-title h1 {
        font-size: 1rem;
      }

      .auth-form-title {
        margin-bottom: 1.25rem;
      }

      .auth-form-title h2 {
        font-size: 1.5rem;
      }

      /* Ubah grid 2 kolom jadi 1 kolom di mobile */
      .auth-fields-row {
        grid-template-columns: 1fr;
        gap: 0;
      }

      .auth-field input {
        font-size: 1rem; /* hindari auto-zoom di iOS */
        padding: 0.75rem 0.875rem;
      }

      /* Pastikan ikon mata tetap di kanan di mobile */
      .pw-wrap input {
        padding-right: 2.75rem !important;
      }

      .auth-btn-primary {
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
      }

      .auth-btn-secondary {
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
      }

      .auth-forgot {
        margin-bottom: 1.25rem;
      }

      .auth-back {
        margin-bottom: 1.25rem;
      }
    }
  </style>
  <link rel="stylesheet" href="/css/auth-glass.css?v=9">
  <script>if(window.self!==window.top)document.documentElement.classList.add('embed');</script>
  <script src="/js/clarity.js"></script>
</head>
<body class="auth-page">

  <div class="auth-card">
    <a href="/" class="auth-back">&#8592; Kembali ke Beranda</a>

    <!-- Header dengan logo & nama app -->
    <div class="auth-card-header">
      <div class="auth-card-logo">
        <img src="/assets/images/logo.webp" alt="Logo LingkunganKU"
          onerror="this.style.display='none'; document.querySelector('.auth-card-logo-fallback').style.display='block'">
        <span class="auth-card-logo-fallback" style="display:none">🌿</span>
      </div>
      <div class="auth-card-title">
        <h1>LingkunganKU</h1>
        <p>Platform Pelaporan Lingkungan</p>
      </div>
    </div>

    <!-- Judul -->
    <div class="auth-form-title">
      <h2>Selamat Datang!</h2>
      <p>Masuk ke akun LingkunganKU Anda untuk melanjutkan</p>
    </div>

    <!-- Error banner -->
    <div class="auth-error-banner" id="error-banner" role="alert" aria-live="polite">
      Email/telepon atau password salah.
    </div>

    <form id="form-login" novalidate>
      <!-- Dua field dalam satu baris -->
      <div class="auth-fields-row">
        <div class="auth-field">
          <label for="email-atau-telepon">Email</label>
          <input type="email" id="email-atau-telepon" name="email_atau_telepon"
            placeholder="Masukkan alamat email" autocomplete="username">
          <span class="field-error" id="error-email">Field ini wajib diisi</span>
        </div>

        <div class="auth-field">
          <label for="password">Password</label>
          <div class="pw-wrap">
            <input type="password" id="password" name="password"
              placeholder="Kata sandi" autocomplete="current-password">
            <button type="button" class="pw-toggle" aria-label="Tampilkan password" data-target="password">
              <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <ellipse cx="12" cy="12" rx="10" ry="6.5"/>
                <circle cx="12" cy="12" r="3"/>
                <circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/>
              </svg>
              <svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="12" rx="10" ry="6.5"/>
                <circle cx="12" cy="12" r="3"/>
                <circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/>
                <line x1="3" y1="3" x2="21" y2="21"/>
              </svg>
            </button>
          </div>
          <span class="field-error" id="error-password">Field ini wajib diisi</span>
        </div>
      </div>

      <div class="auth-forgot">
        <a href="/lupa-password">Lupa password?</a>
      </div>

      <button type="submit" class="auth-btn-primary">Masuk</button>
    </form>

    <div id="google-wrap" style="display:flex;justify-content:center;margin-top:.8rem"><div id="google-btn" style="width:100%;max-width:400px;display:flex;justify-content:center"></div></div>
    <div class="auth-divider"><span>atau belum punya akun?</span></div>

    <a href="/register" class="auth-btn-secondary">Daftar Akun Baru</a>
  </div>

  <script>

    // ── Toggle show/hide password ──
    document.querySelectorAll('.pw-toggle').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var input = document.getElementById(btn.getAttribute('data-target'));
        var isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        // icon-eye-off = default (password hidden) | icon-eye = password visible
        btn.querySelector('.icon-eye').style.display     = isHidden ? '' : 'none';
        btn.querySelector('.icon-eye-off').style.display = isHidden ? 'none' : '';
      });
    });

    var sudahLogin = localStorage.getItem('lingkunganku_logged_in') === 'true'
      && Boolean(localStorage.getItem('lingkunganku_nama'))
      && Boolean(localStorage.getItem('lingkunganku_email'));

    if (sudahLogin) {
      window.location.href = '/';
    }

    var form        = document.getElementById('form-login');
    var inputEmail  = document.getElementById('email-atau-telepon');
    var inputPw     = document.getElementById('password');
    var errorBanner = document.getElementById('error-banner');
    var errEmail    = document.getElementById('error-email');
    var errPw       = document.getElementById('error-password');

    function clearErr(input, errEl) {
      input.classList.remove('input-error');
      errEl.classList.remove('visible');
      errorBanner.classList.remove('visible');
    }

    inputEmail.addEventListener('input', function() { clearErr(inputEmail, errEmail); });
    inputPw.addEventListener('input',    function() { clearErr(inputPw, errPw); });

  </script>

  <script src="/js/auth-warga.js?v=3"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="/js/google-login.js?v=1"></script>
</body>
</html>
