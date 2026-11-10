<?php $hasCv = is_file(ROOT . '/public/' . $cfg['cv_file']); ?>
<section class="rs-section" id="about" aria-labelledby="aboutTitle">
  <div class="container">
    <div class="rs-heading reveal">
      <p class="rs-eyebrow">// tentang saya</p>
      <h2 id="aboutTitle">Kenali Saya Lebih Dekat</h2>
    </div>

    <div class="row g-4 g-lg-5 align-items-center">
      <div class="col-lg-5 reveal">
        <div class="rs-terminal" aria-hidden="true">
          <div class="rs-terminal-bar"><span></span><span></span><span></span><em>rendi@portfolio: ~</em></div>
          <pre class="rs-terminal-body" id="rsTerminal"
data-lines='<?= e(json_encode([
  ['$ whoami', 'cmd'],
  [strtolower(str_replace(' ', '_', $cfg['name'])), 'out'],
  ['$ cat role.txt', 'cmd'],
  [$cfg['role'], 'out'],
  ['$ ls skills/', 'cmd'],
  ['coding/  networking/', 'out'],
  ['$ ping klien', 'cmd'],
  ['64 bytes from klien: siap bekerja sama ✓', 'ok'],
], JSON_UNESCAPED_UNICODE)) ?>'></pre>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="rs-bio reveal">
          <?php foreach ($cfg['bio'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-sm-6 reveal">
            <div class="rs-card rs-dual">
              <div class="rs-dual-icon is-code"><?= icon('code') ?></div>
              <h3>Coder</h3>
              <p>Website dan sistem informasi dengan PHP, JavaScript, dan Bootstrap.</p>
            </div>
          </div>
          <div class="col-sm-6 reveal">
            <div class="rs-card rs-dual">
              <div class="rs-dual-icon is-net"><?= icon('network') ?></div>
              <h3>Networking</h3>
              <p>LAN/WLAN, router, server, dan keamanan dasar jaringan untuk kantor dan sekolah.</p>
            </div>
          </div>
        </div>

        <ul class="rs-facts reveal">
          <li><?= icon('pin') ?><span><b>Lokasi</b><?= e($cfg['location']) ?></span></li>
          <li><?= icon('globe') ?><span><b>Bahasa</b><?= e($cfg['languages']) ?></span></li>
          <li><?= icon('briefcase') ?><span><b>Status</b><?= $cfg['available'] ? 'Menerima proyek freelance' : 'Sedang penuh' ?></span></li>
          <li><?= icon('mail') ?><span><b>Email</b><a href="mailto:<?= e($cfg['email']) ?>"><?= e($cfg['email']) ?></a></span></li>
        </ul>

        <div class="rs-cta justify-content-start reveal">
          <?php if ($hasCv): ?>
            <a class="rs-btn rs-btn-primary" href="<?= e($cfg['cv_file']) ?>" download data-track="download_cv"><?= icon('download') ?> Unduh CV</a>
          <?php endif; ?>
          <a class="rs-btn rs-btn-outline" href="<?= e($cfg['github']) ?>" target="_blank" rel="noopener noreferrer" data-track="github"><?= icon('github') ?> GitHub</a>
        </div>
      </div>
    </div>
  </div>
</section>
