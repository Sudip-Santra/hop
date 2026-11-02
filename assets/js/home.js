// Home page: the closing card tilts toward the pointer, so the light moves over its pressed letters.
// Mouse and trackpad only; visitors who ask for less motion keep it still.

const card = document.getElementById('px-card');
if (card && matchMedia('(pointer: fine)').matches && !matchMedia('(prefers-reduced-motion: reduce)').matches) {
  card.addEventListener('pointermove', (e) => {
    const r = card.getBoundingClientRect();
    const x = (e.clientX - r.left) / r.width - 0.5;
    const y = (e.clientY - r.top) / r.height - 0.5;
    card.style.setProperty('--ry', `${x * 12}deg`);
    card.style.setProperty('--rx', `${-y * 12}deg`);
  });
  card.addEventListener('pointerleave', () => {
    card.style.removeProperty('--rx');
    card.style.removeProperty('--ry');
  });
}
