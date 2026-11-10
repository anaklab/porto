<?php $stats = array_filter($cfg['stats'], fn($s) => $s['value'] !== null); ?>
<header class="rs-split" id="home" aria-label="Perkenalan">
  <!-- Latar kiri: topologi jaringan -->
  <svg class="rs-bg rs-bg-net" id="bgNet" viewBox="0 0 600 800" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
    <g stroke="#34D399" stroke-opacity=".22" stroke-width="1.2" fill="none">
      <path d="M80 160 L230 120 L380 210 L300 360 L140 330 Z"/>
      <path d="M230 120 L300 360 M140 330 L90 520 L260 600 L300 360 L470 470 L420 650 L260 600"/>
      <path d="M380 210 L520 150 M470 470 L560 330 L380 210 M90 520 L40 680"/>
    </g>
    <g fill="#0B1120" stroke="#34D399" stroke-width="1.5" stroke-opacity=".5">
      <circle cx="80" cy="160" r="6"/><circle cx="230" cy="120" r="8"/><circle cx="380" cy="210" r="6"/>
      <circle cx="300" cy="360" r="10"/><circle cx="140" cy="330" r="6"/><circle cx="90" cy="520" r="7"/>
      <circle cx="260" cy="600" r="6"/><circle cx="470" cy="470" r="8"/><circle cx="420" cy="650" r="5"/>
      <circle cx="520" cy="150" r="5"/><circle cx="560" cy="330" r="6"/><circle cx="40" cy="680" r="5"/>
    </g>
    <g font-family="JetBrains Mono, monospace" font-size="13" fill="#34D399" fill-opacity=".35">
      <text x="248" y="112">gateway</text><text x="316" y="392">core-switch</text>
      <text x="40" y="150">192.168.1.1</text><text x="104" y="545">VLAN 10</text>
      <text x="486" y="462">AP-01</text><text x="440" y="672">ping ✓ 2ms</text>
    </g>
    <circle class="rs-packet" r="3" fill="#22D3EE"><animateMotion dur="6s" repeatCount="indefinite" path="M80 160 L230 120 L380 210 L300 360 L140 330 Z"/></circle>
    <circle class="rs-packet" r="3" fill="#34D399"><animateMotion dur="8s" repeatCount="indefinite" path="M300 360 L470 470 L420 650 L260 600 L300 360"/></circle>
  </svg>

  <!-- Latar kanan: potongan kode -->
  <div class="rs-bg rs-bg-code" id="bgCode" aria-hidden="true"><div><i>&lt;?php</i> echo <b>"Halo, klien!"</b>; <i>?&gt;</i>
&lt;div class=<b>"container"</b>&gt;
  .hero { display: grid; }
public class <b>Main</b> {
  const app = () =&gt; render();
  <i>SELECT</i> * <i>FROM</i> projek;
&lt;/div&gt;     HTML5   CSS3
  System.out.println(<b>"OK"</b>);</div></div>

  <div class="rs-side left">
    <h2>networking</h2>
    <p>Merancang, memasang, dan merawat jaringan: LAN/WLAN, router, hingga server yang stabil dan aman.</p>
    <div class="tags">#routing #vlan #server</div>
  </div>

  <div class="rs-photo" id="rsPhoto" role="img" aria-label="Foto <?= e($cfg['name']) ?>: separuh kiri bergaya jaringan, separuh kanan foto asli">
    <img class="img-net"  src="assets/img/hero-network.webp" alt="" width="708" height="944" fetchpriority="high" draggable="false">
    <img class="img-code" src="assets/img/hero-photo.webp"   alt="" width="708" height="944" fetchpriority="high" draggable="false">
    <div class="rs-divider" aria-hidden="true"></div>
  </div>

  <div class="rs-side right">
    <h2>&lt;coder&gt;</h2>
    <p>Membangun website dan sistem informasi yang rapi, cepat, dan mudah dipakai.</p>
    <div class="tags">HTML · CSS · JS · Bootstrap · PHP</div>
  </div>

  <div class="rs-hint" id="rsHint" aria-hidden="true">← geser untuk melihat kedua sisi →</div>
</header>

<main id="main">
<section class="rs-intro" aria-labelledby="heroName">
  <?php if ($cfg['available']): ?><div class="rs-status">Tersedia untuk proyek freelance</div><?php endif; ?>
  <p class="rs-hello">// halo, saya</p>
  <h1 id="heroName"><?= e($cfg['name']) ?></h1>
  <p class="rs-typing" aria-label="<?= e($cfg['role']) ?>">
    <span class="rs-prompt">&gt;</span> <span id="rsTyping" data-words='<?= e(json_encode($cfg['typing'], JSON_UNESCAPED_UNICODE)) ?>'><?= e($cfg['role']) ?></span><span class="rs-caret" aria-hidden="true">_</span>
  </p>
  <p class="rs-lead"><?= e($cfg['tagline']) ?></p>
  <div class="rs-cta">
    <a href="#contact" class="rs-btn rs-btn-primary" data-track="cta_hero">Hubungi Saya <?= icon('arrow') ?></a>
    <a href="#projects" class="rs-btn rs-btn-outline">Lihat Proyek</a>
  </div>
  <div class="rs-social">
    <a href="<?= e($cfg['github']) ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><?= icon('github') ?></a>
    <?php if ($cfg['linkedin']): ?><a href="<?= e($cfg['linkedin']) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><?= icon('linkedin') ?></a><?php endif; ?>
    <a href="<?= e(wa_link($cfg)) ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" data-track="whatsapp"><?= icon('whatsapp') ?></a>
    <a href="mailto:<?= e($cfg['email']) ?>" aria-label="Email"><?= icon('mail') ?></a>
  </div>
  <?php if (count($stats) >= 2): /* tampil jika minimal 2 angka terisi */ ?>
  <div class="rs-stats">
    <?php foreach ($stats as $s): ?>
      <div class="rs-stat"><strong><span data-count="<?= (int) $s['value'] ?>"><?= (int) $s['value'] ?></span><?= e($s['suffix']) ?></strong><span><?= e($s['label']) ?></span></div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>
