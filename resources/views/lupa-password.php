<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LingkunganKU - Lupa Password</title>
  <meta name="description" content="Pulihkan akses akun LingkunganKU Anda.">
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
      max-width: 480px;
      padding: 3rem 3.5rem;
      animation: fadeUp 0.35s ease-out both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .auth-card-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 2rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #f1f5f9;
    }

    .auth-card-logo img {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    .auth-card-title h1 {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--color-primary);
      margin-bottom: 2px;
    }

    .auth-card-title p {
      font-size: 0.8rem;
      color: var(--color-text-muted);
      margin: 0;
    }

    .auth-form-title {
      margin-bottom: 1.5rem;
    }

    .auth-form-title h2 {
      font-size: 1.5rem;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 0.4rem;
    }

    .auth-form-title p {
      font-size: 0.875rem;
      color: #64748b;
      margin: 0;
      line-height: 1.5;
    }

    /* Panel step */
    .step { display: none; }
    .step.aktif { display: block; }

    /* Banner */
    .auth-banner {
      display: none;
      border-radius: 10px;
      padding: 0.75rem 1rem;
      font-size: 0.875rem;
      margin-bottom: 1.25rem;
    }
    .auth-banner.sukses {
      display: block;
      background: #f0fdf4;
      border: 1px solid #86efac;
      color: #15803d;
    }
    .auth-banner.error {
      display: block;
      background: #fef2f2;
      border: 1px solid #fca5a5;
      color: #dc2626;
    }

    /* Field */
    .auth-field { margin-bottom: 1.25rem; }

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
      box-sizing: border-box;
      transition: border-color 0.2s, box-shadow 0.2s;
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

    /* Password wrap */
    .pw-wrap { position: relative; }
    .pw-wrap input { padding-right: 2.75rem !important; }

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
      cursor: pointer !important;
      color: #2563eb !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      z-index: 2 !important;
      min-width: 0 !important;
      min-height: 0 !important;
      font-size: 0 !important;
      line-height: 0 !important;
    }
    .pw-toggle:hover { color: #1d4ed8 !important; background: transparent !important; }
    .pw-toggle svg { width: 24px !important; height: 24px !important; pointer-events: none !important; }
    .pw-toggle .icon-eye, .pw-toggle .icon-eye-off { display: none; }
    .pw-toggle[data-visible="true"] .icon-eye { display: block !important; }
    .pw-toggle[data-visible="false"] .icon-eye-off { display: block !important; }

    /* Tombol */
    .auth-btn-primary {
      display: block;
      width: 100%;
      padding: 0.875rem 1rem;
      font-size: 1rem;
      font-weight: 700;
      font-family: var(--font-base);
      color: #ffffff;
      background: var(--color-primary);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.2s;
      box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
      letter-spacing: 0.2px;
    }
    .auth-btn-primary:hover { background: var(--color-primary-dark); }

    /* Link kembali */
    .auth-back {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      font-size: 0.8125rem;
      color: #94a3b8;
      text-decoration: none;
      margin-bottom: 1.75rem;
    }
    .auth-back:hover { color: var(--color-primary); text-decoration: none; }

    .auth-login-link {
      text-align: center;
      margin-top: 1.25rem;
      font-size: 0.875rem;
      color: #64748b;
    }
    .auth-login-link a {
      color: var(--color-primary);
      font-weight: 600;
      text-decoration: none;
    }
    .auth-login-link a:hover { text-decoration: underline; }

    /* Ikon centang sukses */
    .sukses-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      background: #dcfce7;
      border-radius: 50%;
      margin: 0 auto 1.25rem;
    }
    .sukses-icon svg { width: 30px; height: 30px; color: #15803d; }

    @media (max-width: 600px) {
      .auth-page { padding: 1rem; align-items: flex-start; padding-top: 2rem; }
      .auth-card { padding: 1.75rem 1.25rem; border-radius: 16px; }
      .auth-card-logo img { width: 40px; height: 40px; }
      .auth-form-title h2 { font-size: 1.3rem; }
      .auth-field input { font-size: 1rem; }
    }
  </style>
  <script src="/js/clarity.js"></script>
</head>
<body class="auth-page">

  <div class="auth-card">
    <a href="/login" class="auth-back">&#8592; Kembali ke Masuk</a>

    <div class="auth-card-header">
      <div class="auth-card-logo">
        <img src="/assets/images/logo.webp" alt="Logo LingkunganKU"
          onerror="this.style.display='none'">
      </div>
      <div class="auth-card-title">
        <h1>LingkunganKU</h1>
        <p>Platform Pelaporan Lingkungan</p>
      </div>
    </div>

    <!-- STEP 1: Masukkan email -->
    <div class="step aktif" id="step-1">
      <div class="auth-form-title">
        <h2>Lupa Password?</h2>
        <p>Masukkan email akun Anda. Kami akan menampilkan opsi untuk mengatur ulang password.</p>
      </div>

      <div class="auth-banner" id="banner-step1"></div>

      <div class="auth-field">
        <label for="email-lupa">Email atau nomor telepon</label>
        <input type="text" id="email-lupa" placeholder="Masukkan email atau no. telepon" autocomplete="username">
        <span class="field-error" id="error-email-lupa">Field ini wajib diisi</span>
      </div>

      <button type="button" class="auth-btn-primary" id="btn-cari-akun">Cari Akun</button>

      <div class="auth-login-link">
        Ingat password? <a href="/login">Masuk di sini</a>
      </div>
    </div>

    <!-- STEP 2: Reset password -->
    <div class="step" id="step-2">
      <div class="auth-form-title">
        <h2>Atur Password Baru</h2>
        <p>Buat password baru untuk akun Anda.</p>
      </div>

      <div class="auth-banner" id="banner-step2"></div>

      <div class="auth-field">
        <label for="pw-baru">Password Baru</label>
        <div class="pw-wrap">
          <input type="password" id="pw-baru" placeholder="Masukkan password baru">
          <button type="button" class="pw-toggle" data-visible="false" data-target="pw-baru" aria-label="Tampilkan password">
            <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <ellipse cx="12" cy="12" rx="10" ry="6.5"/><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/>
            </svg>
            <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <ellipse cx="12" cy="12" rx="10" ry="6.5"/><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/><line x1="3" y1="3" x2="21" y2="21"/>
            </svg>
          </button>
        </div>
        <span class="field-error" id="error-pw-baru">Password wajib diisi</span>
      </div>

      <div class="auth-field">
        <label for="pw-konfirmasi">Konfirmasi Password</label>
        <div class="pw-wrap">
          <input type="password" id="pw-konfirmasi" placeholder="Ulangi password baru">
          <button type="button" class="pw-toggle" data-visible="false" data-target="pw-konfirmasi" aria-label="Tampilkan password">
            <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <ellipse cx="12" cy="12" rx="10" ry="6.5"/><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/>
            </svg>
            <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <ellipse cx="12" cy="12" rx="10" ry="6.5"/><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="1" fill="currentColor" stroke="none"/><line x1="3" y1="3" x2="21" y2="21"/>
            </svg>
          </button>
        </div>
        <span class="field-error" id="error-pw-konfirmasi">Password tidak cocok</span>
      </div>

      <button type="button" class="auth-btn-primary" id="btn-reset">Simpan Password Baru</button>
    </div>

    <!-- STEP 3: Berhasil -->
    <div class="step" id="step-3">
      <div class="sukses-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>
      <div class="auth-form-title" style="text-align:center">
        <h2>Password Berhasil Diubah!</h2>
        <p>Password akun Anda telah diperbarui. Silakan masuk dengan password baru.</p>
      </div>
      <a href="/login" class="auth-btn-primary" style="text-align:center; text-decoration:none; display:block;">Masuk Sekarang</a>
    </div>

  </div>

  <script>
    var emailTarget = '';

    // Toggle show/hide password
    document.querySelectorAll('.pw-toggle').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var input = document.getElementById(btn.getAttribute('data-target'));
        var isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        btn.setAttribute('data-visible', isHidden ? 'false' : 'true');
      });
    });

    function tampilBanner(id, teks, tipe) {
      var el = document.getElementById(id);
      el.textContent = teks;
      el.className = 'auth-banner ' + tipe;
    }

    function tampilStep(n) {
      document.querySelectorAll('.step').forEach(function(s) { s.classList.remove('aktif'); });
      document.getElementById('step-' + n).classList.add('aktif');
    }

    // Step 1: cari akun
    document.getElementById('btn-cari-akun').addEventListener('click', function() {
      var email   = document.getElementById('email-lupa').value.trim();
      var errEl   = document.getElementById('error-email-lupa');
      var inputEl = document.getElementById('email-lupa');

      errEl.classList.remove('visible');
      inputEl.classList.remove('input-error');

      if (!email) {
        errEl.textContent = 'Field ini wajib diisi';
        errEl.classList.add('visible');
        inputEl.classList.add('input-error');
        return;
      }

      // Cek akun di localStorage
      var akun = JSON.parse(localStorage.getItem('lingkunganku_accounts') || '[]');
      var ketemu = akun.some(function(a) {
        return a.email.toLowerCase() === email.toLowerCase();
      });

      if (!ketemu) {
        tampilBanner('banner-step1', 'Akun dengan email/telepon tersebut tidak ditemukan.', 'error');
        inputEl.classList.add('input-error');
        return;
      }

      emailTarget = email;
      tampilStep(2);
    });

    // Step 2: simpan password baru
    document.getElementById('btn-reset').addEventListener('click', function() {
      var pw    = document.getElementById('pw-baru').value;
      var konf  = document.getElementById('pw-konfirmasi').value;
      var errPw = document.getElementById('error-pw-baru');
      var errK  = document.getElementById('error-pw-konfirmasi');

      errPw.classList.remove('visible');
      errK.classList.remove('visible');
      document.getElementById('pw-baru').classList.remove('input-error');
      document.getElementById('pw-konfirmasi').classList.remove('input-error');

      var ok = true;
      if (!pw) {
        errPw.textContent = 'Password wajib diisi';
        errPw.classList.add('visible');
        document.getElementById('pw-baru').classList.add('input-error');
        ok = false;
      }
      if (!konf) {
        errK.textContent = 'Konfirmasi password wajib diisi';
        errK.classList.add('visible');
        document.getElementById('pw-konfirmasi').classList.add('input-error');
        ok = false;
      }
      if (!ok) return;

      if (pw !== konf) {
        errK.textContent = 'Password dan konfirmasi tidak cocok';
        errK.classList.add('visible');
        document.getElementById('pw-konfirmasi').classList.add('input-error');
        return;
      }

      if (pw.length < 6) {
        errPw.textContent = 'Password minimal 6 karakter';
        errPw.classList.add('visible');
        document.getElementById('pw-baru').classList.add('input-error');
        return;
      }

      // Update password di localStorage
      var akun = JSON.parse(localStorage.getItem('lingkunganku_accounts') || '[]');
      akun = akun.map(function(a) {
        if (a.email.toLowerCase() === emailTarget.toLowerCase()) {
          return Object.assign({}, a, { password: pw });
        }
        return a;
      });
      localStorage.setItem('lingkunganku_accounts', JSON.stringify(akun));

      tampilStep(3);
    });
  </script>

</body>
</html>
