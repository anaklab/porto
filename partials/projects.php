<?php
$projects = load_projects();
$counts = ['all' => count($projects)];
foreach ($projects as $p) $counts[$p['category']] = ($counts[$p['category']] ?? 0) + 1;
$filters = ['all' => 'Semua'] + CATEGORY_LABEL;
$INITIAL = 6;
?>
<section class="rs-section" id="projects" aria-labelledby="projectsTitle">
  <div class="container">
    <div class="rs-heading reveal">
      <p class="rs-eyebrow">// portofolio</p>
      <h2 id="projectsTitle">Proyek Terbaru</h2>
      <p class="rs-sub">Beberapa pekerjaan yang pernah saya bangun dan konfigurasi.</p>
    </div>

    <div class="rs-chips rs-chips-scroll reveal" role="group" aria-label="Filter proyek" data-filter-group="projects">
      <?php foreach ($filters as $k => $label): if ($k !== 'all' && empty($counts[$k])) continue; ?>
        <button type="button" class="rs-chip<?= $k === 'all' ? ' active' : '' ?>" data-filter="<?= e($k) ?>" aria-pressed="<?= $k === 'all' ? 'true' : 'false' ?>">
          <?= e($label) ?> <small>(<?= (int) ($counts[$k] ?? 0) ?>)</small>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="row g-4" data-filter-target="projects">
      <?php foreach ($projects as $i => $p):
        $cat = $p['category'];
        $more = count($p['tech']) - 4; ?>
      <div class="col-md-6 col-lg-4 rs-filter-item<?= $i >= $INITIAL ? ' is-extra d-none' : '' ?>" data-cat="<?= e($cat) ?>">
        <article class="rs-card rs-project <?= $cat === 'networking' ? 'is-net' : '' ?>">
          <button type="button" class="rs-project-thumb" data-project="<?= e($p['id']) ?>" aria-label="Lihat detail <?= e($p['title']) ?>">
            <img src="<?= e($p['thumbnail']) ?>" alt="" loading="lazy" width="800" height="450">
            <span class="rs-badge"><?= e(CATEGORY_LABEL[$cat] ?? $cat) ?></span>
            <?php if (!empty($p['placeholder'])): ?><span class="rs-badge rs-badge-demo">Contoh</span><?php endif; ?>
          </button>
          <div class="rs-project-body">
            <h3><?= e($p['title']) ?></h3>
            <p><?= e($p['summary']) ?></p>
            <div class="rs-tags">
              <?php foreach (array_slice($p['tech'], 0, 4) as $t): ?><span>#<?= e($t) ?></span><?php endforeach; ?>
              <?php if ($more > 0): ?><span>+<?= $more ?></span><?php endif; ?>
            </div>
            <div class="rs-project-actions">
              <button type="button" class="rs-link" data-project="<?= e($p['id']) ?>"><?= icon('info') ?> Detail</button>
              <?php if (!empty($p['demo_url'])): ?><a class="rs-link" href="<?= e($p['demo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= icon('external') ?> Demo</a><?php endif; ?>
              <?php if (!empty($p['repo_url'])): ?><a class="rs-link" href="<?= e($p['repo_url']) ?>" target="_blank" rel="noopener noreferrer"><?= icon('code') ?> Kode</a><?php endif; ?>
            </div>
          </div>
        </article>
      </div>
      <?php endforeach; ?>
      <div class="col-12 rs-empty d-none" id="rsEmpty"><p>Belum ada proyek di kategori ini.</p></div>
    </div>

    <div class="rs-cta mt-5 reveal">
      <?php if (count($projects) > $INITIAL): ?>
        <button type="button" class="rs-btn rs-btn-outline" id="rsMore">Muat lebih banyak</button>
      <?php endif; ?>
      <a class="rs-btn rs-btn-outline" href="<?= e($cfg['github']) ?>" target="_blank" rel="noopener noreferrer" data-track="github"><?= icon('github') ?> Lihat Semua Repositori di GitHub</a>
    </div>
  </div>

  <!-- Data proyek untuk modal -->
  <script type="application/json" id="rsProjectsData"><?= json_encode(array_map(fn($p) => $p + ['category_label' => CATEGORY_LABEL[$p['category']] ?? $p['category']], $projects), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>

  <div class="modal fade rs-modal" id="rsProjectModal" tabindex="-1" aria-labelledby="rsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="rsModalTitle"></h3>
          <button type="button" class="rs-close" data-bs-dismiss="modal" aria-label="Tutup"><?= icon('x') ?></button>
        </div>
        <div class="modal-body">
          <div class="rs-modal-media" id="rsModalMedia"></div>
          <dl class="rs-meta" id="rsModalMeta"></dl>
          <div class="rs-psr" id="rsModalPsr"></div>
          <div class="rs-tags rs-tags-lg" id="rsModalTech"></div>
          <div class="rs-cta justify-content-start mt-4" id="rsModalLinks"></div>
        </div>
      </div>
    </div>
  </div>
</section>
