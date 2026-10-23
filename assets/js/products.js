// Products page: pack steppers, floating cart + drawer, WhatsApp ordering, range nav highlight.
// Needs WHATSAPP from main.js.

const items = [...document.querySelectorAll('.item')];
const fab = document.getElementById('cart-fab');
const cart = document.getElementById('cart');
const scrim = document.getElementById('cart-scrim');
const cartList = document.getElementById('cart-list');
const plural = (n, word) => `${n} ${word}${n === 1 ? '' : 's'}`;
const qtyOf = (el) => Math.max(0, Math.min(999, parseInt(el.querySelector('input').value, 10) || 0));
const nameOf = (el) => el.querySelector('h3').textContent;
const specOf = (el) => el.querySelector('.item-spec').textContent.replace(/\s+/g, ' ').trim();

// Cart persists in this browser: { "item name (size)": packs }
const STORE = 'kk-cart';
function saveCart() {
  const data = {};
  items.forEach(el => { if (qtyOf(el) > 0) data[el.dataset.item] = qtyOf(el); });
  try { localStorage.setItem(STORE, JSON.stringify(data)); } catch {}
}
function loadCart() {
  let data = {};
  try { data = JSON.parse(localStorage.getItem(STORE)) || {}; } catch {}
  items.forEach(el => {
    const n = Math.max(0, Math.min(999, parseInt(data[el.dataset.item], 10) || 0));
    el.querySelector('input').value = n;
    el.classList.toggle('on', n > 0);
  });
}

function setQty(el, n) {
  const before = qtyOf(el);
  el.querySelector('input').value = n;
  el.classList.toggle('on', n > 0);
  render();
  if (n > before) { fab.classList.remove('bump'); void fab.offsetWidth; fab.classList.add('bump'); }
}

// One stepper (page row or cart row) wired to an item
function stepper(el, root) {
  root.querySelector('.q-inc').addEventListener('click', () => setQty(el, Math.min(999, qtyOf(el) + 1)));
  root.querySelector('.q-dec').addEventListener('click', () => setQty(el, Math.max(0, qtyOf(el) - 1)));
}

function render() {
  const picked = items.filter(el => qtyOf(el) > 0);
  const packs = picked.reduce((sum, el) => sum + qtyOf(el), 0);

  document.getElementById('cart-count').textContent = picked.length;
  document.getElementById('cart-total').textContent = `${plural(picked.length, 'item')} · ${plural(packs, 'pack')}`;
  document.getElementById('cart-empty').hidden = picked.length > 0;
  document.getElementById('cart-send').disabled = picked.length === 0;
  fab.classList.toggle('show', picked.length > 0 || cart.classList.contains('open'));
  saveCart();

  cartList.innerHTML = '';
  picked.forEach(el => {
    const li = document.createElement('li');
    li.className = 'cart-item';
    li.innerHTML = `
      <div class="ci-body"><h3></h3><p class="label"></p></div>
      <div class="ci-act">
        <div class="qty">
          <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
          <output>${qtyOf(el)}</output>
          <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
        </div>
        <button type="button" class="ci-del" aria-label="Remove"><svg class="i" aria-hidden="true"><use href="#i-trash-2"/></svg></button>
      </div>`;
    li.querySelector('h3').textContent = nameOf(el);
    li.querySelector('.label').textContent = specOf(el);
    stepper(el, li);
    li.querySelector('.ci-del').addEventListener('click', () => setQty(el, 0));
    cartList.appendChild(li);
  });
}

items.forEach(el => {
  const input = el.querySelector('input');
  stepper(el, el);
  input.addEventListener('input', () => setQty(el, qtyOf(el)));
  input.addEventListener('focus', () => input.select());
});

// Drawer open / close
let lastFocus = null;
function openCart() {
  lastFocus = document.activeElement;
  cart.classList.add('open'); scrim.classList.add('open');
  cart.removeAttribute('inert'); cart.setAttribute('aria-hidden', 'false');
  fab.setAttribute('aria-expanded', 'true');
  document.documentElement.classList.add('cart-lock');
  document.getElementById('cart-close').focus();
}
function closeCart() {
  cart.classList.remove('open'); scrim.classList.remove('open');
  cart.setAttribute('inert', ''); cart.setAttribute('aria-hidden', 'true');
  fab.setAttribute('aria-expanded', 'false');
  document.documentElement.classList.remove('cart-lock');
  render();
  lastFocus?.focus();
}
fab.addEventListener('click', openCart);
scrim.addEventListener('click', closeCart);
document.getElementById('cart-close').addEventListener('click', closeCart);
addEventListener('keydown', (e) => { if (e.key === 'Escape' && cart.classList.contains('open')) closeCart(); });

document.getElementById('cart-clear').addEventListener('click', () => {
  items.forEach(el => { el.querySelector('input').value = 0; el.classList.remove('on'); });
  render();
});

// Whole cart as one WhatsApp message
document.getElementById('cart-send').addEventListener('click', () => {
  const lines = items.filter(el => qtyOf(el) > 0)
    .map(el => `• ${nameOf(el)} (${specOf(el)}) — ${plural(qtyOf(el), 'pack')}`);
  if (!lines.length) return;
  const msg = `Hi K K Marketing, I'd like to order:\n${lines.join('\n')}\n\nPlease share rates and availability.`;
  window.open(`https://wa.me/${WHATSAPP}?text=${encodeURIComponent(msg)}`, '_blank', 'noopener');
});

loadCart();
render();

// Range nav: underline the range in view (routing itself lives in main.js)
const navLinks = [...document.querySelectorAll('.cat-nav a')];
addEventListener('routechange', (e) => {
  navLinks.forEach(a => a.classList.toggle('active', !!e.detail && a.pathname === e.detail.path));
});
