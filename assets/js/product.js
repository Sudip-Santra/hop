// Business cards page: live price, add to cart and buy now. Needs cart.js.
(() => {
  const cart = window.hopCart;
  const form = document.getElementById('bc-form');
  const priceEl = document.getElementById('bc-price');
  const added = document.getElementById('bc-added');
  const setsInput = form.querySelector('[name=sets]');

  // ---------- Choice and price
  const sets = () => Math.max(1, Math.min(50, parseInt(setsInput.value, 10) || 1));
  const choice = () => ({
    qty: Number(form.querySelector('[name=qty]:checked').value),
    design: form.querySelector('[name=design]:checked').value === 'yes',
    sets: sets(),
  });
  const update = () => { priceEl.textContent = cart.rupees(cart.price(choice())); };

  form.addEventListener('change', update);
  setsInput.addEventListener('input', update);
  setsInput.addEventListener('blur', () => { setsInput.value = sets(); update(); });
  form.querySelector('.q-inc').addEventListener('click', () => { setsInput.value = Math.min(50, sets() + 1); update(); });
  form.querySelector('.q-dec').addEventListener('click', () => { setsInput.value = Math.max(1, sets() - 1); update(); });

  // ---------- Buy
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const c = choice();
    cart.add(c);
    added.textContent = `Added: ${cart.describe(c)}${c.sets > 1 ? ` × ${c.sets}` : ''}.`;
    cart.open();
  });
  document.getElementById('bc-now').addEventListener('click', () => {
    cart.add(choice());
    location.href = cart.config.checkout;
  });

  update();
})();
