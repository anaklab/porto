<?php
require dirname(__DIR__) . '/bootstrap.php';
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 — Halaman tidak ditemukan</title><meta name="robots" content="noindex">
<link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml">
<script src="/assets/js/theme.js?v=2"></script>
<style>
:root{--bg:#0B1120;--fg:#F1F5F9;--muted:#94A3B8;--accent:#22D3EE;--on-accent:#0B1120}
:root[data-theme="light"]{--bg:#F8FAFC;--fg:#0F172A;--muted:#475569;--accent:#0E7490;--on-accent:#fff}
body{margin:0;min-height:100vh;display:grid;place-items:center;background:var(--bg);color:var(--fg);font-family:"Plus Jakarta Sans",system-ui,sans-serif;text-align:center;padding:24px}
code{font-family:ui-monospace,Consolas,monospace;color:var(--accent)}
h1{font-size:clamp(3rem,10vw,6rem);margin:.2em 0;letter-spacing:-.04em}
p{color:var(--muted)}
a{display:inline-block;margin-top:16px;background:var(--accent);color:var(--on-accent);padding:12px 22px;border-radius:10px;font-weight:600;text-decoration:none}
</style></head>
<body><div>
<code>$ ping halaman-ini</code>
<h1>404</h1>
<p>Request timed out. Halaman yang Anda cari tidak ditemukan.</p>
<a href="/">Kembali ke Beranda</a>
</div></body></html>
