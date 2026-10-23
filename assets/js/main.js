// K K Marketing — shared behaviour (all pages)
// WhatsApp number comes from partials/config.php via <body data-whatsapp>
const WHATSAPP = document.body.dataset.whatsapp;

document.getElementById('yr').textContent = new Date().getFullYear();

// Overlay scrollbar (mouse/trackpad only; touch keeps the native one)
if (matchMedia('(pointer: fine)').matches) {
  const root = document.documentElement, thumb = document.createElement('div');
  thumb.className = 'sb-thumb'; thumb.setAttribute('aria-hidden', 'true');
  document.body.appendChild(thumb); root.classList.add('sb');
  const sync = () => {
    const view = innerHeight, full = root.scrollHeight, h = Math.max(view * view / full, 40);
    thumb.style.height = h + 'px';
    thumb.style.transform = `translateY(${scrollY / (full - view) * (view - h)}px)`;
    thumb.style.display = full > view ? '' : 'none';
  };
  addEventListener('scroll', sync, { passive: true });
  addEventListener('resize', sync);
  new ResizeObserver(sync).observe(document.body);
  thumb.addEventListener('pointerdown', e => {
    const y0 = e.clientY, s0 = scrollY;
    const ratio = (root.scrollHeight - innerHeight) / (innerHeight - thumb.offsetHeight);
    thumb.setPointerCapture(e.pointerId); thumb.classList.add('drag');
    root.style.scrollBehavior = 'auto';
    const move = ev => scrollTo(0, s0 + (ev.clientY - y0) * ratio);
    thumb.addEventListener('pointermove', move);
    thumb.addEventListener('pointerup', () => {
      thumb.removeEventListener('pointermove', move); thumb.classList.remove('drag'); root.style.scrollBehavior = '';
    }, { once: true });
    e.preventDefault();
  });
  sync();
}

// Scroll reveal
const io = new IntersectionObserver((entries) => {
  entries.forEach((e, i) => {
    if (!e.isIntersecting) return;
    setTimeout(() => e.target.classList.add('in'), i * 70);
    io.unobserve(e.target);
  });
}, { threshold: 0.1 });
document.querySelectorAll('.rv').forEach(el => io.observe(el));

// Enquiry → WhatsApp
document.getElementById('enquiry')?.addEventListener('submit', (e) => {
  e.preventDefault();
  const f = new FormData(e.target);
  const name = (f.get('name') || '').trim();
  const phone = (f.get('phone') || '').trim();
  if (!name || !phone) {
    e.target.querySelector(name ? '[name=phone]' : '[name=name]').focus();
    return;
  }
  const msg = `Hi K K Marketing, I'm ${name} (${phone}).\nBuying for: ${f.get('type')}\nNeed: ${(f.get('need') || '').trim() || '—'}`;
  window.open(`https://wa.me/${WHATSAPP}?text=${encodeURIComponent(msg)}`, '_blank', 'noopener');
});

// Mobile menu
const navToggle = document.getElementById('nav-toggle');
const mMenu = document.getElementById('m-menu');
const setMenu = (open) => {
  if (open) document.documentElement.style.setProperty('--m-top', document.querySelector('header').getBoundingClientRect().bottom + 'px');
  mMenu.hidden = !open;
  navToggle.setAttribute('aria-expanded', open);
  navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
  document.documentElement.classList.toggle('menu-lock', open);
};
navToggle.addEventListener('click', () => setMenu(mMenu.hidden));
mMenu.addEventListener('click', (e) => { if (e.target.closest('a')) setMenu(false); });
addEventListener('keydown', (e) => { if (e.key === 'Escape' && !mMenu.hidden) { setMenu(false); navToggle.focus(); } });
matchMedia('(min-width: 1081px)').addEventListener('change', (e) => { if (e.matches) setMenu(false); });

// Links to the page you're on (logo on home, "back to top") scroll up instead of reloading
const pageBase = location.pathname.replace(/[^/]*$/, ''); // "/", "/products/", "/about/"
const smoothOrInstant = () => matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth';
const isPlainClick = (e, a) => a && !e.metaKey && !e.ctrlKey && !e.shiftKey && a.target !== '_blank' && a.origin === location.origin;
document.addEventListener('click', (e) => {
  const a = e.target.closest('a[href]');
  if (!isPlainClick(e, a) || a.pathname !== pageBase || a.hash) return;
  e.preventDefault();
  if (location.pathname !== pageBase) history.pushState(null, '', pageBase);
  scrollTo({ top: 0, behavior: smoothOrInstant() });
});

// Section URLs: elements with data-route="slug" get the address <page path>/slug instead of #slug.
// The page opens at that section, links to it scroll instead of reloading, and the address
// follows the section in view. data-route="" marks sections that belong to the page's own URL.
const routeEls = [...document.querySelectorAll('[data-route]')];
if (routeEls.some(el => el.dataset.route)) {
  const sectionFor = (path) => path.startsWith(pageBase)
    ? routeEls.find(el => el.dataset.route && el.dataset.route === path.slice(pageBase.length))
    : null;
  const announce = (el) => dispatchEvent(new CustomEvent('routechange', {
    detail: el?.dataset.route ? { route: el.dataset.route, path: pageBase + el.dataset.route } : null,
  }));
  const go = (el, smooth) => {
    const behavior = smooth ? smoothOrInstant() : 'instant';
    if (el) el.scrollIntoView({ behavior, block: 'start' });
    else scrollTo({ top: 0, behavior });
    announce(el);
  };

  const initial = sectionFor(location.pathname);
  if (initial) requestAnimationFrame(() => go(initial, false));

  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href]');
    if (!isPlainClick(e, a)) return;
    const el = sectionFor(a.pathname);
    if (!el) return;
    e.preventDefault();
    const url = pageBase + el.dataset.route;
    if (location.pathname !== url) history.pushState(null, '', url);
    go(el, true);
  });
  addEventListener('popstate', () => go(sectionFor(location.pathname), false));

  // Keep the address and any section nav in step with what's on screen:
  // the current section is the last one whose top has passed 30% of the viewport.
  let current, ticking = false;
  const sync = () => {
    ticking = false;
    const line = innerHeight * 0.3;
    let el = null;
    for (const r of routeEls) if (r.getBoundingClientRect().top <= line) el = r;
    if (el === current) return;
    current = el;
    const url = pageBase + (el?.dataset.route || '');
    if (location.pathname !== url) history.replaceState(null, '', url);
    announce(el);
  };
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(sync); } }, { passive: true });
}
