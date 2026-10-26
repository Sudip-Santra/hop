// K K Marketing - shared behaviour (all pages)
// WhatsApp number comes from partials/config.php via <body data-whatsapp>
const WHATSAPP = document.body.dataset.whatsapp;

// Looping videos: fetched and played only while on screen, so first load stays light.
// Visitors who ask for less motion keep the poster frame.
if (!matchMedia("(prefers-reduced-motion: reduce)").matches) {
  const videoWatch = new IntersectionObserver(
    (entries) => {
      entries.forEach(({ target: v, isIntersecting }) => {
        if (isIntersecting) v.play().catch(() => {});
        else v.pause();
      });
    },
    { rootMargin: "200px 0px" },
  );
  document
    .querySelectorAll("video[data-autoplay]")
    .forEach((v) => videoWatch.observe(v));
}

// Instagram reels (home): hold the mouse and drag to slide the strip. Touch swipes natively.
// A drag doesn't count as a click, so letting go never opens a reel.
const reelsTrack = document.getElementById("reels-track");
if (reelsTrack) {
  reelsTrack.classList.add("is-draggable");
  let startX = 0, startScroll = 0, down = false, dragged = false;
  reelsTrack.addEventListener("pointerdown", (e) => {
    if (e.pointerType !== "mouse" || e.button !== 0) return;
    down = true;
    dragged = false;
    startX = e.clientX;
    startScroll = reelsTrack.scrollLeft;
  });
  addEventListener("pointermove", (e) => {
    if (!down) return;
    const dx = e.clientX - startX;
    if (!dragged && Math.abs(dx) < 5) return; // a small wobble is still a click
    dragged = true;
    reelsTrack.classList.add("is-dragging");
    reelsTrack.scrollLeft = startScroll - dx;
  });
  addEventListener("pointerup", () => {
    if (!down) return;
    down = false;
    reelsTrack.classList.remove("is-dragging"); // snapping comes back and settles on a card
  });
  reelsTrack.addEventListener("click", (e) => {
    if (dragged) { e.preventDefault(); dragged = false; }
  }, true);
  reelsTrack.addEventListener("dragstart", (e) => e.preventDefault()); // no ghost image of the link

  // Each reel shows its thumbnail and plays only while the mouse is over it;
  // leaving rewinds it so the thumbnail comes back
  reelsTrack.querySelectorAll(".reel video").forEach((v) => {
    const reel = v.closest(".reel");
    reel.addEventListener("mouseenter", () => v.play().catch(() => {}));
    reel.addEventListener("mouseleave", () => {
      v.pause();
      v.load(); // back to the poster frame
    });
  });
}

// Overlay scrollbar (mouse/trackpad only; touch keeps the native one)
if (matchMedia("(pointer: fine)").matches) {
  const root = document.documentElement,
    thumb = document.createElement("div");
  thumb.className = "sb-thumb";
  thumb.setAttribute("aria-hidden", "true");
  document.body.appendChild(thumb); // the native bar is already hidden by CSS
  const sync = () => {
    const view = innerHeight,
      full = root.scrollHeight,
      h = Math.max((view * view) / full, 40);
    thumb.style.height = h + "px";
    thumb.style.transform = `translateY(${(scrollY / (full - view)) * (view - h)}px)`;
    thumb.style.display = full > view ? "" : "none";
  };
  addEventListener("scroll", sync, { passive: true });
  addEventListener("resize", sync);
  new ResizeObserver(sync).observe(document.body);
  thumb.addEventListener("pointerdown", (e) => {
    const y0 = e.clientY,
      s0 = scrollY;
    const ratio =
      (root.scrollHeight - innerHeight) / (innerHeight - thumb.offsetHeight);
    thumb.setPointerCapture(e.pointerId);
    thumb.classList.add("drag");
    root.style.scrollBehavior = "auto";
    const move = (ev) => scrollTo(0, s0 + (ev.clientY - y0) * ratio);
    thumb.addEventListener("pointermove", move);
    thumb.addEventListener(
      "pointerup",
      () => {
        thumb.removeEventListener("pointermove", move);
        thumb.classList.remove("drag");
        root.style.scrollBehavior = "";
      },
      { once: true },
    );
    e.preventDefault();
  });
  sync();
}

// Scroll reveal
const io = new IntersectionObserver(
  (entries) => {
    entries.forEach((e, i) => {
      if (!e.isIntersecting) return;
      setTimeout(() => e.target.classList.add("in"), i * 70);
      io.unobserve(e.target);
    });
  },
  { threshold: 0.1 },
);
document.querySelectorAll(".rv").forEach((el) => io.observe(el));

// Enquiry → WhatsApp
document.getElementById("enquiry")?.addEventListener("submit", (e) => {
  e.preventDefault();
  const f = new FormData(e.target);
  const name = (f.get("name") || "").trim();
  const phone = (f.get("phone") || "").trim();
  if (!name || !phone) {
    e.target.querySelector(name ? "[name=phone]" : "[name=name]").focus();
    return;
  }
  const msg = `Hi House of Press, I'm ${name} (${phone}).\nLooking for: ${f.get("type")}\nQuantity: ${f.get("qty")}\nDetails: ${(f.get("need") || "").trim() || "-"}`;
  window.open(
    `https://wa.me/${WHATSAPP}?text=${encodeURIComponent(msg)}`,
    "_blank",
    "noopener",
  );
});

// Mobile menu
const navToggle = document.getElementById("nav-toggle");
const mMenu = document.getElementById("m-menu");
const setMenu = (open) => {
  if (open)
    document.documentElement.style.setProperty(
      "--m-top",
      document.querySelector("header").getBoundingClientRect().bottom + "px",
    );
  mMenu.hidden = !open;
  navToggle.setAttribute("aria-expanded", open);
  navToggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
  document.documentElement.classList.toggle("menu-lock", open);
};
navToggle.addEventListener("click", () => setMenu(mMenu.hidden));
mMenu.addEventListener("click", (e) => {
  if (e.target.closest("a")) setMenu(false);
});
addEventListener("keydown", (e) => {
  if (e.key === "Escape" && !mMenu.hidden) {
    setMenu(false);
    navToggle.focus();
  }
});
matchMedia("(min-width: 1081px)").addEventListener("change", (e) => {
  if (e.matches) setMenu(false);
});

// Links to the page you're on (logo on home, "back to top") scroll up instead of reloading
const pageBase = location.pathname.replace(/[^/]*$/, ""); // "/", "/gallery/", "/about/"
const smoothOrInstant = () =>
  matchMedia("(prefers-reduced-motion: reduce)").matches ? "instant" : "smooth";
const isPlainClick = (e, a) =>
  a &&
  !e.metaKey &&
  !e.ctrlKey &&
  !e.shiftKey &&
  a.target !== "_blank" &&
  a.origin === location.origin;
document.addEventListener("click", (e) => {
  const a = e.target.closest("a[href]");
  if (!isPlainClick(e, a) || a.pathname !== pageBase || a.hash) return;
  e.preventDefault();
  if (location.pathname !== pageBase) history.pushState(null, "", pageBase);
  scrollTo({ top: 0, behavior: smoothOrInstant() });
});

// Section URLs: elements with data-route="slug" get the address <page path>/slug instead of #slug.
// The page opens at that section, links to it scroll instead of reloading, and the address
// follows the section in view. data-route="" marks sections that belong to the page's own URL.
const routeEls = [...document.querySelectorAll("[data-route]")];
if (routeEls.some((el) => el.dataset.route)) {
  const sectionFor = (path) =>
    path.startsWith(pageBase)
      ? routeEls.find(
          (el) =>
            el.dataset.route &&
            el.dataset.route === path.slice(pageBase.length),
        )
      : null;
  const announce = (el) =>
    dispatchEvent(
      new CustomEvent("routechange", {
        detail: el?.dataset.route
          ? { route: el.dataset.route, path: pageBase + el.dataset.route }
          : null,
      }),
    );
  const go = (el, smooth) => {
    const behavior = smooth ? smoothOrInstant() : "instant";
    if (el) el.scrollIntoView({ behavior, block: "start" });
    else scrollTo({ top: 0, behavior });
    announce(el);
  };

  // Arriving from another page of this site scrolls smoothly down to the section;
  // a direct visit or a reload opens straight at it.
  const initial = sectionFor(location.pathname);
  let fromSite = false;
  try {
    const ref = new URL(document.referrer);
    fromSite =
      ref.origin === location.origin && ref.pathname !== location.pathname;
  } catch {}
  if (initial) requestAnimationFrame(() => go(initial, fromSite));

  document.addEventListener("click", (e) => {
    const a = e.target.closest("a[href]");
    if (!isPlainClick(e, a)) return;
    const el = sectionFor(a.pathname);
    if (!el) return;
    e.preventDefault();
    const url = pageBase + el.dataset.route;
    if (location.pathname !== url) history.pushState(null, "", url);
    go(el, true);
  });
  addEventListener("popstate", () => go(sectionFor(location.pathname), false));

  // Keep the address and any section nav in step with what's on screen:
  // the current section is the last one whose top has passed 30% of the viewport.
  let current,
    ticking = false;
  const sync = () => {
    ticking = false;
    const line = innerHeight * 0.3;
    let el = null;
    for (const r of routeEls) if (r.getBoundingClientRect().top <= line) el = r;
    if (el === current) return;
    current = el;
    const url = pageBase + (el?.dataset.route || "");
    if (location.pathname !== url) history.replaceState(null, "", url);
    announce(el);
  };
  addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        ticking = true;
        requestAnimationFrame(sync);
      }
    },
    { passive: true },
  );
}

// Questions (contact page, home page): smooth open / close
document.querySelectorAll(".c-faq details").forEach((d) => {
  const body = d.querySelector(".faq-a");
  d.querySelector("summary").addEventListener("click", (e) => {
    if (matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    e.preventDefault();
    if (d.classList.contains("closing")) return;
    if (d.open) {
      d.classList.add("closing");
      body.animate([{ height: body.offsetHeight + "px" }, { height: "0px" }], {
        duration: 320,
        easing: "cubic-bezier(.2,.7,0,1)",
      }).onfinish = () => {
        d.open = false;
        d.classList.remove("closing");
      };
    } else {
      d.open = true;
      body.animate(
        [
          { height: "0px", opacity: 0 },
          { height: body.offsetHeight + "px", opacity: 1 },
        ],
        { duration: 420, easing: "cubic-bezier(.2,.7,0,1)" },
      );
    }
  });
});

// Questions: lists with data-batch show that many at a time, with a Load more button for the rest
document.querySelectorAll(".c-faq-list[data-batch]").forEach((list) => {
  const n = Number(list.dataset.batch);
  const items = [...list.querySelectorAll("details")];
  const more = list.querySelector(".c-faq-more");
  let shown = n;
  const update = () => {
    items.forEach((d, i) => {
      d.hidden = i >= shown;
    });
    more.hidden = shown >= items.length;
  };
  more.querySelector("button").addEventListener("click", () => {
    const next = items[shown];
    shown += n;
    update();
    next?.querySelector("summary").focus();
  });
  update();
});
