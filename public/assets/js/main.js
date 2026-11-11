/* Portofolio Rendi Suhendri — interaksi (vanilla JS, tanpa jQuery) */
(() => {
  'use strict';
  document.documentElement.classList.remove('no-js');
  const $ = (s, el = document) => el.querySelector(s);
  const $$ = (s, el = document) => [...el.querySelectorAll(s)];
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Analitik: hubungkan ke GA4/Umami di sini bila dipakai */
  const track = (name) => {
    if (window.gtag) window.gtag('event', name);
    if (window.umami) window.umami.track(name);
  };
  $$('[data-track]').forEach(el => el.addEventListener('click', () => track(el.dataset.track)));

  /* ---------- Navbar: latar saat scroll, progress, back-to-top ---------- */
  const nav = $('#rsNav'), bar = $('#rsProgress'), topBtn = $('#rsTop');
  const onScroll = () => {
    const y = scrollY;
    nav.classList.toggle('scrolled', y > 50);
    const h = document.documentElement.scrollHeight - innerHeight;
    bar.style.width = (h > 0 ? (y / h) * 100 : 0) + '%';
    topBtn.classList.toggle('show', y > 600);
  };
  addEventListener('scroll', onScroll, { passive: true });
  onScroll();
  topBtn.addEventListener('click', () => scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' }));

  /* Tutup menu mobile setelah klik */
  $$('#rsMenu a').forEach(a => a.addEventListener('click', () => {
    const menu = $('#rsMenu');
    if (menu.classList.contains('show') && window.bootstrap) bootstrap.Collapse.getOrCreateInstance(menu).hide();
  }));

  /* Scrollspy */
  const links = $$('.rs-menu .nav-link');
  const spy = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (!en.isIntersecting) return;
      links.forEach(l => l.classList.toggle('active', l.getAttribute('href') === '#' + en.target.id));
    });
  }, { rootMargin: '-45% 0px -50% 0px' });
  ['home', 'about', 'skills', 'projects', 'contact'].forEach(id => { const s = document.getElementById(id); if (s) spy.observe(s); });

  /* ---------- Split hero ---------- */
  const hero = $('#home'), photo = $('#rsPhoto'), hint = $('#rsHint'), bgNet = $('#bgNet'), bgCode = $('#bgCode');
  if (hero && photo) {
    let target = 50, current = 50, lastMove = -1e9, visible = true;
    const setFromX = (x) => {
      const r = photo.getBoundingClientRect();
      const ratio = (x - r.left) / r.width;
      target = Math.min(85, Math.max(15, 50 + (0.5 - ratio) * 70));
      lastMove = performance.now();
      hint.style.opacity = 0;
    };
    hero.addEventListener('mousemove', e => setFromX(e.clientX));
    hero.addEventListener('mouseleave', () => { lastMove = -1e9; });
    photo.addEventListener('touchstart', e => setFromX(e.touches[0].clientX), { passive: true });
    photo.addEventListener('touchmove', e => setFromX(e.touches[0].clientX), { passive: true });
    new IntersectionObserver(([en]) => { visible = en.isIntersecting; if (visible) requestAnimationFrame(frame); }).observe(hero);

    function frame(t) {
      if (!visible) return;
      if (t - lastMove > 2500) target = reduce ? 50 : 50 + Math.sin(t / 1400) * 7;
      current += (target - current) * 0.12;
      photo.style.setProperty('--split', current.toFixed(2) + '%');
      const lean = current - 50;
      /* Intensitas efek "mode coder": tipis saat diam, penuh saat digeser ke sisi coder */
      photo.style.setProperty('--fx', (0.25 + 0.75 * Math.min(1, Math.max(0, -lean / 30))).toFixed(2));
      hero.classList.toggle('lean-left', lean > 9);
      hero.classList.toggle('lean-right', lean < -9);
      bgNet.style.opacity = (0.42 + lean / 70).toFixed(2);
      bgCode.style.opacity = (0.28 - lean / 140).toFixed(2);
      requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  /* ---------- Typing effect ---------- */
  const typing = $('#rsTyping');
  if (typing && !reduce) {
    let words = [];
    try { words = JSON.parse(typing.dataset.words); } catch (_) {}
    if (words.length) {
      let w = 0, i = 0, del = false;
      const tick = () => {
        const word = words[w];
        typing.textContent = word.slice(0, i);
        if (!del && i < word.length) { i++; setTimeout(tick, 80); }
        else if (!del) { del = true; setTimeout(tick, 1800); }
        else if (i > 0) { i--; setTimeout(tick, 40); }
        else { del = false; w = (w + 1) % words.length; setTimeout(tick, 300); }
      };
      tick();
    }
  }

  /* ---------- Reveal on scroll + count-up + terminal ---------- */
  const once = (el, fn, opts = { threshold: 0.15 }) => {
    const io = new IntersectionObserver(([en]) => { if (en.isIntersecting) { fn(); io.disconnect(); } }, opts);
    io.observe(el);
  };
  if (reduce) $$('.reveal').forEach(el => el.classList.add('in'));
  else {
    const io = new IntersectionObserver(entries => entries.forEach(en => {
      if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
    }), { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    $$('.reveal').forEach(el => io.observe(el));
  }

  $$('[data-count]').forEach(el => {
    if (reduce) return;
    const end = +el.dataset.count;
    el.textContent = '0';
    once(el, () => {
      const t0 = performance.now();
      const step = (t) => {
        const p = Math.min(1, (t - t0) / 1500);
        el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3)));
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    });
  });

  const term = $('#rsTerminal');
  if (term) {
    let lines = [];
    try { lines = JSON.parse(term.dataset.lines); } catch (_) {}
    const render = (n, partial) => {
      term.innerHTML = '';
      lines.slice(0, n).forEach(([txt, cls]) => {
        const s = document.createElement('span'); s.className = cls; s.textContent = txt + '\n'; term.appendChild(s);
      });
      if (partial) { const s = document.createElement('span'); s.className = partial[1]; s.textContent = partial[0]; term.appendChild(s); }
      const cur = document.createElement('span'); cur.className = 'cur'; term.appendChild(cur);
    };
    if (reduce) render(lines.length);
    else once(term, () => {
      let n = 0, c = 0;
      const step = () => {
        if (n >= lines.length) return render(lines.length);
        const [txt, cls] = lines[n];
        if (cls === 'cmd' && c < txt.length) { c++; render(n, [txt.slice(0, c), cls]); setTimeout(step, 45); }
        else { n++; c = 0; render(n); setTimeout(step, cls === 'cmd' ? 250 : 400); }
      };
      render(0); setTimeout(step, 400);
    }, { threshold: 0.4 });
  }

  /* ---------- Filter (tech & proyek) ---------- */
  $$('[data-filter-group]').forEach(group => {
    const name = group.dataset.filterGroup;
    const wrap = $(`[data-filter-target="${name}"]`);
    const chips = $$('.rs-chip', group);
    chips.forEach(chip => chip.addEventListener('click', () => {
      chips.forEach(c => { c.classList.toggle('active', c === chip); c.setAttribute('aria-pressed', c === chip); });
      const f = chip.dataset.filter;
      let shown = 0;
      $$('.rs-filter-item', wrap).forEach(item => {
        const match = f === 'all' || item.dataset.cat === f;
        const extraHidden = item.classList.contains('is-extra') && !wrap.classList.contains('show-all') && f === 'all';
        const show = match && !extraHidden;
        if (show) shown++;
        if (reduce) { item.classList.toggle('d-none', !show); return; }
        if (show) {
          item.classList.remove('d-none'); item.classList.add('is-hiding');
          requestAnimationFrame(() => requestAnimationFrame(() => item.classList.remove('is-hiding')));
        } else {
          item.classList.add('is-hiding');
          setTimeout(() => item.classList.add('d-none'), 250);
        }
      });
      const empty = $('#rsEmpty', wrap);
      if (empty) empty.classList.toggle('d-none', shown > 0);
    }));
  });

  const more = $('#rsMore');
  if (more) more.addEventListener('click', () => {
    const wrap = $('[data-filter-target="projects"]');
    wrap.classList.add('show-all');
    $$('.is-extra', wrap).forEach(el => el.classList.remove('d-none'));
    more.remove();
  });

  /* ---------- Modal detail proyek ---------- */
  let projects = [];
  try { projects = JSON.parse($('#rsProjectsData')?.textContent || '[]'); } catch (_) {}
  const modalEl = $('#rsProjectModal');
  const esc = (s) => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

  $$('[data-project]').forEach(btn => btn.addEventListener('click', () => {
    const p = projects.find(x => x.id === btn.dataset.project);
    if (!p || !window.bootstrap) return;
    track('open_project');
    $('#rsModalTitle').textContent = p.title;

    const imgs = (p.gallery && p.gallery.length) ? p.gallery : [p.thumbnail];
    const media = $('#rsModalMedia');
    if (imgs.length > 1) {
      media.innerHTML = `<div id="rsCarousel" class="carousel slide"><div class="carousel-inner">${
        imgs.map((src, i) => `<div class="carousel-item${i ? '' : ' active'}"><img src="${esc(src)}" alt="Tangkapan layar ${i + 1} ${esc(p.title)}" loading="lazy"></div>`).join('')
      }</div><button class="carousel-control-prev" type="button" data-bs-target="#rsCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Sebelumnya</span></button>
      <button class="carousel-control-next" type="button" data-bs-target="#rsCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Berikutnya</span></button></div>`;
    } else {
      media.innerHTML = `<img src="${esc(imgs[0])}" alt="${esc(p.title)}">`;
    }

    const meta = [['Kategori', p.category_label], ['Tahun', p.year], ['Peran', p.role], ['Klien', p.client]].filter(m => m[1]);
    $('#rsModalMeta').innerHTML = meta.map(([k, v]) => `<div><dt>${k}</dt><dd>${esc(v)}</dd></div>`).join('');

    const psr = [['Masalah', p.problem], ['Solusi', p.solution], ['Hasil', p.result]].filter(m => m[1]);
    $('#rsModalPsr').innerHTML = (p.placeholder ? '<div class="rs-note" style="border-left:1px solid rgba(251,191,36,.3)">Ini proyek contoh. Ganti dengan proyek nyata di data/projects.json.</div>' : '') +
      psr.map(([k, v]) => `<div><b>${k}</b><p>${esc(v)}</p></div>`).join('');

    $('#rsModalTech').innerHTML = (p.tech || []).map(t => `<span>${esc(t)}</span>`).join('');
    const ic = (n) => `<svg class="ic" aria-hidden="true"><use href="#i-${n}"/></svg>`;
    $('#rsModalLinks').innerHTML =
      (p.demo_url ? `<a class="rs-btn rs-btn-primary" href="${esc(p.demo_url)}" target="_blank" rel="noopener noreferrer">${ic('external')} Live Demo</a>` : '') +
      (p.repo_url ? `<a class="rs-btn rs-btn-outline" href="${esc(p.repo_url)}" target="_blank" rel="noopener noreferrer">${ic('code')} Lihat Kode</a>` : '');

    bootstrap.Modal.getOrCreateInstance(modalEl).show();
  }));

  /* Tooltip tech stack */
  const initTooltips = () => window.bootstrap && $$('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
  if (window.bootstrap) initTooltips(); else addEventListener('load', initTooltips);

  /* ---------- Form kontak ---------- */
  const form = $('#rsForm');
  if (form) {
    const msg = $('#f-message'), count = $('#rs-count');
    const updateCount = () => { count.textContent = `${msg.value.length}/1000`; };
    msg.addEventListener('input', updateCount); updateCount();

    const rules = {
      name: v => v.trim().length >= 2 && v.trim().length <= 80 ? '' : 'Nama harus 2–80 karakter.',
      email: v => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()) ? '' : 'Format email tidak valid.',
      service: v => v ? '' : 'Pilih jenis layanan.',
      message: v => v.trim().length >= 10 && v.trim().length <= 1000 ? '' : 'Pesan harus 10–1000 karakter.',
    };
    const setError = (name, text) => {
      const field = form.elements[name];
      field.closest('.rs-field').classList.toggle('has-error', !!text);
      field.setAttribute('aria-invalid', text ? 'true' : 'false');
      $('#e-' + name).textContent = text || '';
    };
    const validate = (name) => { const err = rules[name](form.elements[name].value); setError(name, err); return !err; };
    Object.keys(rules).forEach(n => {
      form.elements[n].addEventListener('blur', () => validate(n));
      form.elements[n].addEventListener('input', () => { if (form.elements[n].closest('.has-error')) validate(n); });
    });

    const toast = $('#rsToast');
    const showToast = (text, ok) => {
      toast.textContent = text;
      toast.className = 'rs-toast show ' + (ok ? 'is-ok' : 'is-err');
      clearTimeout(showToast.t); showToast.t = setTimeout(() => toast.classList.remove('show'), 5000);
    };

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const ok = Object.keys(rules).map(validate).every(Boolean);
      if (!ok) { form.querySelector('[aria-invalid="true"]')?.focus(); return; }

      const btn = $('#rsSubmit'), oldHTML = btn.innerHTML;
      btn.disabled = true;
      btn.innerHTML = '<span class="rs-spinner" aria-hidden="true"></span> Mengirim…';
      try {
        const res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { Accept: 'application/json' } });
        const data = await res.json().catch(() => ({ success: false, message: 'Terjadi kesalahan server.' }));
        if (data.errors) Object.entries(data.errors).forEach(([k, v]) => setError(k, v));
        if (data.success) { form.reset(); updateCount(); track('contact_submit'); }
        showToast(data.message || (data.success ? 'Pesan terkirim!' : 'Pesan gagal dikirim.'), data.success);
      } catch (_) {
        showToast('Koneksi gagal. Coba lagi atau hubungi via WhatsApp.', false);
      } finally {
        btn.disabled = false; btn.innerHTML = oldHTML;
      }
    });
  }
})();
