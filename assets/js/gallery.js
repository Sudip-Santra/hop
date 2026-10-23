// Gallery page: filter, videos that play only while on screen, and a lightbox.

const items = [...document.querySelectorAll('.g-item')];
const reduceMotion = () => matchMedia('(prefers-reduced-motion: reduce)').matches;

// ---------- Masonry: each tile goes into whichever column is shortest, Pinterest-style.
// Tile heights are known from their shape, so this runs before any image has loaded.
// Without this script the grid falls back to CSS columns.
const grid = document.querySelector('.g-grid');
const tall = { tall: 16 / 9, portrait: 5 / 4, classic: 4 / 3, square: 1 };
const columnCount = () => (innerWidth <= 560 ? 2 : innerWidth <= 900 ? 3 : 4);
let cols = 0;

function layout() {
  cols = columnCount();
  const columns = Array.from({ length: cols }, () => {
    const c = document.createElement('div');
    c.className = 'g-col';
    return c;
  });
  const heights = new Array(cols).fill(0);
  const last = new Array(cols).fill('');
  items.forEach((it) => {
    if (it.hidden) { columns[0].appendChild(it); return; }
    // Shortest column first, but never straight under the same piece
    const order = heights.map((h, i) => i).sort((a, b) => heights[a] - heights[b]);
    const i = order.find((c) => last[c] !== it.dataset.file) ?? order[0];
    columns[i].appendChild(it);
    heights[i] += tall[it.dataset.shape] + 0.05; // + the gap, in column widths
    last[i] = it.dataset.file;
  });
  grid.replaceChildren(...columns);
  grid.classList.add('is-masonry');
}
layout();
addEventListener('resize', () => { if (columnCount() !== cols) layout(); });

// ---------- Filter: All / Photos / Videos
document.querySelectorAll('.g-filter input').forEach((input) => {
  input.addEventListener('change', () => {
    items.forEach((it) => { it.hidden = input.value !== 'all' && it.dataset.type !== input.value; });
    layout();
  });
});

// ---------- Grid videos: load and play only while in view, so the page stays light
const videoWatch = new IntersectionObserver((entries) => {
  entries.forEach(({ target: v, isIntersecting }) => {
    if (isIntersecting && !reduceMotion()) v.play().catch(() => {});
    else v.pause();
  });
}, { rootMargin: '120px 0px' });
document.querySelectorAll('.g-item video').forEach((v) => videoWatch.observe(v));

// ---------- Lightbox
const box = document.getElementById('g-box');
const stage = document.getElementById('g-box-stage');
const nameEl = document.getElementById('g-box-name');
const noteEl = document.getElementById('g-box-note');
const countEl = document.getElementById('g-box-count');
let current = 0, opener = null;

// Only the pieces the filter is showing take part, in grid order
const visible = () => items.filter((it) => !it.hidden);

function show(li) {
  const list = visible();
  current = list.indexOf(li);
  const media = li.querySelector('video, img');
  const cap = li.querySelector('.g-cap');
  stage.innerHTML = '';
  let el;
  if (media.tagName === 'VIDEO') {
    el = document.createElement('video');
    Object.assign(el, { src: media.src, poster: media.poster, muted: true, loop: true, playsInline: true, controls: true, autoplay: !reduceMotion() });
  } else {
    el = document.createElement('img');
    Object.assign(el, { src: media.src, alt: media.alt });
  }
  stage.appendChild(el);
  nameEl.textContent = cap.querySelector('b').textContent;
  noteEl.textContent = cap.querySelector('.label').textContent;
  countEl.textContent = `${current + 1} / ${list.length}`;
}

const step = (d) => {
  const list = visible();
  show(list[(current + d + list.length) % list.length]);
};

document.querySelector('.g-grid').addEventListener('click', (e) => {
  const btn = e.target.closest('.g-open');
  if (!btn) return;
  opener = btn;
  show(btn.closest('.g-item'));
  box.showModal();
});
document.getElementById('g-box-prev').addEventListener('click', () => step(-1));
document.getElementById('g-box-next').addEventListener('click', () => step(1));
document.getElementById('g-box-close').addEventListener('click', () => box.close());
box.addEventListener('click', (e) => { if (e.target === box) box.close(); }); // the dimmed edge
box.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowLeft') step(-1);
  if (e.key === 'ArrowRight') step(1);
});
box.addEventListener('close', () => { stage.innerHTML = ''; opener?.focus(); });
