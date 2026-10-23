// Contact page: enquiry form -> WhatsApp message.
// Needs WHATSAPP from main.js.

const form = document.getElementById('contact-form');
const plural = (n, word) => `${n} ${word}${n === 1 ? '' : 's'}`;

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const f = new FormData(form);
  const val = (k) => (f.get(k) || '').toString().trim();
  if (!val('name') || !val('phone')) {
    form.querySelector(val('name') ? '[name=phone]' : '[name=name]').focus();
    return;
  }
  const date = val('date') ? new Date(val('date') + 'T00:00').toLocaleDateString('en-IN', { day: 'numeric', month: 'short', year: 'numeric' }) : '';
  const lines = [
    `Hi House of Press, I'm ${val('name')} (${val('phone')}).`,
    `Looking for: ${val('type')}`,
    f.getAll('finishes').length && `Finishes: ${f.getAll('finishes').join(', ')}`,
    `Quantity: ${val('qty')}`,
    date && `Needed by: ${date}`,
    val('area') && `City: ${val('area')}`,
    val('need') && `\nDetails:\n${val('need')}`,
    '\nPlease share options and pricing.',
  ].filter(Boolean);
  window.open(`https://wa.me/${WHATSAPP}?text=${encodeURIComponent(lines.join('\n'))}`, '_blank', 'noopener');
});

const reduceMotion = () => matchMedia('(prefers-reduced-motion: reduce)').matches;

// ---------- Date picker ("Needed by"): sharp custom calendar, past days disabled
(() => {
  const btn = document.getElementById('dp-btn');
  const pop = document.getElementById('dp-pop');
  const grid = document.getElementById('dp-grid');
  const text = document.getElementById('dp-text');
  const value = document.getElementById('dp-value');
  const prev = document.getElementById('dp-prev');
  const iso = (d) => `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
  const today = new Date(); today.setHours(0, 0, 0, 0);
  let view = new Date(today.getFullYear(), today.getMonth(), 1);
  let selected = null;
  let focusDate = today;

  function render() {
    document.getElementById('dp-month').textContent = view.toLocaleDateString('en-IN', { month: 'long', year: 'numeric' });
    prev.disabled = view <= new Date(today.getFullYear(), today.getMonth(), 1);
    grid.innerHTML = '';
    const start = new Date(view);
    start.setDate(1 - ((view.getDay() + 6) % 7)); // back to Monday
    for (let i = 0; i < 42; i++) {
      const d = new Date(start); d.setDate(start.getDate() + i);
      const b = document.createElement('button');
      b.type = 'button';
      b.textContent = d.getDate();
      b.dataset.date = iso(d);
      b.tabIndex = iso(d) === iso(focusDate) ? 0 : -1;
      b.setAttribute('aria-label', d.toLocaleDateString('en-IN', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }));
      b.setAttribute('aria-selected', selected && iso(d) === iso(selected) ? 'true' : 'false');
      if (d < today) b.disabled = true;
      if (d.getMonth() !== view.getMonth()) b.classList.add('out');
      if (iso(d) === iso(today)) b.classList.add('today');
      grid.appendChild(b);
    }
  }
  function choose(d) {
    selected = d;
    value.value = d ? iso(d) : '';
    text.textContent = d ? d.toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' }) : 'Pick a date';
    text.classList.toggle('is-empty', !d);
  }
  function open() {
    focusDate = selected || today;
    view = new Date(focusDate.getFullYear(), focusDate.getMonth(), 1);
    render();
    pop.hidden = false;
    btn.setAttribute('aria-expanded', 'true');
    grid.querySelector('[tabindex="0"]')?.focus();
  }
  function close(refocus) {
    pop.hidden = true;
    btn.setAttribute('aria-expanded', 'false');
    if (refocus) btn.focus();
  }
  function moveFocus(days, months = 0) {
    const d = new Date(focusDate);
    if (months) d.setMonth(d.getMonth() + months); else d.setDate(d.getDate() + days);
    if (d < today) return;
    focusDate = d;
    view = new Date(d.getFullYear(), d.getMonth(), 1);
    render();
    grid.querySelector('[tabindex="0"]')?.focus();
  }

  btn.addEventListener('click', () => (pop.hidden ? open() : close(true)));
  prev.addEventListener('click', () => { view.setMonth(view.getMonth() - 1); render(); });
  document.getElementById('dp-next').addEventListener('click', () => { view.setMonth(view.getMonth() + 1); render(); });
  document.getElementById('dp-today').addEventListener('click', () => { choose(today); close(true); });
  document.getElementById('dp-clear').addEventListener('click', () => { choose(null); close(true); });
  grid.addEventListener('click', (e) => {
    const b = e.target.closest('button');
    if (!b || b.disabled) return;
    choose(new Date(b.dataset.date + 'T00:00'));
    close(true);
  });
  grid.addEventListener('keydown', (e) => {
    const keys = { ArrowLeft: [-1], ArrowRight: [1], ArrowUp: [-7], ArrowDown: [7], PageUp: [0, -1], PageDown: [0, 1] };
    if (keys[e.key]) { e.preventDefault(); moveFocus(...keys[e.key]); }
  });
  pop.addEventListener('keydown', (e) => { if (e.key === 'Escape') { e.stopPropagation(); close(true); } });
  document.addEventListener('click', (e) => { if (!pop.hidden && !e.target.closest('#dp')) close(false); });
})();
