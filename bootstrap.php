<?php
/** Inisialisasi bersama: config, data, session, helper. */
declare(strict_types=1);

define('ROOT', __DIR__);

$cfg = require ROOT . '/config.php';
$local = is_file(ROOT . '/config.local.php') ? require ROOT . '/config.local.php' : [];

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

/** Escape output HTML. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Ikon SVG inline dari sprite (partials/icons.php). */
function icon(string $name, string $class = 'ic'): string
{
    return '<svg class="' . e($class) . '" aria-hidden="true" focusable="false"><use href="#i-' . e($name) . '"/></svg>';
}

function wa_link(array $cfg, string $topic = ''): string
{
    return 'https://wa.me/' . rawurlencode($cfg['whatsapp']) . '?text=' . rawurlencode($cfg['wa_text'] . $topic);
}

function load_projects(): array
{
    $raw = @file_get_contents(ROOT . '/data/projects.json');
    $list = $raw ? json_decode($raw, true) : [];
    if (!is_array($list)) return [];
    usort($list, fn($a, $b) => [($b['year'] ?? 0), !empty($b['featured'])] <=> [($a['year'] ?? 0), !empty($a['featured'])]);
    return $list;
}

const CATEGORY_LABEL = ['web' => 'Web','networking' => 'Networking'];
const LEVEL_LABEL = [1 => 'Dasar', 2 => 'Menengah', 3 => 'Mahir'];
