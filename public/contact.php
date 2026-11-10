<?php
/**
 * Endpoint form kontak.
 * - AJAX (header Accept: application/json) → respons JSON {success, message, errors?}
 * - Tanpa JS → redirect ke /?status=ok|error#contact
 */
require dirname(__DIR__) . '/bootstrap.php';

$isAjax = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function respond(bool $ok, string $msg, array $errors = [], int $code = 200): never
{
    global $isAjax;
    if ($isAjax) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => $ok, 'message' => $msg, 'errors' => $errors], JSON_UNESCAPED_UNICODE);
    } else {
        header('Location: ./?status=' . ($ok ? 'ok' : 'error') . '#contact', true, 303);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Metode tidak diizinkan.', [], 405);
}

// 1) CSRF
if (!hash_equals($_SESSION['csrf'] ?? '', (string) ($_POST['csrf'] ?? ''))) {
    respond(false, 'Sesi kedaluwarsa. Muat ulang halaman lalu coba lagi.', [], 419);
}

// 2) Honeypot: bot biasanya mengisi semua field. Pura-pura sukses.
if (trim((string) ($_POST['website'] ?? '')) !== '') {
    respond(true, 'Pesan terkirim! Saya akan membalas dalam 1×24 jam.');
}

// 3) Rate limit per IP (berbasis file)
$limit  = (int) ($local['rate_limit'] ?? 3);
$window = (int) ($local['rate_window'] ?? 600);
$ipKey  = hash('sha256', ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . '|rs');
$rlFile = ROOT . '/logs/ratelimit.json';
$fh = fopen($rlFile, 'c+');
if ($fh && flock($fh, LOCK_EX)) {
    $data = json_decode(stream_get_contents($fh) ?: '{}', true) ?: [];
    $now = time();
    foreach ($data as $k => $times) {
        $data[$k] = array_values(array_filter($times, fn($t) => $t > $now - $window));
        if (!$data[$k]) unset($data[$k]);
    }
    if (count($data[$ipKey] ?? []) >= $limit) {
        flock($fh, LOCK_UN); fclose($fh);
        respond(false, 'Terlalu banyak pesan dalam waktu singkat. Coba lagi beberapa menit lagi, atau hubungi via WhatsApp.', [], 429);
    }
    $data[$ipKey][] = $now;
    ftruncate($fh, 0); rewind($fh);
    fwrite($fh, json_encode($data));
    flock($fh, LOCK_UN); fclose($fh);
}

// 4) Validasi server-side
$name    = trim((string) ($_POST['name'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$service = trim((string) ($_POST['service'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));
$allowed = ['Web Development','Jaringan & Infrastruktur', 'Lainnya'];

$errors = [];
$len = fn($s) => mb_strlen($s, 'UTF-8');
if ($len($name) < 2 || $len($name) > 80)              $errors['name'] = 'Nama harus 2–80 karakter.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))         $errors['email'] = 'Format email tidak valid.';
if (!in_array($service, $allowed, true))                $errors['service'] = 'Pilih jenis layanan.';
if ($len($message) < 10 || $len($message) > 1000)       $errors['message'] = 'Pesan harus 10–1000 karakter.';
if ($errors) respond(false, 'Periksa kembali isian formulir.', $errors, 422);

// Cegah header injection
$name  = str_replace(["\r", "\n"], ' ', $name);
$email = str_replace(["\r", "\n"], '', $email);

// 5) Kirim email
$to      = $local['mail_to']   ?? $cfg['email'];
$from    = $local['mail_from'] ?? $cfg['email'];
$subject = "[Portofolio] {$service} — {$name}";
$body    = "Nama    : {$name}\nEmail   : {$email}\nLayanan : {$service}\nWaktu   : " . date('d M Y H:i') . "\n\n{$message}\n";

$sent = false;
$autoload = ROOT . '/vendor/autoload.php';
try {
    if (is_file($autoload) && !empty($local['smtp_host'])) {
        require $autoload;
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $local['smtp_host'];
        $mail->Port       = (int) ($local['smtp_port'] ?? 587);
        $mail->SMTPAuth   = true;
        $mail->Username   = $local['smtp_user'] ?? '';
        $mail->Password   = $local['smtp_pass'] ?? '';
        $mail->SMTPSecure = $local['smtp_secure'] ?? 'tls';
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom($from, 'Website Portofolio');
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $sent = $mail->send();
    } else {
        $headers = "From: Website Portofolio <{$from}>\r\nReply-To: {$name} <{$email}>\r\nContent-Type: text/plain; charset=UTF-8";
        $sent = @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
    }
} catch (Throwable $ex) {
    error_log('[contact] ' . $ex->getMessage() . "\n", 3, ROOT . '/logs/error.log');
    $sent = false;
}

if (!$sent) {
    respond(false, 'Pesan gagal dikirim. Silakan coba lagi atau hubungi via WhatsApp.', [], 500);
}
respond(true, 'Pesan terkirim! Saya akan membalas dalam 1×24 jam.');
