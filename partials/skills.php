<?php
$skills = require ROOT . '/data/skills.php';
$cats = ['all' => 'Semua', 'programming' => 'Programming', 'networking' => 'Networking', 'tools' => 'Tools'];
?>
<section class="rs-section rs-section-alt" id="skills" aria-labelledby="skillsTitle">
  <div class="container">
    <div class="rs-heading reveal">
      <p class="rs-eyebrow">// keahlian</p>
      <h2 id="skillsTitle">Apa yang Bisa Saya Kerjakan</h2>
      <p class="rs-sub">Satu orang untuk aplikasinya dan jaringannya, sehingga Anda tidak perlu mengurus dua vendor.</p>
    </div>

    <div class="row g-4">
      <?php foreach ($skills['services'] as $i => $s): ?>
      <div class="col-md-6 reveal" style="--d:<?= $i * 80 ?>ms">
        <article class="rs-card rs-service <?= $s['icon'] === 'network' ? 'is-net' : '' ?>">
          <div class="rs-service-icon"><?= icon($s['icon']) ?></div>
          <h3><?= e($s['title']) ?></h3>
          <p><?= e($s['desc']) ?></p>
          <div class="rs-tags"><?php foreach ($s['tags'] as $t): ?><span>#<?= e($t) ?></span><?php endforeach; ?></div>
        </article>
      </div>
      <?php endforeach; ?>
    </div>

    <h3 class="rs-subheading reveal">Tech Stack</h3>
    <div class="rs-chips reveal" role="group" aria-label="Filter tech stack" data-filter-group="tech">
      <?php foreach ($cats as $k => $label): ?>
        <button type="button" class="rs-chip<?= $k === 'all' ? ' active' : '' ?>" data-filter="<?= e($k) ?>" aria-pressed="<?= $k === 'all' ? 'true' : 'false' ?>"><?= e($label) ?></button>
      <?php endforeach; ?>
    </div>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-3" data-filter-target="tech">
      <?php foreach ($skills['tech'] as $t): ?>
      <div class="col rs-filter-item" data-cat="<?= e($t['cat']) ?>">
        <div class="rs-tech" style="--brand:<?= e($t['color']) ?>" tabindex="0" title="<?= e($t['use']) ?>" data-bs-toggle="tooltip">
          <div class="rs-tech-logo" aria-hidden="true"><?= e($t['abbr']) ?></div>
          <div class="rs-tech-name"><?= e($t['name']) ?></div>
          <?php if (!empty($t['level'])): ?>
            <div class="rs-level" aria-label="Tingkat: <?= e(LEVEL_LABEL[$t['level']]) ?>">
              <?php for ($n = 1; $n <= 3; $n++): ?><i class="<?= $n <= $t['level'] ? 'on' : '' ?>"></i><?php endfor; ?>
            </div>
            <div class="rs-level-text"><?= e(LEVEL_LABEL[$t['level']]) ?></div>
          <?php else: ?>
            <div class="rs-level-text"><?= e(ucfirst($t['cat'])) ?></div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
