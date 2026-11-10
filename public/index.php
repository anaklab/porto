<?php
require dirname(__DIR__) . '/bootstrap.php';

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: DENY');

foreach (['head', 'navbar', 'hero', 'about', 'skills', 'projects', 'contact', 'footer'] as $part) {
    include ROOT . "/partials/{$part}.php";
}
