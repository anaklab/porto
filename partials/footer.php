</main>

<footer class="rs-footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-5">
        <a class="rs-logo" href="#home">&lt;RS/&gt; <span><?= e($cfg['name']) ?></span></a>
        <p class="mt-3 mb-0"><?= e($cfg['role']) ?>.<br>Dari kode sampai kabel.</p>
      </div>
      <div class="col-6 col-md-3">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#skills">Keahlian</a></li>
          <li><a href="#projects">Proyek</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </div>
      <div class="col-6 col-md-4">
        <h4>Terhubung</h4>
        <div class="rs-social justify-content-start mt-0">
          <a href="<?= e($cfg['github']) ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><?= icon('github') ?></a>
          <?php if ($cfg['linkedin']): ?><a href="<?= e($cfg['linkedin']) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><?= icon('linkedin') ?></a><?php endif; ?>
          <a href="<?= e(wa_link($cfg)) ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><?= icon('whatsapp') ?></a>
          <a href="mailto:<?= e($cfg['email']) ?>" aria-label="Email"><?= icon('mail') ?></a>
        </div>
      </div>
    </div>
    <div class="rs-footer-bottom">
      © <?= date('Y') ?> <?= e($cfg['name']) ?>. Dibangun dengan HTML, CSS, JavaScript, Bootstrap &amp; PHP.
    </div>
  </div>
</footer>

<button type="button" class="rs-top" id="rsTop" aria-label="Kembali ke atas"><?= icon('up') ?></button>
<div class="rs-toast" id="rsToast" role="status" aria-live="polite"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
<script src="assets/js/main.js?v=1" defer></script>
</body>
</html>
