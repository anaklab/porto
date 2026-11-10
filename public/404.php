<?php
require dirname(__DIR__) . '/bootstrap.php';
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 — Halaman tidak ditemukan</title><meta name="robots" content="noindex">
<link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml">
<style>
body{margin:0;min-height:100vh;display:grid;place-items:center;background:#0B1120;color:#F1F5F9;font-family:"Plus Jakarta Sans",system-ui,sans-serif;text-align:center;padding:24px}
code{font-family:ui-monospace,Consolas,monospace;color:#22D3EE}
h1{font-size:clamp(3rem,10vw,6rem);margin:.2em 0;letter-spacing:-.04em}
p{color:#94A3B8}
a{display:inline-block;margin-top:16px;background:#22D3EE;color:#0B1120;padding:12px 22px;border-radius:10px;font-weight:600;text-decoration:none}
</style></head>
<body><div>
<code>$ ping halaman-ini</code>
<h1>404</h1>
<p>Request timed out. Halaman yang Anda cari tidak ditemukan.</p>
<a href="/">Kembali ke Beranda</a>
</div></body></html>
