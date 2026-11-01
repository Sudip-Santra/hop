// Card editor for the playground on the business cards page: the picked design's card works like a
// small canvas. Click an item to select it, drag to move it, pull the corner handle to resize it,
// click selected text again (or double-click) to type on the card. Options are scoped to what's
// clicked and float beside it: an item gets its own bar (type, font, size, bold, ink, delete), the
// card itself gets the card's bar (paper and inks, handled by product.js; add text; reset).
// product.js calls window.hopCardEditor.use(front) / off() / reset(front).
//
// Items are the design's lines of text ([data-field]) and its pressed shapes (.acc-line). The first
// time a design is used, its layout is "flattened": each item is measured where the design put it,
// then set absolutely at that spot, in card widths (cqw), so the look is unchanged but every item
// moves freely and everything still scales with the card.
(() => {
  const card = document.getElementById('pcard');
  if (!card) return;
  const stage = card.parentElement; // .bc-stage: holds the selection box, which mustn't be clipped by the card
  const cardBar = document.getElementById('ce-card-bar');
  const itemBar = document.getElementById('ce-item-bar');

  // ---------- Fonts: the site's own (already on the page) and Google Fonts, fetched only when
  // wanted: opening the font list loads their stylesheets (the files come only for what's drawn),
  // so the page itself loads nothing extra. g = the Google Fonts css2 family spec.
  const GOOGLE = 'https://fonts.googleapis.com/css2?display=swap';
  const FONTS = [
    ['Studio', 'Instrument Serif', 'var(--serif)', null, 'Instrument+Serif:ital@1'],
    ['Studio', 'Instrument Sans', 'var(--sans)', null, 'Instrument+Sans:ital,wght@1,400..700'],
    ['Studio', 'Clarendon', '"Clarendon", Georgia, serif'],
    ['Studio', 'Sen', '"Sen", "Sen Fallback", sans-serif'],
    ['Studio', 'JetBrains Mono', 'var(--mono)'],
    ['Serif', 'Playfair Display', 'serif', 'Playfair+Display:ital,wght@0,400;0,700;1,400;1,700'],
    ['Serif', 'Cormorant Garamond', 'serif', 'Cormorant+Garamond:ital,wght@0,400;0,700;1,400;1,700'],
    ['Serif', 'EB Garamond', 'serif', 'EB+Garamond:ital,wght@0,400;0,700;1,400;1,700'],
    ['Serif', 'Libre Baskerville', 'serif', 'Libre+Baskerville:ital,wght@0,400;0,700;1,400'],
    ['Serif', 'Bodoni Moda', 'serif', 'Bodoni+Moda:ital,wght@0,400;0,700;1,400;1,700'],
    ['Serif', 'Fraunces', 'serif', 'Fraunces:ital,wght@0,400;0,700;1,400;1,700'],
    ['Serif', 'DM Serif Display', 'serif', 'DM+Serif+Display:ital@0;1'],
    ['Sans', 'Inter', 'sans-serif', 'Inter:ital,wght@0,400;0,700;1,400;1,700'],
    ['Sans', 'Manrope', 'sans-serif', 'Manrope:wght@400;700'],
    ['Sans', 'Montserrat', 'sans-serif', 'Montserrat:ital,wght@0,400;0,700;1,400;1,700'],
    ['Sans', 'Poppins', 'sans-serif', 'Poppins:ital,wght@0,400;0,700;1,400;1,700'],
    ['Sans', 'Space Grotesk', 'sans-serif', 'Space+Grotesk:wght@400;700'],
    ['Sans', 'Josefin Sans', 'sans-serif', 'Josefin+Sans:ital,wght@0,400;0,700;1,400;1,700'],
    ['Display', 'Cinzel', 'serif', 'Cinzel:wght@400;700'],
    ['Display', 'Italiana', 'serif', 'Italiana'],
    ['Display', 'Abril Fatface', 'serif', 'Abril+Fatface'],
    ['Display', 'Archivo Black', 'sans-serif', 'Archivo+Black'],
    ['Display', 'Bebas Neue', 'sans-serif', 'Bebas+Neue'],
    ['Script', 'Great Vibes', 'cursive', 'Great+Vibes'],
    ['Script', 'Pinyon Script', 'cursive', 'Pinyon+Script'],
    ['Mono', 'Space Mono', 'monospace', 'Space+Mono:ital,wght@0,400;0,700;1,400;1,700'],
    ['Mono', 'Courier Prime', 'monospace', 'Courier+Prime:ital,wght@0,400;0,700;1,400;1,700'],
  ].map(([group, name, css, g, italic]) => ({ group, name, g, italic, css: g ? `"${name}", ${css}` : css }));
  const fontNamed = (name) => FONTS.find((f) => f.name.toLowerCase() === name.toLowerCase());
  const sheets = new Set();
  const addSheet = (families) => {
    const url = `${GOOGLE}&${families.map((f) => `family=${f}`).join('&')}`;
    if (sheets.has(url)) return;
    sheets.add(url);
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
  };
  const loadAllFonts = () => addSheet(FONTS.filter((f) => f.g).map((f) => f.g));
  // Once a font (or its italic) has arrived, the selection box is re-fitted to the new width
  const whenDrawn = (f, italic) => document.fonts.load(`${italic ? 'italic ' : ''}1em "${f.name}"`).then(place, place);
  // The font a line has: the one picked for it, else the first family its style names
  const fontOf = (el) => fontNamed(el.dataset.font || getComputedStyle(el).fontFamily.split(',')[0].replace(/["']/g, '').trim())
    || { name: getComputedStyle(el).fontFamily.split(',')[0].replace(/["']/g, ''), css: getComputedStyle(el).fontFamily };
  // The site's own Instrument fonts have no italic files here; Google has them, fetched when used
  const loadItalic = (f) => { if (f.italic) { addSheet([f.italic]); whenDrawn(f, true); } };

  // ---------- The font list: our own dropdown, each font set in itself
  const dd = itemBar.querySelector('.ce-dd');
  const ddBtn = dd.querySelector('.ce-dd-btn');
  const ddVal = dd.querySelector('.ce-dd-val');
  const ddList = dd.querySelector('.ce-dd-list');
  let ddBuilt = false;
  function buildList() {
    let group = '';
    for (const f of FONTS) {
      if (f.group !== group) {
        group = f.group;
        const h = document.createElement('p');
        h.className = 'ce-dd-group';
        h.textContent = group === 'Studio' ? 'Our fonts' : group;
        ddList.appendChild(h);
      }
      const o = document.createElement('button');
      o.type = 'button';
      o.className = 'ce-dd-opt';
      o.setAttribute('role', 'option');
      o.dataset.font = f.name;
      o.textContent = f.name;
      o.style.fontFamily = f.css;
      ddList.appendChild(o);
    }
    ddBuilt = true;
  }
  function openList(open) {
    ddList.hidden = !open;
    ddBtn.setAttribute('aria-expanded', String(open));
    if (!open) return;
    if (!ddBuilt) buildList();
    loadAllFonts();
    const now = current && fontOf(current).name;
    let on = null;
    ddList.querySelectorAll('.ce-dd-opt').forEach((o) => {
      const yes = o.dataset.font === now;
      o.setAttribute('aria-selected', String(yes));
      if (yes) on = o;
    });
    (on || ddList.querySelector('.ce-dd-opt')).focus({ preventScroll: true });
    on?.scrollIntoView({ block: 'nearest' });
  }
  ddBtn.addEventListener('click', () => openList(ddList.hidden));
  ddList.addEventListener('click', (e) => {
    const o = e.target.closest('.ce-dd-opt');
    if (!o || !current) return;
    const f = fontNamed(o.dataset.font);
    current.style.fontFamily = f.css;
    current.dataset.font = f.name;
    if (getComputedStyle(current).fontStyle === 'italic') loadItalic(f);
    whenDrawn(f);
    openList(false);
    ddBtn.focus();
    select(current);
  });
  ddList.addEventListener('keydown', (e) => {
    const opts = [...ddList.querySelectorAll('.ce-dd-opt')];
    const i = opts.indexOf(document.activeElement);
    if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
      e.preventDefault();
      opts[Math.min(Math.max(i + (e.key === 'ArrowDown' ? 1 : -1), 0), opts.length - 1)].focus();
    } else if (e.key === 'Escape') {
      e.preventDefault();
      e.stopPropagation();
      openList(false);
      ddBtn.focus();
    }
  });
  // A click anywhere else closes the list
  document.addEventListener('pointerdown', (e) => { if (!ddList.hidden && !dd.contains(e.target)) openList(false); });
  const ITEMS = '[data-field], .acc-line';
  const originals = new WeakMap(); // front -> its markup as designed, for Reset

  const sel = document.createElement('div');
  sel.className = 'ce-sel';
  sel.hidden = true;
  sel.innerHTML = '<span class="ce-handle" title="Drag to resize"></span>';
  stage.appendChild(sel);
  const handle = sel.firstChild;

  let front = null;   // the design being edited
  let current = null; // the selected item
  let cardScope = false; // the card itself is selected (its bar shows)
  let editing = null; // the text being typed into

  // ---------- Units: everything is stored in cqw (1/100 of the card's width)
  const cardRect = () => card.getBoundingClientRect();
  const toCq = (px) => Math.round((px / cardRect().width) * 100 * 1000) / 1000;
  const cq = (el, prop) => parseFloat(el.style[prop]) || 0;
  const setCq = (el, prop, v) => { el.style[prop] = `${Math.round(v * 1000) / 1000}cqw`; };
  const isText = (el) => el.matches('[data-field]');

  /**
   * Fix every item of a design where it is drawn now, as absolute positions on the card.
   * Text keeps its alignment as its anchor: centred text grows both ways, right-aligned text
   * grows leftwards, so editing a line keeps the layout's balance.
   */
  function flatten(f) {
    const c = cardRect();
    const items = [...f.querySelectorAll(ITEMS)].map((el) => {
      const cs = getComputedStyle(el);
      const r = el.getBoundingClientRect();
      if (!isText(el)) return { el, x: r.left - c.left, y: r.top - c.top, w: r.width, h: r.height };
      // The text's own extent (a <p> box can be wider than its words)
      const range = document.createRange();
      range.selectNodeContents(el);
      const t = range.getBoundingClientRect();
      const anchor = cs.textAlign === 'center' ? 'c' : cs.textAlign === 'right' || cs.textAlign === 'end' ? 'r' : 'l';
      const fs = parseFloat(cs.fontSize);
      return {
        el, anchor, y: r.top - c.top,
        x: anchor === 'c' ? (t.left + t.right) / 2 - c.left : anchor === 'r' ? c.right - t.right : t.left - c.left,
        // Its look came partly from the containers it's leaving, so it carries it with it
        style: {
          fontFamily: cs.fontFamily,
          fontWeight: cs.fontWeight,
          textTransform: cs.textTransform,
          letterSpacing: cs.letterSpacing === 'normal' ? 'normal' : `${(parseFloat(cs.letterSpacing) / fs).toFixed(3)}em`,
          lineHeight: String((parseFloat(cs.lineHeight) / fs || 1.2).toFixed(3)),
        },
        fs,
      };
    });
    f.textContent = ''; // the layout's containers go; the items come back on their own
    f.classList.add('is-free');
    for (const d of items) {
      const { el } = d;
      el.style.position = 'absolute';
      el.style.margin = '0';
      setCq(el, 'top', toCq(d.y));
      if (isText(el)) {
        Object.assign(el.style, d.style);
        setCq(el, 'fontSize', toCq(d.fs));
        el.style.whiteSpace = 'pre';
        el.dataset.anchor = d.anchor;
        if (d.anchor === 'r') setCq(el, 'right', toCq(d.x));
        else setCq(el, 'left', toCq(d.x));
        el.style.transform = d.anchor === 'c' ? 'translateX(-50%)' : 'none'; // centred: left is its middle
      } else {
        el.style.right = 'auto';
        setCq(el, 'left', toCq(d.x));
        setCq(el, 'width', toCq(d.w));
        setCq(el, 'height', toCq(d.h));
      }
      f.appendChild(el);
    }
  }

  // ---------- Selection, and the bar that goes with it
  // A bar sits above what it acts on, or below when there's no room above
  function placeBar(bar, r, below) {
    const s = stage.getBoundingClientRect();
    bar.hidden = false;
    const bw = bar.offsetWidth, bh = bar.offsetHeight;
    const x = Math.min(Math.max(r.left - s.left + r.width / 2 - bw / 2, 0), Math.max(s.width - bw, 0));
    let y = r.top - s.top - bh - 12;
    if (below || y < 0) y = r.bottom - s.top + 12;
    Object.assign(bar.style, { left: `${x}px`, top: `${y}px` });
  }

  function place() {
    itemBar.hidden = !current;
    cardBar.hidden = !cardScope;
    // The card's colour picker closes with its bar
    const cardCp = cardBar.querySelector('.ce-cp');
    if (!cardScope && !cardCp.hidden) {
      cardCp.hidden = true;
      cardBar.querySelectorAll('.ce-custom').forEach((b) => b.setAttribute('aria-expanded', 'false'));
    }
    if (cardScope) placeBar(cardBar, cardRect(), true);
    if (!current) { sel.hidden = true; return; }
    const r = current.getBoundingClientRect();
    const s = stage.getBoundingClientRect();
    const pad = 4;
    Object.assign(sel.style, {
      left: `${r.left - s.left - pad}px`, top: `${r.top - s.top - pad}px`,
      width: `${r.width + pad * 2}px`, height: `${r.height + pad * 2}px`,
    });
    sel.hidden = false;
    placeBar(itemBar, new DOMRect(r.left - pad, r.top - pad, r.width + pad * 2, r.height + pad * 2));
  }

  // Select an item (or nothing); its bar shows only what applies to it
  function select(el) {
    if (editing && editing !== el) stopEdit();
    if (el !== current) { openList(false); openPicker(false); }
    current = el;
    cardScope = false;
    if (el) {
      const text = isText(el);
      itemBar.querySelectorAll('[data-text]').forEach((c) => { c.hidden = !text; });
      if (text) {
        const f = fontOf(el);
        ddVal.textContent = f.name;
        ddVal.style.fontFamily = f.css;
        const cs = getComputedStyle(el);
        itemBar.querySelector('[data-act=bold]').setAttribute('aria-pressed', String(parseInt(cs.fontWeight, 10) >= 600));
        itemBar.querySelector('[data-act=italic]').setAttribute('aria-pressed', String(cs.fontStyle === 'italic'));
      }
      itemBar.querySelectorAll('.ce-inks .pg-sw').forEach((b) => b.setAttribute('aria-pressed', String(b.dataset.value === el.dataset.ink)));
      if (el.dataset.ink === 'custom') customSw.style.setProperty('--sw', el.dataset.hex);
      else customSw.style.removeProperty('--sw');
    }
    place();
  }

  // Select the card itself: its paper and inks, add text, reset
  function selectCard() {
    select(null);
    cardScope = true;
    place();
  }

  // ---------- Typing on the card
  function startEdit(el) {
    if (!isText(el)) return;
    editing = el;
    try { el.contentEditable = 'plaintext-only'; } catch { el.contentEditable = 'true'; }
    if (el.contentEditable !== 'plaintext-only') el.contentEditable = 'true';
    el.focus();
    const r = document.createRange();
    r.selectNodeContents(el);
    const s = getSelection();
    s.removeAllRanges();
    s.addRange(r);
  }
  function stopEdit() {
    if (!editing) return;
    const el = editing;
    editing = null;
    el.contentEditable = 'false';
    el.removeAttribute('contenteditable');
    el.textContent = el.textContent.replace(/\n/g, ' '); // one line each
    getSelection().removeAllRanges();
    place();
  }

  // ---------- Moving
  function move(el, dx, dy) {
    setCq(el, 'top', cq(el, 'top') + dy);
    if (el.dataset.anchor === 'r') setCq(el, 'right', cq(el, 'right') - dx);
    else setCq(el, 'left', cq(el, 'left') + dx);
  }

  // ---------- Resizing: text scales its size, shapes their box (the ring stays round)
  function resize(el, dx, dy, from) {
    if (isText(el)) {
      setCq(el, 'fontSize', Math.max(1, from.size * (1 + dx / Math.max(from.w, 1))));
    } else if (el.classList.contains('mo-mark')) {
      const d = Math.max(4, from.w + Math.max(dx, dy));
      setCq(el, 'width', d);
      setCq(el, 'height', d);
    } else {
      setCq(el, 'width', Math.max(1, from.w + dx));
      setCq(el, 'height', Math.max(0.2, from.h + dy));
    }
    place();
  }

  // One gesture: a drag on an item moves it; a click on a selected text starts typing
  card.addEventListener('pointerdown', (e) => {
    if (!front || e.button !== 0) return;
    if (editing && editing.contains(e.target)) return; // clicking inside the text being typed: the caret moves
    const el = e.target.closest(ITEMS);
    if (!el || !front.contains(el)) { selectCard(); return; }
    e.preventDefault();
    const wasSelected = el === current;
    select(el);
    const startX = e.clientX, startY = e.clientY;
    const perPx = 100 / cardRect().width;
    let lastX = startX, lastY = startY, moved = false;
    card.setPointerCapture(e.pointerId);
    const onMove = (ev) => {
      if (!moved && Math.hypot(ev.clientX - startX, ev.clientY - startY) < 3) return;
      moved = true;
      move(el, (ev.clientX - lastX) * perPx, (ev.clientY - lastY) * perPx);
      lastX = ev.clientX; lastY = ev.clientY;
      place();
    };
    const onUp = () => {
      card.removeEventListener('pointermove', onMove);
      card.removeEventListener('pointerup', onUp);
      card.removeEventListener('pointercancel', onUp);
      if (!moved && wasSelected) startEdit(el);
    };
    card.addEventListener('pointermove', onMove);
    card.addEventListener('pointerup', onUp);
    card.addEventListener('pointercancel', onUp);
  });
  card.addEventListener('dblclick', (e) => {
    const el = e.target.closest('[data-field]');
    if (front && el && front.contains(el) && editing !== el) { select(el); startEdit(el); }
  });

  handle.addEventListener('pointerdown', (e) => {
    if (!current) return;
    e.preventDefault();
    e.stopPropagation();
    const el = current;
    const perPx = 100 / cardRect().width;
    const from = {
      size: cq(el, 'fontSize'),
      w: isText(el) ? el.getBoundingClientRect().width * perPx : cq(el, 'width'),
      h: cq(el, 'height'),
    };
    const startX = e.clientX, startY = e.clientY;
    handle.setPointerCapture(e.pointerId);
    const onMove = (ev) => resize(el, (ev.clientX - startX) * perPx, (ev.clientY - startY) * perPx, from);
    const onUp = () => {
      handle.removeEventListener('pointermove', onMove);
      handle.removeEventListener('pointerup', onUp);
      handle.removeEventListener('pointercancel', onUp);
    };
    handle.addEventListener('pointermove', onMove);
    handle.addEventListener('pointerup', onUp);
    handle.addEventListener('pointercancel', onUp);
  });

  // Typing: Enter finishes (each item is one line), and the selection box follows the text
  card.addEventListener('keydown', (e) => {
    if (editing && (e.key === 'Enter' || e.key === 'Escape')) {
      e.preventDefault();
      e.stopPropagation(); // the page's own Enter (start typing) mustn't see the same key
      stopEdit();
    }
  });
  card.addEventListener('input', place);
  card.addEventListener('focusout', (e) => { if (e.target === editing) stopEdit(); });

  // Keys on a selected item (not while typing, nor in a form field): nudge, delete, edit, let go
  document.addEventListener('keydown', (e) => {
    if (cardScope && e.key === 'Escape') { select(null); return; }
    if (!front || !current || editing) return;
    if (e.target.closest('input, textarea, select, [contenteditable], .ce-dd-list')) return;
    const step = e.shiftKey ? 2 : 0.5;
    const arrows = { ArrowLeft: [-step, 0], ArrowRight: [step, 0], ArrowUp: [0, -step], ArrowDown: [0, step] };
    if (arrows[e.key]) { e.preventDefault(); move(current, ...arrows[e.key]); place(); }
    else if (e.key === 'Delete' || e.key === 'Backspace') { e.preventDefault(); act('delete'); }
    else if (e.key === 'Enter' && isText(current)) { e.preventDefault(); startEdit(current); }
    else if (e.key === 'Escape') select(null);
  });

  // A click anywhere outside the card and its bars lets go of the selection
  document.addEventListener('pointerdown', (e) => {
    if (!current && !cardScope) return;
    if ([card, sel, cardBar, itemBar].some((x) => x.contains(e.target))) return;
    select(null);
  });
  addEventListener('resize', place);

  // ---------- Toolbar
  function act(what) {
    if (what === 'add') {
      const p = document.createElement('p');
      p.dataset.field = 'custom';
      p.dataset.label = 'Text';
      p.dataset.anchor = 'c';
      p.textContent = 'Your text';
      Object.assign(p.style, { position: 'absolute', margin: '0', whiteSpace: 'pre', fontFamily: 'var(--sans)', lineHeight: '1.2', transform: 'translateX(-50%)' });
      setCq(p, 'left', 50);
      setCq(p, 'top', 26);
      setCq(p, 'fontSize', 3.4);
      front.appendChild(p);
      select(p);
      startEdit(p);
      return;
    }
    if (!current) return;
    const el = current;
    if (what === 'edit') startEdit(el);
    else if (what === 'smaller' || what === 'bigger') {
      const k = what === 'bigger' ? 1.1 : 1 / 1.1;
      if (isText(el)) setCq(el, 'fontSize', Math.max(1, cq(el, 'fontSize') * k));
      else { setCq(el, 'width', cq(el, 'width') * k); setCq(el, 'height', cq(el, 'height') * k); }
      place();
    } else if (what === 'bold') {
      el.style.fontWeight = parseInt(getComputedStyle(el).fontWeight, 10) >= 600 ? '400' : '700';
      select(el);
    } else if (what === 'italic') {
      const on = getComputedStyle(el).fontStyle !== 'italic';
      el.style.fontStyle = on ? 'italic' : 'normal';
      if (on) loadItalic(fontOf(el));
      select(el);
    } else if (what === 'delete') {
      el.remove();
      select(null);
    }
  }
  for (const bar of [cardBar, itemBar]) {
    bar.addEventListener('click', (e) => {
      const b = e.target.closest('[data-act]');
      if (b && front) act(b.dataset.act);
    });
    // Its buttons keep the text being typed from losing focus mid-edit
    bar.addEventListener('pointerdown', (e) => { if (e.target.closest('button')) e.preventDefault(); });
  }
  // The item's own ink: text takes it as its ink, a shape as its fill
  function applyInk(val, key) {
    if (!current) return;
    if (isText(current)) {
      current.classList.remove('acc');
      current.style.setProperty('--press-ink', val);
    } else {
      current.style.setProperty('--card-accent', val);
    }
    current.dataset.ink = key;
    itemBar.querySelectorAll('.ce-inks .pg-sw').forEach((b) => b.setAttribute('aria-pressed', String(b.dataset.value === key)));
  }
  // ---------- Custom colour: a shade square (saturation across, brightness down), a hue strip and
  // a hex box. One picker per bar; open(start, onPick) shows it and reports every change at once.

  /**
   * HSV (hue 0-360, saturation and value 0-1) to #rrggbb.
   * Example: hsvToHex(0, 1, 1) → '#ff0000'
   */
  function hsvToHex(h, s, v) {
    const f = (n) => {
      const k = (n + h / 60) % 6;
      return Math.round((v - v * s * Math.max(0, Math.min(k, 4 - k, 1))) * 255).toString(16).padStart(2, '0');
    };
    return `#${f(5)}${f(3)}${f(1)}`;
  }
  /**
   * #rrggbb to HSV, or null if it isn't a 6-digit hex.
   * Example: hexToHsv('#ff0000') → [0, 1, 1]
   */
  function hexToHsv(hex) {
    const m = /^#?([0-9a-f]{6})$/i.exec(String(hex).trim());
    if (!m) return null;
    const [r, g, b] = [0, 2, 4].map((i) => parseInt(m[1].slice(i, i + 2), 16) / 255);
    const max = Math.max(r, g, b), d = max - Math.min(r, g, b);
    const h = d === 0 ? 0 : max === r ? ((g - b) / d) % 6 : max === g ? (b - r) / d + 2 : (r - g) / d + 4;
    return [(h * 60 + 360) % 360, max === 0 ? 0 : d / max, max];
  }

  function colourPicker(root) {
    const sv = root.querySelector('.ce-cp-sv');
    const dot = root.querySelector('.ce-cp-dot');
    const hue = root.querySelector('.ce-cp-hue');
    const knob = root.querySelector('.ce-cp-knob');
    const prev = root.querySelector('.ce-cp-prev');
    const hexIn = root.querySelector('.ce-cp-hex');
    let hsv = [0, 0, 0.15];
    let report = () => {};
    let onClose = () => {};
    const draw = (fromHexBox) => {
      const [h, sat, v] = hsv;
      const hex = hsvToHex(h, sat, v);
      sv.style.setProperty('--hue', `hsl(${h} 100% 50%)`);
      dot.style.left = `${sat * 100}%`;
      dot.style.top = `${(1 - v) * 100}%`;
      knob.style.left = `${(h / 360) * 100}%`;
      prev.style.background = hex;
      if (!fromHexBox) hexIn.value = hex;
      return hex;
    };
    const pick = (fromHexBox) => report(draw(fromHexBox));
    const drag = (el, onPoint) => el.addEventListener('pointerdown', (e) => {
      e.preventDefault();
      el.setPointerCapture(e.pointerId);
      const at = (ev) => {
        const r = el.getBoundingClientRect();
        onPoint(Math.min(Math.max((ev.clientX - r.left) / r.width, 0), 1), Math.min(Math.max((ev.clientY - r.top) / r.height, 0), 1));
        pick();
      };
      at(e);
      const up = () => { el.removeEventListener('pointermove', at); el.removeEventListener('pointerup', up); };
      el.addEventListener('pointermove', at);
      el.addEventListener('pointerup', up);
    });
    drag(sv, (x, y) => { hsv[1] = x; hsv[2] = 1 - y; });
    drag(hue, (x) => { hsv[0] = x * 359.9; });
    hexIn.addEventListener('input', () => {
      const next = hexToHsv(hexIn.value);
      if (next) { hsv = next; pick(true); }
    });
    const api = {
      get open() { return !root.hidden; },
      // Start from a hex (anything else starts from Press black); onPick gets each new colour
      show(start, onPick, closed = () => {}) {
        hsv = hexToHsv(start) || hexToHsv('#262827');
        report = onPick;
        onClose = closed;
        root.hidden = false;
        draw();
      },
      hide() {
        if (root.hidden) return;
        root.hidden = true;
        onClose();
      },
    };
    hexIn.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === 'Escape') { e.preventDefault(); api.hide(); } });
    return api;
  }

  // The selected item's custom colour
  const itemPicker = colourPicker(itemBar.querySelector('.ce-cp'));
  const customSw = itemBar.querySelector('.ce-custom');
  function openPicker(open) {
    if (!open || !current) { itemPicker.hide(); return; }
    const el = current;
    customSw.setAttribute('aria-expanded', 'true');
    // Start from the item's own colour where it's a plain hex
    const own = el.dataset.hex || getComputedStyle(el).getPropertyValue(isText(el) ? '--press-ink' : '--card-accent').trim();
    itemPicker.show(own, (hex) => {
      el.dataset.hex = hex;
      customSw.style.setProperty('--sw', hex);
      applyInk(hex, 'custom');
    }, () => customSw.setAttribute('aria-expanded', 'false'));
    place();
  }
  itemBar.querySelector('.ce-inks').addEventListener('click', (e) => {
    const b = e.target.closest('.pg-sw');
    if (!b || !current) return;
    if (b.dataset.value === 'custom') { openPicker(!itemPicker.open); return; }
    openPicker(false);
    applyInk(b.dataset.hex === 'blind' ? 'var(--blind-ink)' : b.dataset.hex, b.dataset.value);
  });


  // ---------- Used by product.js
  window.hopCardEditor = {
    colourPicker, // product.js gives the card's own rows the same picker
    // Make this (now visible) design editable; its layout is flattened the first time
    use(f) {
      select(null);
      front = f;
      card.classList.add('is-editable');
      card.setAttribute('role', 'group');
      if (!originals.has(f)) {
        originals.set(f, f.innerHTML);
        // Measure once the fonts are in, so every line sits exactly where the design drew it
        document.fonts.ready.then(() => requestAnimationFrame(() => { if (!f.classList.contains('is-free')) flatten(f); }));
      }
    },
    // Back to the design as it was drawn
    reset(f) {
      if (!originals.has(f)) return;
      select(null);
      f.classList.remove('is-free');
      f.innerHTML = originals.get(f);
      requestAnimationFrame(() => flatten(f));
    },
    off() {
      stopEdit();
      select(null);
      cardBar.hidden = true;
      front = null;
      card.classList.remove('is-editable');
      card.setAttribute('role', 'img');
    },
  };
})();
