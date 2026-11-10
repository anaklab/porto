<nav class="navbar navbar-expand-lg rs-nav fixed-top" id="rsNav" aria-label="Navigasi utama">
  <div class="container">
    <a class="rs-logo" href="#home">&lt;RS/&gt; <span><?= e($cfg['name']) ?></span></a>
    <button class="rs-burger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#rsMenu"
            aria-controls="rsMenu" aria-expanded="false" aria-label="Buka menu">
      <?= icon('menu') ?>
    </button>
    <div class="collapse navbar-collapse" id="rsMenu">
      <ul class="navbar-nav ms-auto align-items-lg-center rs-menu">
        <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#skills">Keahlian</a></li>
        <li class="nav-item"><a class="nav-link" href="#projects">Proyek</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="rs-btn rs-btn-primary rs-btn-sm" href="#contact">Hubungi Saya</a></li>
      </ul>
    </div>
  </div>
  <div class="rs-progress" id="rsProgress" aria-hidden="true"></div>
</nav>
