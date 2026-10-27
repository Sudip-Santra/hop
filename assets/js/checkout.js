// Checkout page: the order (each card with its artwork upload or studio note), totals,
// form checks, and the order sent on WhatsApp.
// Needs cart.js (window.hopCart) and WHATSAPP from main.js.
//
// There is no server, so an uploaded file stays in this browser tab: its name goes into the
// order message, and on phones the confirmation offers to share the file itself to WhatsApp.
(() => {
  const cart = window.hopCart;
  const form = document.getElementById('co-form');
  const itemsEl = document.getElementById('co-items');
  const errors = [document.getElementById('co-error'), document.getElementById('co-error-end')];
  const MAX_MB = 1;
  const ACCEPT = '.png,.jpg,.jpeg,.webp,image/png,image/jpeg,image/webp';
  const TYPES = ['image/png', 'image/jpeg', 'image/webp'];
  const keyOf = (l) => `${l.qty}-${l.design ? 'design' : 'own'}`;
  const files = new Map(); // line key -> File
  // A design uploaded on the business cards page (kept in this tab) goes on each own-artwork card
  let kept = null;
  try {
    const a = JSON.parse(sessionStorage.getItem('hop-art'));
    if (a) {
      const bytes = Uint8Array.from(atob(a.data.split(',')[1]), (c) => c.charCodeAt(0));
      kept = new File([bytes], a.name, { type: a.type });
    }
  } catch {}
  const removed = new Set(); // cards whose kept design was taken off here
  const sizeOf = (b) => (b > 1e6 ? (b / 1e6).toFixed(1) + ' MB' : Math.max(1, Math.round(b / 1e3)) + ' KB');
  // Numbers in the order set in mono (.num); the text around them stays in the body font
  const num = (n) => `<b class="num">${n}</b>`;
  const cards = (n) => `${num(n.toLocaleString('en-IN'))} cards`;
  // Rush: a flat fee on the whole order, chosen under "How soon?"
  const rushFee = cart.config.rush;
  const isRush = () => form.querySelector('[name=speed]:checked')?.value === 'rush';
  const grandTotal = () => cart.totals().total + (isRush() ? rushFee : 0);

  function itemEl(l, i) {
    const li = document.createElement('li');
    li.className = 'co-item';
    li.innerHTML = `
      <div class="co-item-row">
        <div class="co-item-name"><b></b><span></span></div>
        <b class="co-item-price"></b>
      </div>
      <div class="co-item-row co-item-act">
        <button type="button" class="co-remove">Remove</button>
      </div>
      <div class="co-art"></div>`;
    li.querySelector('.co-item-name b').innerHTML = `${cards(l.qty)}, letterpress`;
    li.querySelector('.co-item-name span').textContent = l.design ? 'Studio design' : 'Your artwork';
    li.querySelector('.co-item-price').textContent = cart.rupees(cart.price(l));
    li.querySelector('.co-remove').addEventListener('click', () => cart.remove(i));
    renderArt(li.querySelector('.co-art'), l);
    return li;
  }

  // Studio design: a note. Own artwork: an upload button, or the chosen file.
  function renderArt(box, l) {
    const key = keyOf(l);
    if (l.design) {
      box.className = 'co-art is-studio';
      box.innerHTML = '<svg class="i" aria-hidden="true"><use href="#i-pen"/></svg><p>Our studio designs this card and sends you a proof.</p>';
      return;
    }
    if (kept && !files.has(key) && !removed.has(key)) files.set(key, kept);
    const file = files.get(key);
    if (file) {
      box.className = 'co-art is-file';
      box.innerHTML = `<svg class="i" aria-hidden="true"><use href="#i-file"/></svg>
        <p><b></b><span></span></p>
        <button type="button" class="co-art-x" aria-label="Remove file"><svg class="i" aria-hidden="true"><use href="#i-x"/></svg></button>`;
      box.querySelector('b').textContent = file.name;
      box.querySelector('p span').innerHTML = `${sizeOf(file.size).replace(/^[\d.]+/, num)} · attached`;
      box.querySelector('.co-art-x').addEventListener('click', () => { files.delete(key); removed.add(key); renderArt(box, l); });
      return;
    }
    box.className = 'co-art is-upload';
    box.innerHTML = `<label class="btn line co-up">
        <svg class="i" aria-hidden="true"><use href="#i-upload"/></svg>Upload design
        <input type="file" accept="${ACCEPT}">
      </label>
      <p>PNG, JPG or WEBP · up to ${num(MAX_MB)} MB</p>
      <p class="co-art-err" role="alert" hidden></p>`;
    box.querySelector('input').addEventListener('change', (e) => {
      const f = e.target.files[0];
      if (!f) return;
      const err = box.querySelector('.co-art-err');
      const fail = (text) => { err.textContent = text; err.hidden = false; e.target.value = ''; };
      if (!TYPES.includes(f.type)) return fail('Please choose a PNG, JPG or WEBP image.');
      if (f.size > MAX_MB * 1024 * 1024) return fail(`That image is ${sizeOf(f.size)}. Choose one up to ${MAX_MB} MB, or send it on WhatsApp.`);
      files.set(key, f);
      renderArt(box, l);
    });
  }

  function render() {
    const lines = cart.lines();
    const { total } = cart.totals();
    const grand = grandTotal();
    document.getElementById('co-empty').hidden = lines.length > 0;
    form.hidden = lines.length === 0;
    // Forget files for cards that are no longer in the cart
    const keys = new Set(lines.map(keyOf));
    [...files.keys()].forEach((k) => { if (!keys.has(k)) files.delete(k); });
    itemsEl.replaceChildren(...lines.map(itemEl));
    document.getElementById('co-sub').textContent = cart.rupees(total);
    document.getElementById('co-rush-row').hidden = !isRush();
    document.getElementById('co-rush').textContent = cart.rupees(rushFee);
    document.getElementById('co-total').textContent = cart.rupees(grand);
    document.querySelectorAll('.co-total-inline').forEach((el) => { el.textContent = cart.rupees(grand); });
  }

  // ---------- State and city: searchable lists from the CountriesNow API (no key needed).
  // If it can't be reached, states fall back to the list below and the city is typed freely.
  const API = 'https://countriesnow.space/api/v0.1/countries';
  const FALLBACK_STATES = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Delhi', 'Jammu and Kashmir', 'Ladakh', 'Chandigarh', 'Puducherry'];
  const stateIn = form.querySelector('[name=state]');
  const cityIn = form.querySelector('[name=city]');
  const states = window.hopCombo(stateIn);
  const cities = window.hopCombo(cityIn, { free: true });
  const cached = async (key, url, pick) => {
    try { const hit = sessionStorage.getItem(key); if (hit) return JSON.parse(hit); } catch {}
    const res = await fetch(url);
    if (!res.ok) throw new Error(res.status);
    const list = pick(await res.json());
    try { sessionStorage.setItem(key, JSON.stringify(list)); } catch {}
    return list;
  };
  states.setStatus('Loading states…');
  cached('hop-states', `${API}/states/q?country=India`, (d) => d.data.states.map((x) => x.name))
    .then((list) => states.setItems(list))
    .catch(() => states.setItems(FALLBACK_STATES));

  let cityFor = '';
  stateIn.addEventListener('change', () => {
    const state = stateIn.value.trim();
    if (!states.has(state) || state === cityFor) return;
    cityFor = state;
    cityIn.value = '';
    cityIn.placeholder = 'Search city';
    cities.setItems([]);
    cities.setStatus('Loading cities…');
    cached(`hop-cities-${state}`, `${API}/state/cities/q?country=India&state=${encodeURIComponent(state)}`, (d) => d.data)
      .then((list) => { if (cityFor === state) cities.setItems(list); })
      .catch(() => { if (cityFor === state) { cities.setItems([]); cityIn.placeholder = 'Type your city'; } });
  });

  // ---------- Dispatch calendar. Each day is coloured by the speed that can reach it:
  // green = standard (free), red = rush only, grey = too soon. Every day of the week counts,
  // weekends included, from today. Picking a day sets the speed to match; switching back to
  // Standard clears a rush-only day.
  const calEl = document.getElementById('co-cal');
  const calGrid = document.getElementById('co-cal-grid');
  const calMonth = document.getElementById('co-cal-month');
  const calPrev = document.getElementById('co-cal-prev');
  const calNote = document.getElementById('co-cal-note');
  const needby = document.getElementById('co-needby');
  const calNoteDefault = calNote.textContent;
  const iso = (d) => `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
  const longDate = (d) => d.toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
  const today = new Date(); today.setHours(0, 0, 0, 0);
  const addDays = (from, n) => { const d = new Date(from); d.setDate(d.getDate() + n); return d; };
  const rushFrom = addDays(today, Number(calEl.dataset.rushDays));
  const stdFrom = addDays(today, Number(calEl.dataset.standardDays));
  const kindOf = (d) => (d < rushFrom ? 'off' : d < stdFrom ? 'rush' : 'std');
  const KIND = { std: 'standard, free', rush: 'rush only', off: 'not available' };
  // Opens on the month where standard days begin: its grid also shows the rush days just before
  let view = new Date(stdFrom.getFullYear(), stdFrom.getMonth(), 1);
  let picked = null;

  function drawCal() {
    calMonth.textContent = view.toLocaleDateString('en-IN', { month: 'long', year: 'numeric' });
    calPrev.disabled = view <= new Date(today.getFullYear(), today.getMonth(), 1);
    const start = new Date(view);
    start.setDate(1 - ((view.getDay() + 6) % 7)); // back to Monday
    const days = [];
    for (let i = 0; i < 42; i++) {
      const d = new Date(start); d.setDate(start.getDate() + i);
      const kind = kindOf(d);
      const b = document.createElement('button');
      b.type = 'button';
      b.textContent = d.getDate();
      b.dataset.date = iso(d);
      b.className = `k-${kind}${d.getMonth() !== view.getMonth() ? ' out' : ''}${iso(d) === iso(today) ? ' today' : ''}`;
      b.disabled = kind === 'off';
      b.setAttribute('aria-label', `${longDate(d)}, ${KIND[kind]}`);
      b.setAttribute('aria-pressed', String(!!picked && iso(d) === iso(picked)));
      days.push(b);
    }
    calGrid.replaceChildren(...days);
  }
  function noteFor(d) {
    if (!d) { calNote.textContent = calNoteDefault; return; }
    const when = longDate(d).replace(/\d+/g, num);
    calNote.innerHTML = kindOf(d) === 'rush'
      ? `Dispatched by <b>${when}</b> with Rush (+${num(cart.rupees(rushFee))}).`
      : `Dispatched by <b>${when}</b> with Standard, free.`;
  }
  const setSpeed = (v) => { form.querySelector(`[name=speed][value=${v}]`).checked = true; };

  calGrid.addEventListener('click', (e) => {
    const b = e.target.closest('button');
    if (!b || b.disabled) return;
    picked = new Date(b.dataset.date + 'T00:00');
    needby.value = b.dataset.date;
    setSpeed(kindOf(picked) === 'rush' ? 'rush' : 'standard');
    noteFor(picked);
    drawCal();
    render();
  });
  calPrev.addEventListener('click', () => { view.setMonth(view.getMonth() - 1); drawCal(); });
  document.getElementById('co-cal-next').addEventListener('click', () => { view.setMonth(view.getMonth() + 1); drawCal(); });
  // Standard can't reach a red day, so choosing it clears one
  form.addEventListener('change', (e) => {
    if (e.target.name !== 'speed' || isRush() || !picked || kindOf(picked) !== 'rush') return;
    picked = null;
    needby.value = '';
    calNote.textContent = 'That date needs Rush, so it was cleared. Pick a green date, or choose Rush.';
    drawCal();
  });
  drawCal();

  // Each required field, with the message shown when it's missing or wrong
  const checks = [
    ['name', (v) => v.length > 1, 'Add your full name.'],
    ['phone', (v) => /^[6-9]\d{9}$/.test(v), 'Add your 10-digit WhatsApp number.'],
    ['email', (v) => /^\S+@\S+\.\S+$/.test(v), 'Add a valid email address.'],
    ['address', (v) => v.length > 3, 'Add your delivery address.'],
    ['state', (v) => states.has(v), 'Choose your state from the list.'],
    ['city', (v) => v.length > 1, 'Add your city.'],
    ['pin', (v) => /^\d{6}$/.test(v), 'Add a 6-digit PIN code.'],
  ];
  const showError = (text) => errors.forEach((el) => { el.textContent = text; el.hidden = !text; });

  // The number field takes digits only, at most 10 (the +91 is fixed beside it)
  const phone = form.querySelector('[name=phone]');
  phone.addEventListener('input', () => {
    let d = phone.value.replace(/\D/g, '');
    if (d.length > 10) d = d.replace(/^(91|0)/, ''); // pasted as +91… or 0…
    phone.value = d.slice(0, 10);
  });

  // Typing in a flagged field clears the message
  form.addEventListener('input', (e) => {
    if (e.target.getAttribute('aria-invalid')) { e.target.removeAttribute('aria-invalid'); showError(''); }
  });

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const f = new FormData(form);
    const val = (k) => (f.get(k) || '').toString().trim();
    form.querySelectorAll('[aria-invalid]').forEach((el) => el.removeAttribute('aria-invalid'));
    const failed = checks.find(([k, ok]) => !ok(val(k)));
    if (failed) {
      const input = form.querySelector(`[name=${failed[0]}]`);
      input.setAttribute('aria-invalid', 'true');
      showError(failed[2]);
      input.focus();
      return;
    }
    showError('');

    const lines = cart.lines();
    if (!lines.length) return;
    const total = grandTotal();
    const ref = 'HOP-' + Date.now().toString(36).toUpperCase().slice(-6);
    const art = (l) => (l.design ? 'studio design' : files.get(keyOf(l)) ? `my artwork: ${files.get(keyOf(l)).name} (sending in this chat)` : 'my artwork (sending in this chat)');
    const msg = [
      `Hi House of Press, I'd like to place an order (${ref}).`,
      '',
      ...lines.map((l) => `• ${l.qty} letterpress business cards, ${art(l)}: ${cart.rupees(cart.price(l))}`),
      isRush() ? `Rush, dispatched in ${form.dataset.rushDispatch} after the proof: ${cart.rupees(rushFee)}` : `Standard, dispatched in ${form.dataset.dispatch} after the proof`,
      picked ? `Dispatch by: ${longDate(picked)}` : null,
      `Total: ${cart.rupees(total)} (GST and delivery included)`,
      '',
      `Name: ${val('name')}`,
      `WhatsApp: +91 ${val('phone')}`,
      `Email: ${val('email')}`,
      `Deliver to: ${[val('address'), val('address2'), val('city'), val('state'), val('pin')].filter(Boolean).join(', ')}`,
      val('details') ? `\nOn the card:\n${val('details')}` : null,
    ].filter((x) => x !== null).join('\n');
    const url = `https://wa.me/${WHATSAPP}?text=${encodeURIComponent(msg)}`;
    window.open(url, '_blank', 'noopener');

    // Confirmation: the reference, and how to get the artwork to us
    const chosen = [...files.values()];
    document.getElementById('co-ref').textContent = ref;
    document.getElementById('co-resend').href = url;
    if (chosen.length) {
      document.getElementById('co-done-files').hidden = false;
      document.getElementById('co-done-names').textContent = chosen.map((x) => x.name).join(', ');
      const share = document.getElementById('co-share');
      if (navigator.canShare?.({ files: chosen })) {
        share.hidden = false;
        document.getElementById('co-done-how').textContent = 'Share it to the studio’s WhatsApp chat so we can set your card.';
        share.addEventListener('click', () => navigator.share({ files: chosen, title: `Artwork for ${ref}` }).catch(() => {}));
      }
    }
    form.hidden = true;
    const done = document.getElementById('co-done');
    done.hidden = false;
    cart.clear();
    done.focus();
    scrollTo({ top: 0 });
  });

  cart.onChange(() => { if (document.getElementById('co-done').hidden) render(); });
  form.addEventListener('change', (e) => { if (e.target.name === 'speed') render(); });
})();
