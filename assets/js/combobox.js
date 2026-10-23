// Searchable dropdown (ARIA combobox): type to filter, arrow keys to move, Enter or click to pick.
// window.hopCombo(input, { free }) returns { setItems, setStatus, has }.
//   free: true lets the typed text stand even when it isn't in the list (cities).
// The input names its list with aria-controls; the list is a <ul role="listbox">.
(() => {
  const norm = (s) => s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase().trim();
  const MAX = 80; // options drawn at once; typing narrows the rest

  window.hopCombo = (input, { free = false } = {}) => {
    const list = document.getElementById(input.getAttribute('aria-controls'));
    let items = [], shown = [], active = -1, status = '';

    function render() {
      const q = norm(input.value);
      const starts = [], contains = [];
      items.forEach((it) => { const n = norm(it); if (n.startsWith(q)) starts.push(it); else if (n.includes(q)) contains.push(it); });
      shown = starts.concat(contains).slice(0, MAX);
      active = shown.length ? 0 : -1;
      list.innerHTML = '';
      if (status) {
        list.innerHTML = `<li class="co-opt-note"></li>`;
        list.firstChild.textContent = status;
        return;
      }
      shown.forEach((it, i) => {
        const li = document.createElement('li');
        li.id = `${list.id}-${i}`;
        li.setAttribute('role', 'option');
        li.textContent = it;
        li.addEventListener('mousedown', (e) => { e.preventDefault(); choose(it); });
        list.appendChild(li);
      });
      if (!shown.length) {
        const li = document.createElement('li');
        li.className = 'co-opt-note';
        li.textContent = free && input.value.trim() ? `Use “${input.value.trim()}”` : 'No matches';
        if (free && input.value.trim()) li.addEventListener('mousedown', (e) => { e.preventDefault(); close(); });
        list.appendChild(li);
      }
      mark();
    }
    function mark() {
      [...list.querySelectorAll('[role=option]')].forEach((li, i) => li.setAttribute('aria-selected', i === active ? 'true' : 'false'));
      const el = list.querySelector('[aria-selected=true]');
      if (el) { input.setAttribute('aria-activedescendant', el.id); el.scrollIntoView({ block: 'nearest' }); }
      else input.removeAttribute('aria-activedescendant');
    }
    function open() { if (input.disabled) return; render(); list.hidden = false; input.setAttribute('aria-expanded', 'true'); }
    function close() { list.hidden = true; input.setAttribute('aria-expanded', 'false'); input.removeAttribute('aria-activedescendant'); }
    function choose(value) {
      input.value = value;
      close();
      input.dispatchEvent(new Event('change', { bubbles: true }));
    }
    // An exact (accent- and case-blind) match counts as picking that option
    const match = () => items.find((it) => norm(it) === norm(input.value));

    input.addEventListener('focus', open);
    input.addEventListener('click', open);
    input.addEventListener('input', () => { if (list.hidden) open(); else render(); });
    input.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
        e.preventDefault();
        if (list.hidden) return open();
        if (!shown.length) return;
        active = (active + (e.key === 'ArrowDown' ? 1 : -1) + shown.length) % shown.length;
        mark();
      } else if (e.key === 'Enter' && !list.hidden) {
        e.preventDefault();
        if (active >= 0 && shown[active]) choose(shown[active]); else close();
      } else if (e.key === 'Escape' && !list.hidden) {
        e.preventDefault(); close();
      } else if (e.key === 'Tab' && !list.hidden && active >= 0 && input.value.trim() && shown[active]) {
        choose(shown[active]);
      }
    });
    input.addEventListener('blur', () => {
      close();
      const m = match();
      if (m && m !== input.value) choose(m);
      else if (!free && input.value && !m && items.length) input.value = '';
    });

    return {
      setItems(next) { items = next; status = ''; if (!list.hidden) render(); },
      setStatus(text) { status = text; if (!list.hidden) render(); },
      has: (value) => items.some((it) => norm(it) === norm(value)),
      count: () => items.length,
    };
  };
})();
