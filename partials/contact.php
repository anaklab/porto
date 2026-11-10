<?php $status = $_GET['status'] ?? ''; ?>
<section class="rs-section rs-section-alt" id="contact" aria-labelledby="contactTitle">
  <div class="container">
    <div class="rs-heading reveal">
      <p class="rs-eyebrow">// kontak</p>
      <h2 id="contactTitle">Punya Proyek? Mari Diskusikan</h2>
      <p class="rs-sub">Ceritakan kebutuhan Anda, saya balas maksimal 1×24 jam.</p>
    </div>

    <div class="row g-4 g-lg-5">
      <div class="col-lg-5">
        <div class="rs-channels">
          <a class="rs-card rs-channel is-wa reveal" href="<?= e(wa_link($cfg)) ?>" target="_blank" rel="noopener noreferrer" data-track="whatsapp">
            <span class="rs-channel-icon"><?= icon('whatsapp') ?></span>
            <span><b>WhatsApp</b><small>Respons paling cepat</small></span><?= icon('arrow', 'ic rs-go') ?>
          </a>
          <a class="rs-card rs-channel reveal" href="mailto:<?= e($cfg['email']) ?>">
            <span class="rs-channel-icon"><?= icon('mail') ?></span>
            <span><b>Email</b><small><?= e($cfg['email']) ?></small></span><?= icon('arrow', 'ic rs-go') ?>
          </a>
          <a class="rs-card rs-channel reveal" href="<?= e($cfg['github']) ?>" target="_blank" rel="noopener noreferrer" data-track="github">
            <span class="rs-channel-icon"><?= icon('github') ?></span>
            <span><b>GitHub</b><small><?= e(preg_replace('#^https?://#', '', $cfg['github'])) ?></small></span><?= icon('arrow', 'ic rs-go') ?>
          </a>
          <div class="rs-card rs-channel reveal">
            <span class="rs-channel-icon"><?= icon('pin') ?></span>
            <span><b><?= e($cfg['location']) ?></b><small>Melayani remote &amp; onsite</small></span>
          </div>
        </div>
      </div>

      <div class="col-lg-7 reveal">
        <form class="rs-card rs-form" id="rsForm" action="contact.php" method="post" novalidate>
          <?php if ($status === 'ok'): ?>
            <div class="rs-alert is-ok" role="status">Pesan terkirim! Saya akan membalas dalam 1×24 jam.</div>
          <?php elseif ($status === 'error'): ?>
            <div class="rs-alert is-err" role="alert">Pesan gagal dikirim. Silakan coba lagi atau hubungi via WhatsApp.</div>
          <?php endif; ?>

          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <div class="rs-hp" aria-hidden="true">
            <label for="website">Website</label><input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="row g-3">
            <div class="col-sm-6 rs-field">
              <label for="f-name">Nama Lengkap <span aria-hidden="true">*</span></label>
              <input id="f-name" name="name" type="text" required minlength="2" maxlength="80" autocomplete="name" aria-describedby="e-name">
              <div class="rs-error" id="e-name"></div>
            </div>
            <div class="col-sm-6 rs-field">
              <label for="f-email">Email <span aria-hidden="true">*</span></label>
              <input id="f-email" name="email" type="email" required maxlength="120" autocomplete="email" aria-describedby="e-email">
              <div class="rs-error" id="e-email"></div>
            </div>
            <div class="col-12 rs-field">
              <label for="f-service">Jenis Layanan <span aria-hidden="true">*</span></label>
              <select id="f-service" name="service" required aria-describedby="e-service">
                <option value="">Pilih layanan…</option>
                <option>Web Development</option>
                <option>Jaringan &amp; Infrastruktur</option>
                <option>Lainnya</option>
              </select>
              <div class="rs-error" id="e-service"></div>
            </div>
            <div class="col-12 rs-field">
              <label for="f-message">Pesan <span aria-hidden="true">*</span></label>
              <textarea id="f-message" name="message" rows="5" required minlength="10" maxlength="1000" aria-describedby="e-message rs-count"></textarea>
              <div class="d-flex justify-content-between">
                <div class="rs-error" id="e-message"></div>
                <small class="rs-count" id="rs-count">0/1000</small>
              </div>
            </div>
          </div>

          <button type="submit" class="rs-btn rs-btn-primary w-100 mt-3" id="rsSubmit">
            <span class="rs-btn-label">Kirim Pesan</span> <?= icon('send') ?>
          </button>
          <p class="rs-privacy">Data Anda hanya dipakai untuk membalas pesan ini.</p>
        </form>
      </div>
    </div>
  </div>
</section>
