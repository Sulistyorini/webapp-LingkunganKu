/* Data FAQ chatbot LingkunganKU. Edit file ini untuk menambah atau mengubah jawaban. */
var FAQ_SAPAAN = 'Halo! Saya asisten LingkunganKU. Tanyakan cara melapor, arti status laporan, atau pengaturan akun.';

var FAQ_CADANGAN = 'Maaf, saya belum menemukan jawabannya. Coba pakai kata lain, atau pilih salah satu topik di bawah.';

var FAQ_CHIP = [1, 2, 4, 6, 9];

var FAQ = [
  {
    id: 1, kategori: 'Laporan', tanya: 'Bagaimana cara membuat laporan?',
    kunci: ['cara buat laporan', 'cara membuat laporan', 'bikin laporan', 'buat laporan', 'membuat laporan',
            'cara lapor', 'cara melapor', 'melapor', 'lapor', 'kirim laporan', 'mengadu', 'pengaduan', 'alur', 'alur pelaporan', 'alur laporan', 'alur melapor', 'tahapan', 'langkah', 'prosedur', 'proses lapor', 'pelaporan'],
    jawab: 'Ada 3 langkah di menu Buat Laporan:\n1. Jenis laporan: pilih kategori, tulis deskripsi, lalu unggah foto bukti.\n2. Lokasi: pilih kecamatan dan desa/kelurahan, lalu isi titik peta.\n3. Konfirmasi: periksa ringkasan, centang pernyataan, lalu tekan Kirim.',
    link: { teks: 'Buka Buat Laporan', href: '/buat-laporan' }
  },
  {
    id: 2, kategori: 'Laporan', tanya: 'Apa arti status laporan?',
    kunci: ['status', 'arti status', 'diterima', 'diproses', 'selesai', 'ditolak', 'tahap', 'progres', 'progress'],
    bobot: 2,
    jawab: 'Status laporan:\n• Diterima: laporan sudah masuk dan sedang ditinjau.\n• Diproses: laporan sudah diterima petugas dan ditangani.\n• Selesai: laporan sudah ditindaklanjuti.\n• Ditolak: laporan tidak bisa diproses, misalnya karena di luar wilayah Kabupaten Nganjuk.'
  },
  {
    id: 3, kategori: 'Laporan', tanya: 'Kenapa laporan saya ditolak?',
    kunci: ['ditolak', 'kenapa ditolak', 'penolakan', 'tidak diproses', 'tidak bisa diproses', 'alasan ditolak', 'luar wilayah', 'di luar'],
    bobot: 3,
    jawab: 'Laporan ditolak jika tidak memenuhi syarat, misalnya lokasinya di luar wilayah Kabupaten Nganjuk. Alasan penolakan tertulis di halaman status laporan dan di notifikasi. Anda bisa membuat laporan baru dengan data yang sudah diperbaiki.',
    link: { teks: 'Lihat Notifikasi', href: '/notifikasi?tab=laporan' }
  },
  {
    id: 4, kategori: 'Laporan', tanya: 'Jenis masalah apa yang bisa dilaporkan?',
    kunci: ['kategori', 'jenis masalah', 'jenis laporan', 'apa saja', 'bisa dilaporkan', 'fasilitas umum',
            'jalan', 'lampu', 'sampah', 'selokan', 'drainase', 'taman', 'got'],
    jawab: 'Kategori yang tersedia: Jalan, Lampu Jalan, Sampah, Selokan, Taman, dan Lainnya. Pilih Lainnya jika masalah Anda tidak masuk kategori lain, lalu jelaskan di kolom deskripsi.'
  },
  {
    id: 5, kategori: 'Laporan', tanya: 'Foto seperti apa yang bisa diunggah?',
    kunci: ['foto', 'gambar', 'unggah', 'upload', 'format', 'ukuran foto', 'maksimal', 'dokumentasi', 'bukti'],
    jawab: 'Foto bukti berformat WebP, PNG, atau JPG dengan ukuran maksimal 2 MB per foto (maksimal 3 foto). Ambil foto yang jelas dan menunjukkan kondisi kerusakannya.'
  },
  {
    id: 6, kategori: 'Laporan', tanya: 'Bagaimana cara menentukan lokasi?',
    kunci: ['lokasi', 'alamat', 'kecamatan', 'desa', 'kelurahan', 'peta', 'maps', 'koordinat', 'gps', 'titik'],
    jawab: 'Di langkah 2 pilih kecamatan, lalu desa/kelurahan dari menu pilihan. Setelah itu isi titik peta dengan koordinat atau nama lokasi, misalnya -6.1751, 106.8272.'
  },
  {
    id: 7, kategori: 'Laporan', tanya: 'Bagaimana cara memantau laporan saya?',
    kunci: ['pantau', 'memantau', 'lacak', 'tracking', 'cek laporan', 'lihat laporan', 'perkembangan', 'tindak lanjut', 'penanganan', 'riwayat'],
    jawab: 'Buka menu Laporan untuk melihat daftar laporan, lalu pilih salah satu untuk membuka detailnya. Di Detail Laporan tekan Lihat Detail Penanganan untuk melihat tahapan: laporan diterima, survei lokasi, proses penanganan, hingga selesai.',
    link: { teks: 'Buka Laporan', href: '/laporan' }
  },
  {
    id: 8, kategori: 'Laporan', tanya: 'Bagaimana mencari laporan tertentu?',
    kunci: ['cari', 'mencari', 'pencarian', 'filter', 'saring', 'kata kunci', 'search'],
    jawab: 'Di menu Laporan, pakai tab status (Semua, Diproses, Selesai, Ditolak) untuk menyaring, atau ketik kata kunci di kolom Cari Laporan, misalnya "jalan berlubang".',
    link: { teks: 'Buka Laporan', href: '/laporan' }
  },
  {
    id: 9, kategori: 'Notifikasi', tanya: 'Di mana saya melihat notifikasi?',
    kunci: ['notifikasi', 'pemberitahuan', 'pesan masuk', 'kabar', 'info terbaru', 'lonceng'],
    jawab: 'Buka menu Notifikasi. Ada tiga tab: Semua, Laporan (perubahan status laporan Anda), dan Pemberitahuan (informasi dari pemerintah dan aplikasi). Daftar dikelompokkan menurut waktu, misalnya Hari Ini dan Bulan Lalu.',
    link: { teks: 'Buka Notifikasi', href: '/notifikasi' }
  },
  {
    id: 10, kategori: 'Akun', tanya: 'Bagaimana cara mendaftar akun?',
    kunci: ['daftar', 'registrasi', 'mendaftar', 'buat akun', 'akun baru', 'sign up', 'register'],
    jawab: 'Pilih Daftar, lalu isi nama lengkap, email atau nomor telepon, password, dan konfirmasi password. Tekan Daftar untuk membuat akun.',
    link: { teks: 'Buka Pendaftaran', href: '/register' }
  },
  {
    id: 11, kategori: 'Akun', tanya: 'Bagaimana cara masuk ke akun?',
    kunci: ['masuk', 'login', 'log in', 'sign in', 'tidak bisa masuk', 'gagal masuk', 'gagal login'],
    jawab: 'Pilih Masuk, isi email atau nomor telepon dan password, lalu tekan Masuk. Jika muncul pesan email atau password salah, periksa kembali data Anda dan coba lagi.',
    link: { teks: 'Buka Halaman Masuk', href: '/login' }
  },
  {
    id: 12, kategori: 'Akun', tanya: 'Saya lupa password. Bagaimana?',
    kunci: ['lupa password', 'lupa kata sandi', 'lupa sandi', 'reset password', 'ganti password', 'ubah password', 'ubah kata sandi', 'kata sandi', 'sandi', 'password'],
    jawab: 'Di halaman Masuk pilih Lupa password? untuk memulihkan akun. Jika Anda sudah masuk dan ingin menggantinya, buka Profil > Akun > Ubah kata sandi.',
    link: { teks: 'Buka Profil', href: '/profil' }
  },
  {
    id: 13, kategori: 'Akun', tanya: 'Apakah saya harus masuk dulu untuk melapor?',
    kunci: ['harus login', 'harus masuk', 'wajib login', 'tanpa akun', 'tanpa login', 'belum punya akun', 'belum login', 'pengunjung', 'tamu'],
    jawab: 'Ya. Pengunjung yang belum masuk hanya bisa melihat pratinjau laporan di Beranda. Menu Buat Laporan, Lihat Semua, dan detail laporan akan mengarahkan Anda ke halaman Masuk.'
  },
  {
    id: 14, kategori: 'Akun', tanya: 'Bagaimana mengubah foto profil atau nama?',
    kunci: ['foto profil', 'ganti foto', 'ubah foto', 'avatar', 'ubah nama', 'ganti nama', 'nama depan', 'nama belakang', 'ubah email', 'ganti email', 'profil', 'akun'],
    jawab: 'Buka Profil > Akun. Di sana Anda bisa mengunggah atau menghapus foto profil (PNG, JPEG, atau GIF, maksimal 2 MB), mengubah nama depan dan belakang, lalu menekan Simpan.',
    link: { teks: 'Buka Profil', href: '/profil' }
  },
  {
    id: 15, kategori: 'Akun', tanya: 'Bagaimana cara keluar dari akun?',
    kunci: ['keluar', 'logout', 'log out', 'sign out'],
    jawab: 'Buka Profil, lalu tekan tombol Keluar di bagian bawah menu samping.',
    link: { teks: 'Buka Profil', href: '/profil' }
  },
  {
    id: 16, kategori: 'Lainnya', tanya: 'Apa itu LingkunganKU?',
    kunci: ['apa itu', 'lingkunganku', 'tentang', 'aplikasi ini', 'tujuan', 'fungsi', 'manfaat', 'versi'],
    jawab: 'LingkunganKU adalah aplikasi untuk menyampaikan pengaduan fasilitas umum seperti jalan rusak, lampu jalan mati, sampah, dan saluran air. Laporan diarahkan berdasarkan wilayah, dan statusnya bisa dipantau sampai selesai.'
  },
  {
    id: 17, kategori: 'Lainnya', tanya: 'Siapa yang menangani laporan saya?',
    kunci: ['siapa menangani', 'siapa yang menangani', 'petugas', 'instansi', 'dinas', 'pihak terkait', 'kecamatan', 'eskalasi', 'diteruskan', 'swadaya'],
    jawab: 'Laporan diperiksa lebih dulu oleh pengurus kelurahan/desa. Jika perlu penanganan lebih besar, laporan diteruskan ke kecamatan lalu ke dinas terkait di kabupaten. Masalah yang bisa dikerjakan warga, seperti gotong royong, ditandai sebagai swadaya warga.'
  },
  {
    id: 18, kategori: 'Lainnya', tanya: 'Berapa lama laporan diproses?',
    kunci: ['berapa lama', 'lama', 'kapan selesai', 'kapan diperbaiki', 'estimasi', 'waktu proses', 'durasi'],
    jawab: 'Lama penanganan bergantung pada jenis masalah dan instansi yang menangani, jadi tidak ada waktu yang pasti. Pantau statusnya di Detail Penanganan dan lewat notifikasi, setiap perubahan status akan diberitahukan.',
    link: { teks: 'Buka Notifikasi', href: '/notifikasi?tab=laporan' }
  },
  {
    id: 19, kategori: 'Lainnya', tanya: 'Bagaimana jika laporan saya sudah dibuat orang lain?',
    kunci: ['duplikat', 'sudah dilaporkan', 'sudah pernah', 'laporan ganda', 'sama'],
    jawab: 'Sebelum melapor, cari dulu di menu Laporan dengan kata kunci masalahnya. Pengurus kelurahan/desa juga memeriksa laporan ganda saat verifikasi, sehingga laporan yang sama bisa ditolak.',
    link: { teks: 'Cari di Laporan', href: '/laporan' }
  },
  {
    id: 20, kategori: 'Lainnya', tanya: 'Bagaimana menghubungi bantuan lebih lanjut?',
    kunci: ['kontak', 'hubungi', 'bantuan', 'admin', 'cs', 'customer service', 'komplain', 'saran', 'masalah aplikasi', 'error', 'bug', 'rusak'],
    bobot: 0.5,
    jawab: 'Pertanyaan yang belum terjawab di sini bisa disampaikan melalui pengurus kelurahan/desa setempat. Jika aplikasi bermasalah, sebutkan halaman dan langkah yang Anda lakukan agar mudah dilacak.'
  }
,
  {
    id: 21, kategori: 'Laporan', tanya: 'Apa fungsi Buat Laporan?',
    kunci: ['fungsi buat laporan', 'fungsi membuat laporan', 'apa fungsi buat laporan', 'untuk apa buat laporan',
            'kegunaan buat laporan', 'manfaat buat laporan', 'tujuan buat laporan',
            'fungsi', 'kegunaan', 'manfaat', 'tujuan', 'untuk apa'],
    bobot: 3,
    jawab: 'Buat Laporan dipakai untuk melaporkan masalah lingkungan di sekitar Anda, seperti jalan berlubang, sampah menumpuk, selokan tersumbat, atau lampu jalan mati. Laporan Anda diteruskan ke petugas untuk ditinjau dan ditangani, dan statusnya bisa dipantau di aplikasi.',
    link: { teks: 'Buka Buat Laporan', href: '/buat-laporan' }
  }
];