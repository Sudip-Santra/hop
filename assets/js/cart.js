// Cart on every page: floating button, right-hand drawer, saved in this browser.
// Other scripts use window.hopCart: add(), lines(), totals(), clear(), open(), describe(), price(),
// colours(), and note()/setNote() for the order's note to the studio.
(() => {
  const config = JSON.parse(document.getElementById('hop-prices').textContent);
  const STORE = 'hop-cart';
  const rupees = (n) => '₹' + n.toLocaleString('en-IN');

  // A line is one choice of card: { qty: 100, colors: 1, design: false }. The quantity is the number
  // of cards; colors is 1 or 2 inks (same price). Older saved carts may carry a sets count (dropped
  // here) or no colors (read as 1).
  const load = (raw) => (JSON.parse(raw) || []).filter((l) => config.cards[l.qty])
    .map(({ qty, colors, design }) => ({ qty, colors: colors === 2 ? 2 : 1, design }));
  let lines = [];
  try { lines = load(localStorage.getItem(STORE)); } catch {}
  const save = () => { try { localStorage.setItem(STORE, JSON.stringify(lines)); } catch {} };

  // The design uploaded on the business cards page, kept in this tab by product.js:
  // { name, type, data } with data as a data: URL. It goes on every own-artwork card.
  const art = () => { try { return JSON.parse(sessionStorage.getItem('hop-art')); } catch { return null; } };

  // One note for the whole order, written on the business cards page and sent with the order
  const NOTE = 'hop-note';
  const note = () => { try { return localStorage.getItem(NOTE) || ''; } catch { return ''; } };
  const setNote = (v) => { try { v.trim() ? localStorage.setItem(NOTE, v) : localStorage.removeItem(NOTE); } catch {} };

  const price = (l) => config.cards[l.qty] + (l.design ? config.design : 0);
  const colours = (l) => (l.colors === 2 ? '2 colours' : '1 colour');
  const describe = (l) => `${l.qty} cards - ${colours(l)} - ${l.design ? 'Studio design' : 'Your artwork'}`;
  const totals = () => ({
    count: lines.length,
    total: lines.reduce((n, l) => n + price(l), 0),
  });

  const fab = document.getElementById('cart-fab');
  const drawer = document.getElementById('cart');
  const scrim = document.getElementById('cart-scrim');
  const list = document.getElementById('cart-list');
  const listeners = [];

  function render() {
    const { count, total } = totals();
    document.getElementById('cart-count').textContent = count;
    document.getElementById('cart-total').textContent = rupees(total);
    document.getElementById('cart-empty').hidden = lines.length > 0;
    document.getElementById('cart-foot').hidden = lines.length === 0;
    fab.classList.toggle('show', lines.length > 0 || drawer.classList.contains('open'));

    list.innerHTML = '';
    const a = art();
    lines.forEach((l, i) => {
      const li = document.createElement('li');
      li.className = 'cart-item';
      li.innerHTML = `
        <div class="ci-body"><h3>Letterpress business cards</h3><p class="ci-meta"></p><p class="ci-file" hidden></p><b class="ci-price"></b></div>
        <div class="ci-act">
          <button type="button" class="ci-del" aria-label="Remove"><svg class="i" aria-hidden="true"><use href="#i-trash-2"/></svg></button>
        </div>`;
      // The numbers in mono (.num), the words around them in the body font
      li.querySelector('.ci-meta').innerHTML = `<b class="num">${l.qty}</b> cards · <b class="num">${l.colors}</b> ${l.colors === 2 ? 'colours' : 'colour'} · ${l.design ? 'Studio design' : 'Your artwork'}`;
      li.querySelector('.ci-price').textContent = rupees(price(l));
      // Own artwork with an upload: a thumbnail of it (a file icon for a PDF) and its name
      if (!l.design && a) {
        const thumb = document.createElement('span');
        thumb.className = 'ci-art';
        if (a.type.startsWith('image/')) {
          const img = document.createElement('img');
          img.src = a.data;
          img.alt = '';
          thumb.appendChild(img);
        } else {
          thumb.innerHTML = '<svg class="i" aria-hidden="true"><use href="#i-file"/></svg>';
        }
        li.prepend(thumb);
        const file = li.querySelector('.ci-file');
        file.textContent = a.name;
        file.hidden = false;
      }
      li.querySelector('.ci-del').addEventListener('click', () => remove(i));
      list.appendChild(li);
    });
    listeners.forEach((fn) => fn());
  }

  function remove(i) {
    lines.splice(i, 1);
    save(); render();
  }

  // The same quantity, colours and design choice is already in the cart, so it isn't added twice
  function add({ qty, colors = 1, design }) {
    if (!lines.some((l) => l.qty === qty && l.colors === colors && l.design === design)) lines.push({ qty, colors, design });
    save(); render();
    fab.classList.remove('bump'); void fab.offsetWidth; fab.classList.add('bump');
  }

  let lastFocus = null;
  function open() {
    lastFocus = document.activeElement;
    drawer.classList.add('open'); scrim.classList.add('open');
    drawer.removeAttribute('inert'); drawer.setAttribute('aria-hidden', 'false');
    fab.setAttribute('aria-expanded', 'true');
    document.documentElement.classList.add('cart-lock');
    render();
    document.getElementById('cart-close').focus();
  }
  function close() {
    drawer.classList.remove('open'); scrim.classList.remove('open');
    drawer.setAttribute('inert', ''); drawer.setAttribute('aria-hidden', 'true');
    fab.setAttribute('aria-expanded', 'false');
    document.documentElement.classList.remove('cart-lock');
    render();
    lastFocus?.focus();
  }
  fab.addEventListener('click', open);
  scrim.addEventListener('click', close);
  document.getElementById('cart-close').addEventListener('click', close);
  addEventListener('keydown', (e) => { if (e.key === 'Escape' && drawer.classList.contains('open')) close(); });
  document.getElementById('cart-clear').addEventListener('click', () => { lines = []; save(); render(); });

  // Another tab changed the cart
  addEventListener('storage', (e) => {
    if (e.key !== STORE) return;
    try { lines = load(e.newValue); } catch { lines = []; }
    render();
  });

  window.hopCart = {
    config, rupees, price, colours, describe, totals, add, open, remove, note, setNote,
    lines: () => lines.map((l) => ({ ...l })),
    clear: () => { lines = []; save(); render(); },
    onChange: (fn) => { listeners.push(fn); fn(); },
  };
  render();
})();
