/* Tema terang/gelap — dimuat di <head> tanpa defer agar tidak berkedip saat halaman dibuka */
(() => {
  'use strict';
  const KEY = 'rs-theme';
  const root = document.documentElement;
  const stored = () => { try { return localStorage.getItem(KEY); } catch (_) { return null; } };

  const apply = (theme) => {
    root.dataset.theme = theme;
    root.setAttribute('data-bs-theme', theme);
    const meta = document.querySelector('meta[name="theme-color"]');
    if (meta) meta.content = theme === 'light' ? '#F8FAFC' : '#0B1120';
    document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
      const next = theme === 'light' ? 'gelap' : 'terang';
      btn.setAttribute('aria-label', 'Ganti ke tema ' + next);
      btn.setAttribute('title', 'Tema ' + next);
    });
  };

  /* Default selalu gelap; tema terang hanya jika pengunjung memilihnya lewat tombol */
  apply(stored() || 'dark');

  document.addEventListener('DOMContentLoaded', () => {
    apply(root.dataset.theme);
    document.querySelectorAll('[data-theme-toggle]').forEach(btn => btn.addEventListener('click', () => {
      const next = root.dataset.theme === 'light' ? 'dark' : 'light';
      try { localStorage.setItem(KEY, next); } catch (_) {}
      apply(next);
    }));
  });
})();
