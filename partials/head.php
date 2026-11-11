<?php
$title = $cfg['name'] . ' — ' . $cfg['role'];
$desc  = 'Portofolio ' . $cfg['name'] . ', web developer (PHP, JavaScript) & networking specialist. Menerima proyek website, aplikasi, dan instalasi jaringan.';
$url   = rtrim($cfg['site_url'], '/') . '/';
$ld = [
    '@context' => 'https://schema.org',
    '@type'    => 'Person',
    'name'     => $cfg['name'],
    'jobTitle' => $cfg['role'],
    'url'      => $url,
    'image'    => $url . 'assets/img/og-image.jpg',
    'address'  => ['@type' => 'PostalAddress', 'addressLocality' => $cfg['location'], 'addressCountry' => 'ID'],
    'sameAs'   => array_values(array_filter([$cfg['github'], $cfg['linkedin']])),
];
?>
<!DOCTYPE html>
<html lang="id" data-bs-theme="dark" class="no-js">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<link rel="canonical" href="<?= e($url) ?>">
<meta name="theme-color" content="#0B1120">

<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($url) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:image" content="<?= e($url) ?>assets/img/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<link rel="preload" as="image" href="assets/img/hero-photo.webp" type="image/webp">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css?v=2">
<script src="assets/js/theme.js?v=2"></script>

<script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<a class="rs-skip" href="#main">Lewati ke konten utama</a>
<?php include ROOT . '/partials/icons.php'; ?>
