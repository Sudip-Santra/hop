// Cart on every page: floating button, right-hand drawer, saved in this browser.
// Other scripts use window.hopCart: add(), lines(), totals(), clear(), open(), describe(), price().
(() => {
  const config = JSON.parse(document.getElementById('hop-prices').textContent);
  const STORE = 'hop-cart';
  const rupees = (n) => '₹' + n.toLocaleString('en-IN');

  // A line is one choice of card: { qty: 100, design: false }. The quantity is the number of cards.
  // Older saved carts also carry a sets count; it is dropped here.
  const load = (raw) => (JSON.parse(raw) || []).filter((l) => config.cards[l.qty]).map(({ qty, design }) => ({ qty, design }));
  let lines = [];
  try { lines = load(localStorage.getItem(STORE)); } catch {}
  const save = () => { try { localStorage.setItem(STORE, JSON.stringify(lines)); } catch {} };

  const price = (l) => config.cards[l.qty] + (l.design ? config.design : 0);
  const describe = (l) => `${l.qty} cards · ${l.design ? 'Studio design' : 'Your artwork'}`;
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
    lines.forEach((l, i) => {
      const li = document.createElement('li');
      li.className = 'cart-item';
      li.innerHTML = `
        <div class="ci-body"><h3>Letterpress business cards</h3><p class="label"></p><b class="ci-price"></b></div>
        <div class="ci-act">
          <button type="button" class="ci-del" aria-label="Remove"><svg class="i" aria-hidden="true"><use href="#i-trash-2"/></svg></button>
        </div>`;
      // The card count in mono (.num), the words around it in the label font
      li.querySelector('.label').innerHTML = `<b class="num">${l.qty}</b> cards · ${l.design ? 'Studio design' : 'Your artwork'}`;
      li.querySelector('.ci-price').textContent = rupees(price(l));
      li.querySelector('.ci-del').addEventListener('click', () => remove(i));
      list.appendChild(li);
    });
    listeners.forEach((fn) => fn());
  }

  function remove(i) {
    lines.splice(i, 1);
    save(); render();
  }

  // The same quantity and design choice is already in the cart, so it isn't added twice
  function add({ qty, design }) {
    if (!lines.some((l) => l.qty === qty && l.design === design)) lines.push({ qty, design });
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
    config, rupees, price, describe, totals, add, open, remove,
    lines: () => lines.map((l) => ({ ...l })),
    clear: () => { lines = []; save(); render(); },
    onChange: (fn) => { listeners.push(fn); fn(); },
  };
  render();
})();
