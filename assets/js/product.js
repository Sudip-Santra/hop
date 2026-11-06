// Business cards page: live price, add to cart and buy now. Needs cart.js.
(() => {
  const cart = window.hopCart;
  const form = document.getElementById('bc-form');
  const priceEl = document.getElementById('bc-price');
  const added = document.getElementById('bc-added');

  // ---------- Choice and price
  const choice = () => ({
    qty: Number(form.querySelector('[name=qty]:checked').value),
    colors: Number(form.querySelector('[name=colors]:checked').value),
    design: form.querySelector('[name=design]:checked').value === 'yes',
  });
  const update = () => { priceEl.textContent = cart.rupees(cart.price(choice())); };

  // ---------- Artwork: an uploaded design replaces the sample on the card, and is kept in this
  // tab (sessionStorage) so the checkout page attaches it to the order.
  const ART = 'hop-art';
  const MAX_MB = 1;
  const TYPES = ['image/png', 'image/jpeg', 'image/webp', 'application/pdf'];
  const isPdf = (a) => a?.type === 'application/pdf';
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

  // ---------- Playground: try a card design, then change its paper and inks here, and its text and
  // layout on the card itself (card-editor.js). Ideas only; nothing here goes with the order.
  // The swatches set CSS variables on the card (--card-paper, --press-ink, --card-accent).
  const thumbs = [...document.querySelectorAll('.pg-thumb')];
  const fronts = [...sample.querySelectorAll('.pcard-front')];
  const editor = document.getElementById('ce-card-bar'); // the card's own options (card-editor.js shows it)
  const hint = document.getElementById('ce-hint');
  const swatchRows = [...editor.querySelectorAll('.pg-swatches')];
  const swatch = (kind, value) => editor.querySelector(`[data-kind=${kind}] [data-value=${value}]`);
  const looks = {}; // design id -> { paper, ink, accent }, so switching designs keeps each one's colours
  let trying = null; // { id, name } while a design is picked

  // A look's value is a swatch key ('bone', 'red') or a custom colour ('#1f6f8b')
  const isHex = (v) => v.startsWith('#');
  const hexOf = (kind, v) => (isHex(v) ? v : swatch(kind, v).dataset.hex);
  /**
   * How much light a custom paper catches along the impression's lip, from its lightness.
   * Example: toneOf('#f6f1e6') → 'light'; toneOf('#24345f') → 'dark'
   */
  function toneOf(hex) {
    const [r, g, b] = [1, 3, 5].map((i) => parseInt(hex.slice(i, i + 2), 16) / 255);
    const l = 0.2126 * r + 0.7152 * g + 0.0722 * b;
    return l > 0.9 ? 'light' : l > 0.72 ? 'soft' : l > 0.4 ? 'mid' : 'dark';
  }

  function paint() {
    const look = looks[trying.id];
    card.style.setProperty('--card-paper', hexOf('paper', look.paper));
    card.dataset.tone = isHex(look.paper) ? toneOf(look.paper) : swatch('paper', look.paper).dataset.tone;
    for (const kind of ['ink', 'accent']) {
      const hex = hexOf(kind, look[kind]);
      card.style.setProperty(kind === 'ink' ? '--press-ink' : '--card-accent', hex === 'blind' ? 'var(--blind-ink)' : hex);
    }
    // The chosen swatch is marked; a custom colour marks the rainbow one and shows in its middle
    swatchRows.forEach((row) => {
      const v = look[row.dataset.kind];
      row.querySelectorAll('.pg-sw').forEach((b) =>
        b.setAttribute('aria-pressed', String(b.dataset.value === v || (b.dataset.value === 'custom' && isHex(v)))));
      const custom = row.querySelector('.ce-custom');
      if (isHex(v)) custom.style.setProperty('--sw', v);
      else custom.style.removeProperty('--sw');
    });
  }

  function pick(thumb) {
    const id = thumb.dataset.design;
    trying = { id, name: thumb.querySelector('.pg-thumb-name').textContent };
    looks[id] ??= { paper: thumb.dataset.paper, ink: thumb.dataset.ink, accent: thumb.dataset.accent };
    thumbs.forEach((t) => t.setAttribute('aria-pressed', String(t === thumb)));
    const front = fronts.find((f) => f.dataset.design === id);
    fronts.forEach((f) => { f.hidden = f !== front; });
    hint.hidden = false;
    paint();
    showPreview();
    window.hopCardEditor.use(front); // now that it shows: text and layout editable on the card
  }

  // Back to the studio's own card, as it first loads (an upload or the reset)
  function stopTrying() {
    if (!trying) return;
    trying = null;
    thumbs.forEach((t) => t.setAttribute('aria-pressed', 'false'));
    fronts.forEach((f) => { f.hidden = f.dataset.design !== 'house'; });
    ['--card-paper', '--press-ink', '--card-accent'].forEach((v) => card.style.removeProperty(v));
    card.removeAttribute('data-tone');
    hint.hidden = true;
    window.hopCardEditor.off();
  }

  thumbs.forEach((t) => t.addEventListener('click', () => pick(t)));
  // The card's own custom colour, one picker for its three rows (card-editor.js builds it)
  const cardPicker = window.hopCardEditor.colourPicker(editor.querySelector('.ce-cp'));
  let pickingKind = null;
  swatchRows.forEach((row) => row.addEventListener('click', (e) => {
    const b = e.target.closest('.pg-sw');
    if (!b || !trying) return;
    const kind = row.dataset.kind;
    if (b.dataset.value === 'custom') {
      // The same rainbow again closes it; another row's moves the picker to that row
      if (cardPicker.open && pickingKind === kind) { cardPicker.hide(); return; }
      cardPicker.hide();
      const look = looks[trying.id];
      const start = hexOf(kind, look[kind]);
      pickingKind = kind;
      b.setAttribute('aria-expanded', 'true');
      cardPicker.show(start === 'blind' ? '#262827' : start, (hex) => { look[kind] = hex; paint(); },
        () => { b.setAttribute('aria-expanded', 'false'); pickingKind = null; });
      return;
    }
    cardPicker.hide();
    looks[trying.id][kind] = b.dataset.value;
    paint();
  }));
  document.getElementById('pg-reset').addEventListener('click', () => {
    const thumb = thumbs.find((t) => t.dataset.design === trying.id);
    delete looks[trying.id];
    window.hopCardEditor.reset(fronts.find((f) => f.dataset.design === trying.id));
    pick(thumb);
  });

  // The card shows the upload only while "I'll send my artwork" is chosen.
  // A PDF can't be drawn on the card, so the sample stays and the file is just attached.
  // While a playground design is being tried, it shows instead of an uploaded image.
  // Whenever the card isn't showing an uploaded image, a design is picked: the first one by default.
  function showPreview() {
    const own = !choice().design;
    const mine = own && art && !isPdf(art) && !trying;
    if (!mine && !trying) return pick(thumbs[0]); // pick() comes back here with a design set
    const pdf = own && art && isPdf(art);
    upload.hidden = !own;
    sample.hidden = !!mine;
    artImg.hidden = !mine;
    if (mine) artImg.src = art.data;
    // A caption only for the customer's own file
    capLead.parentElement.hidden = !mine && !pdf;
    capLead.textContent = mine ? 'Your design on Pearl White cotton; the proof shows exactly how it presses.'
      : pdf ? 'Your PDF is attached; the proof shows exactly how it presses.' : '';
    card.setAttribute('aria-label', mine ? `Your design, ${art.name}, on a card` : `The ${trying.name} card design, as you've set it`);
    upBtn.hidden = !!art;
    fileRow.hidden = !art;
    if (art) document.getElementById('bc-file-name').textContent = art.name;
  }

  fileIn.addEventListener('change', () => {
    const f = fileIn.files[0];
    fileIn.value = ''; // choosing the same file again still fires change
    if (!f) return;
    const fail = (text) => { upErr.textContent = text; upErr.hidden = false; };
    if (!TYPES.includes(f.type)) return fail('Please choose a PNG, JPG, WEBP or PDF file.');
    if (f.size > MAX_MB * 1024 * 1024) return fail(`That image is ${sizeOf(f.size)}. Choose one up to ${MAX_MB} MB, or send it on WhatsApp.`);
    upErr.hidden = true;
    const reader = new FileReader();
    reader.onload = () => {
      art = { name: f.name, type: f.type, data: reader.result };
      try { sessionStorage.setItem(ART, JSON.stringify(art)); } catch {} // still previews if storage is full
      stopTrying(); // a fresh upload goes on the card
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

  // ---------- Notes for the studio: one note for the whole order, saved as it's typed
  const notes = document.getElementById('bc-notes');
  notes.value = cart.note();
  notes.addEventListener('input', () => cart.setNote(notes.value));

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

  // ---------- The buy buttons stick to the bottom of the screen (CSS: sticky) until their own place
  // in the form scrolls into view. The line just after them tells which: while it's below the
  // screen, the buttons are stuck, and get a top edge so they read as a bar over the page.
  const buy = form.querySelector('.bc-buy');
  new IntersectionObserver(([entry]) => {
    const stuck = !entry.isIntersecting && entry.boundingClientRect.top > 0;
    buy.classList.toggle('is-stuck', stuck);
    document.documentElement.classList.toggle('bc-buy-stuck', stuck);
  }).observe(added);

  update();
})();
