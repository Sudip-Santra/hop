// Business cards page: live price, add to cart and buy now. Needs cart.js.
(() => {
  const cart = window.hopCart;
  const form = document.getElementById('bc-form');
  const priceEl = document.getElementById('bc-price');
  const added = document.getElementById('bc-added');

  // ---------- Choice and price
  const choice = () => ({
    qty: Number(form.querySelector('[name=qty]:checked').value),
    design: form.querySelector('[name=design]:checked').value === 'yes',
  });
  const update = () => { priceEl.textContent = cart.rupees(cart.price(choice())); };

  // ---------- Artwork: an uploaded design replaces the sample on the card, and is kept in this
  // tab (sessionStorage) so the checkout page attaches it to the order.
  const ART = 'hop-art';
  const MAX_MB = 1;
  const TYPES = ['image/png', 'image/jpeg', 'image/webp'];
  const card = document.getElementById('pcard');
  const sample = document.getElementById('pcard-sample');
  const artImg = document.getElementById('pcard-art');
  const capLead = document.getElementById('pcard-cap-lead');
  const upload = document.getElementById('bc-upload');
  const upBtn = document.getElementById('bc-up');
  const fileIn = document.getElementById('bc-file');
  const fileRow = document.getElementById('bc-file-row');
  const upErr = document.getElementById('bc-up-err');
  const sizeOf = (b) => (b > 1e6 ? (b / 1e6).toFixed(1) + ' MB' : Math.max(1, Math.round(b / 1e3)) + ' KB');
  let art = null; // { name, type, data } with data as a data: URL
  try { art = JSON.parse(sessionStorage.getItem(ART)); } catch {}

  // The card shows the upload only while "I'll send my artwork" is chosen
  function showPreview() {
    const own = !choice().design;
    const mine = own && art;
    upload.hidden = !own;
    sample.hidden = !!mine;
    artImg.hidden = !mine;
    if (mine) artImg.src = art.data;
    capLead.textContent = mine ? 'Your design on Pearl White cotton; the proof shows exactly how it presses.' : 'Our own card, as a sample; yours goes on the proof.';
    card.setAttribute('aria-label', mine ? `Your design, ${art.name}, on a card` : 'A House of Press card in black ink with a red rule, on Pearl White cotton');
    upBtn.hidden = !!art;
    fileRow.hidden = !art;
    if (art) document.getElementById('bc-file-name').textContent = art.name;
  }

  fileIn.addEventListener('change', () => {
    const f = fileIn.files[0];
    fileIn.value = ''; // choosing the same file again still fires change
    if (!f) return;
    const fail = (text) => { upErr.textContent = text; upErr.hidden = false; };
    if (!TYPES.includes(f.type)) return fail('Please choose a PNG, JPG or WEBP image.');
    if (f.size > MAX_MB * 1024 * 1024) return fail(`That image is ${sizeOf(f.size)}. Choose one up to ${MAX_MB} MB, or send it on WhatsApp.`);
    upErr.hidden = true;
    const reader = new FileReader();
    reader.onload = () => {
      art = { name: f.name, type: f.type, data: reader.result };
      try { sessionStorage.setItem(ART, JSON.stringify(art)); } catch {} // still previews if storage is full
      showPreview();
    };
    reader.readAsDataURL(f);
  });
  document.getElementById('bc-file-x').addEventListener('click', () => {
    art = null;
    try { sessionStorage.removeItem(ART); } catch {}
    showPreview();
    fileIn.focus();
  });
  form.addEventListener('change', (e) => { if (e.target.name === 'design') showPreview(); });
  showPreview();

  form.addEventListener('change', update);

  // ---------- Buy
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const c = choice();
    cart.add(c);
    added.textContent = `Added: ${cart.describe(c)}.`;
    cart.open();
  });
  document.getElementById('bc-now').addEventListener('click', () => {
    cart.add(choice());
    location.href = cart.config.checkout;
  });

  update();
})();
