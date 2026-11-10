<?php
/**
 * Salin file ini menjadi config.local.php lalu isi.
 * config.local.php TIDAK boleh di-commit ke GitHub (sudah ada di .gitignore).
 */
return [
    'mail_to'      => 'email@domain.com',     // inbox penerima pesan dari form kontak
    'mail_from'    => 'noreply@domain.com',   // alamat pengirim (sebaiknya domain sendiri)

    // SMTP (dipakai jika PHPMailer terpasang via Composer). Kosongkan host untuk memakai mail() bawaan.
    'smtp_host'    => 'smtp.gmail.com',
    'smtp_port'    => 587,
    'smtp_user'    => '',
    'smtp_pass'    => '',                     // untuk Gmail gunakan App Password, bukan password akun
    'smtp_secure'  => 'tls',

    // Rate limit form kontak
    'rate_limit'   => 3,                      // maksimal kiriman
    'rate_window'  => 600,                    // per 600 detik (10 menit) per IP
];
