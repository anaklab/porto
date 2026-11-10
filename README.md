# Website Portofolio — Rendi Suhendri

Landing page satu halaman: **HTML, CSS, JavaScript (vanilla), Bootstrap 5.3, PHP 8.1+**.
Bagian depan memakai konsep *Split Hero*: separuh wajah "networking" dan separuh "&lt;coder&gt;". Garis belahnya mengikuti kursor (desktop) atau geseran jari (HP).

## Struktur

```
portfolio/
├── public/                 ← WEB ROOT (arahkan domain ke sini)
│   ├── index.php           ← merakit semua partial
│   ├── contact.php         ← endpoint form kontak (AJAX + fallback tanpa JS)
│   ├── 404.php, robots.txt, sitemap.xml, site.webmanifest, .htaccess
│   └── assets/ css/ js/ img/ cv/
├── partials/               ← head, navbar, hero, about, skills, projects, contact, footer, icons
├── data/
│   ├── projects.json       ← daftar proyek (GANTI dengan proyek nyata)
│   └── skills.php          ← layanan & tech stack (+ tingkat kemahiran)
├── config.php              ← nama, kontak, bio, statistik
├── config.local.example.php← salin → config.local.php (SMTP, rahasia)
├── bootstrap.php           ← helper & inisialisasi
├── nginx.conf.example
└── composer.json           ← PHPMailer (opsional, disarankan)
```

## Menjalankan di komputer

```bash
cd portfolio
php -S localhost:8000 -t public
# buka http://localhost:8000
```

Dengan XAMPP/Laragon: letakkan folder `portfolio` di `htdocs`/`www`, lalu buka `http://localhost/portfolio/public/`.

## Yang WAJIB diisi sebelum online

1. **`config.php`**: email, nomor WhatsApp (format `62812…`), LinkedIn (opsional), `site_url`, dan statistik nyata. Statistik bernilai `null` disembunyikan, dan strip statistik baru muncul jika minimal 2 angka terisi.
2. **`data/projects.json`**: ganti 6 proyek contoh dengan proyek asli. Hapus `"placeholder": true` agar badge **Contoh** hilang. Taruh gambar di `public/assets/img/projects/` (16:9, WebP ≤ 80 KB, minimal 800×450). Isi `gallery` dengan 2–4 gambar agar modal menampilkan carousel.
3. **`data/skills.php`**: isi `level` (1 Dasar, 2 Menengah, 3 Mahir) dan hapus item networking/tools yang tidak dikuasai.
4. **CV**: simpan sebagai `public/assets/cv/CV-Rendi-Suhendri.pdf`. Tombol "Unduh CV" muncul otomatis.
5. **`robots.txt` & `sitemap.xml`**: ganti `example.com` dengan domain asli.

## Form kontak (email)

```bash
composer install                       # memasang PHPMailer
cp config.local.example.php config.local.php
# isi mail_to, smtp_user, smtp_pass (Gmail: pakai App Password)
```

Tanpa PHPMailer, sistem memakai `mail()` bawaan PHP, yang sering masuk spam atau tidak didukung hosting. Proteksi yang sudah aktif: token CSRF, honeypot, rate-limit 3 pesan per 10 menit per IP (`logs/ratelimit.json`), serta validasi di browser dan server.

## Deploy

- **Shared hosting (cPanel):** upload isi `public/` ke `public_html/`, dan sisanya (`partials/`, `data/`, `config*.php`, `bootstrap.php`, `logs/`, `cache/`) ke folder **di atas** `public_html`. Struktur relatifnya tetap sama karena `index.php` memanggil `dirname(__DIR__)`.
- **VPS/Server sendiri:** lihat `nginx.conf.example` (root = `public/`). Folder `logs/` harus bisa ditulis oleh PHP: `chown -R www-data logs`.
- Aktifkan HTTPS (Let's Encrypt / Cloudflare).

## Catatan teknis

- Bootstrap & font dimuat dari CDN (jsDelivr, Google Fonts). Untuk keamanan maksimal, tambahkan atribut `integrity` (SRI) dari https://getbootstrap.com/docs/5.3/getting-started/download/#cdn-via-jsdelivr, atau unduh file Bootstrap ke `assets/`.
- Logo tech stack berupa monogram teks agar ringan. Bisa diganti SVG dari Devicon/Simple Icons.
- Analitik: `main.js` sudah mengirim event (`cta_hero`, `whatsapp`, `github`, `download_cv`, `open_project`, `contact_submit`) jika GA4 (`gtag`) atau Umami terpasang.
- Semua animasi dimatikan otomatis untuk pengguna dengan pengaturan *reduce motion*.
