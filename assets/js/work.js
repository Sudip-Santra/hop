// Home page, Fresh off the press: each print opens larger in the lightbox (the gallery page's),
// with previous / next and arrow keys. A tile's data-name and data-note fill the caption.

const tiles = [...document.querySelectorAll('.work-tile')];
const box = document.getElementById('g-box');
const stage = document.getElementById('g-box-stage');
const nameEl = document.getElementById('g-box-name');
const noteEl = document.getElementById('g-box-note');
const countEl = document.getElementById('g-box-count');
let current = 0, opener = null;

function show(i) {
  current = (i + tiles.length) % tiles.length;
  const tile = tiles[current];
  const src = tile.querySelector('img');
  const img = document.createElement('img');
  Object.assign(img, { src: src.src, alt: src.alt });
  stage.replaceChildren(img);
  nameEl.textContent = tile.dataset.name;
  noteEl.textContent = tile.dataset.note;
  countEl.textContent = `${current + 1} / ${tiles.length}`;
}

tiles.forEach((tile, i) => tile.addEventListener('click', () => {
  opener = tile;
  show(i);
  box.showModal();
}));
document.getElementById('g-box-prev').addEventListener('click', () => show(current - 1));
document.getElementById('g-box-next').addEventListener('click', () => show(current + 1));
document.getElementById('g-box-close').addEventListener('click', () => box.close());
box.addEventListener('click', (e) => { if (e.target === box) box.close(); }); // the dimmed edge
box.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowLeft') show(current - 1);
  if (e.key === 'ArrowRight') show(current + 1);
});
box.addEventListener('close', () => { stage.replaceChildren(); opener?.focus(); });
