<?php
/**
 * Data profil (non-rahasia). Ubah isi di sini tanpa menyentuh HTML.
 * Kredensial SMTP taruh di config.local.php (lihat config.local.example.php).
 */
return [
    'name'      => 'Rendi Suhendri',
    'role'      => 'Coder & Networking Specialist',
    'typing'    => ['Web Developer', 'PHP Programmer', 'Networking Specialist', 'IT Problem Solver'],
    'tagline'   => 'Saya membangun aplikasi web sekaligus merancang jaringan yang menjalankannya, dari kode sampai kabel.',
    'available' => true,
    'site_url'  => 'https://localhost',          // GANTI: domain final (untuk canonical, OG, sitemap)

    // Kontak (GANTI dengan data asli)
    'location'  => 'Kuningan, Jawa Barat',
    'email'     => 'rendisuhen24@gmail.com',
    'whatsapp'  => '628981919248',                // format internasional tanpa '+' dan tanpa spasi
    'wa_text'   => 'Halo Rendi, saya melihat portofolio Anda dan ingin berdiskusi tentang ',
    'github'    => 'https://github.com/anaklab',
    'linkedin'  => '',                             // kosongkan jika tidak ada → ikon disembunyikan
    'languages' => 'Indonesia, Inggris',

    // Statistik: isi angka NYATA. Nilai null = item tidak ditampilkan.
    'stats' => [
        ['value' => null, 'suffix' => '+', 'label' => 'Tahun Pengalaman'],
        ['value' => null, 'suffix' => '+', 'label' => 'Proyek Selesai'],
        ['value' => 5,    'suffix' => '',  'label' => 'Teknologi Utama'],
    ],

    // Letakkan file CV di public/assets/cv/ — tombol muncul otomatis jika file ada
    'cv_file' => 'assets/cv/CV-Rendi-Suhendri.pdf',

    'bio' => [
        'Saya Rendi Suhendri, pengembang perangkat lunak yang juga mendalami jaringan komputer. Saya terbiasa membangun website dan sistem informasi berbasis PHP, serta antarmuka responsif dengan HTML, CSS, JavaScript, dan Bootstrap.',
        'Di sisi infrastruktur, saya menangani instalasi dan konfigurasi jaringan, router, hingga server. Jadi aplikasi yang saya buat tidak hanya jalan di laptop, tapi juga siap dipakai dengan andal di lingkungan kerja Anda.',
    ],
];
